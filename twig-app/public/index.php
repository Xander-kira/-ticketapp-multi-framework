<?php

// Simple template engine (no Composer required)
class SimpleTemplate {
    private $templateDir;
    private $variables = [];
    
    public function __construct($templateDir) {
        $this->templateDir = $templateDir;
    }
    
    public function render($template, $vars = []) {
        $this->variables = array_merge($this->variables, $vars);
        $content = file_get_contents($this->templateDir . '/' . $template);
        return $this->parseTemplate($content);
    }
    
    private function parseTemplate($content) {
        // Replace variables
        $content = preg_replace_callback('/{{ ([\w.]+) }}/', [$this, 'replaceVariable'], $content);
        
        // Replace conditionals
        $content = preg_replace_callback('/{% if (.+?) %}(.*?){% endif %}/s', [$this, 'replaceConditional'], $content);
        
        // Replace loops
        $content = preg_replace_callback('/{% for (\w+) in (\w+) %}(.*?){% endfor %}/s', [$this, 'replaceLoop'], $content);
        
        return $content;
    }
    
    private function replaceVariable($matches) {
        $name = $matches[1];
        $parts = explode('.', $name);
        $value = $this->variables;
        
        foreach ($parts as $part) {
            if (is_array($value) && isset($value[$part])) {
                $value = $value[$part];
            } else {
                return '';
            }
        }
        
        return htmlspecialchars($value);
    }
    
    private function replaceConditional($matches) {
        $condition = trim($matches[1]);
        $content = $matches[2];
        
        // Simple condition evaluation for "array|length == 0"
        if (preg_match('/(\w+)\|length == (\d+)/', $condition, $condMatches)) {
            $arrayName = $condMatches[1];
            $expectedLength = intval($condMatches[2]);
            $array = $this->variables[$arrayName] ?? [];
            
            if (is_array($array) && count($array) == $expectedLength) {
                return $content;
            }
            return '';
        }
        
        // Simple variable check
        if (isset($this->variables[$condition]) && $this->variables[$condition]) {
            return $content;
        }
        
        return '';
    }
    
    private function replaceLoop($matches) {
        $itemVar = $matches[1];
        $arrayVar = $matches[2];
        $content = $matches[3];
        $array = $this->variables[$arrayVar] ?? [];
        
        if (!is_array($array)) return '';
        
        $result = '';
        foreach ($array as $item) {
            $itemContent = $content;
            // Replace item properties
            $itemContent = preg_replace_callback('/{{ ' . $itemVar . '\.([\w]+) }}/', function($propMatches) use ($item) {
                $prop = $propMatches[1];
                return isset($item[$prop]) ? htmlspecialchars($item[$prop]) : '';
            }, $itemContent);
            
            $result .= $itemContent;
        }
        
        return $result;
    }
}

// Initialize template engine
$twig = new SimpleTemplate(__DIR__ . '/../templates');

// Start session
session_start();

// Simple routing
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Routes
switch ($uri) {
    case '/':
        echo $twig->render('home.html');
        break;
        
    case '/auth/login':
        if ($method === 'POST') {
            handleLogin();
        } else {
            $message = $_GET['message'] ?? '';
            echo $twig->render('login.html', ['message' => $message]);
        }
        break;
        
    case '/auth/signup':
        if ($method === 'POST') {
            handleSignup();
        } else {
            echo $twig->render('signup.html');
        }
        break;
        
    case '/app/dashboard':
        requireAuth();
        $stats = getTicketStats();
        echo $twig->render('dashboard.html', ['stats' => $stats, 'user_email' => $_SESSION['ticketapp_session']['email']]);
        break;
        
    case '/app/tickets':
        requireAuth();
        if ($method === 'POST') {
            handleTicketAction();
        } else {
            $tickets = getAllTickets();
            echo $twig->render('tickets.html', ['tickets' => $tickets]);
        }
        break;
        
    case '/auth/logout':
        session_destroy();
        header('Location: /');
        exit;
        break;
        
    case '/api/tickets':
        requireAuth();
        handleTicketApi();
        break;
        
    default:
        http_response_code(404);
        echo $twig->render('404.html');
        break;
}

// Authentication functions
function requireAuth() {
    if (!isset($_SESSION['ticketapp_session'])) {
        header('Location: /auth/login?message=' . urlencode('Your session has expired — please log in again.'));
        exit;
    }
}

function handleLogin() {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Email and password are required.']);
        return;
    }
    
    // Simple validation (in real app, check against database)
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['ticketapp_session'] = [
            'email' => $email,
            'created_at' => time()
        ];
        echo json_encode(['success' => true, 'redirect' => '/app/dashboard']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password.']);
    }
}

function handleSignup() {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    if (empty($email) || empty($password) || empty($confirmPassword)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        return;
    }
    
    if ($password !== $confirmPassword) {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match.']);
        return;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
        return;
    }
    
    // Create session (in real app, save to database first)
    $_SESSION['ticketapp_session'] = [
        'email' => $email,
        'created_at' => time()
    ];
    
    echo json_encode(['success' => true, 'redirect' => '/app/dashboard']);
}

function handleTicketApi() {
    header('Content-Type: application/json');
    
    $method = $_SERVER['REQUEST_METHOD'];
    
    switch ($method) {
        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            $result = createTicket($data);
            echo json_encode($result);
            break;
            
        case 'PUT':
            $data = json_decode(file_get_contents('php://input'), true);
            $result = updateTicket($data);
            echo json_encode($result);
            break;
            
        case 'DELETE':
            $data = json_decode(file_get_contents('php://input'), true);
            $result = deleteTicket($data['id']);
            echo json_encode($result);
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    }
}

// Ticket management functions
function getAllTickets() {
    $ticketsFile = __DIR__ . '/../data/tickets.json';
    if (!file_exists($ticketsFile)) {
        return [];
    }
    
    $content = file_get_contents($ticketsFile);
    return json_decode($content, true) ?: [];
}

function saveTickets($tickets) {
    $dataDir = __DIR__ . '/../data';
    if (!is_dir($dataDir)) {
        mkdir($dataDir, 0755, true);
    }
    
    file_put_contents($dataDir . '/tickets.json', json_encode($tickets, JSON_PRETTY_PRINT));
}

function createTicket($data) {
    $title = trim($data['title'] ?? '');
    $description = trim($data['description'] ?? '');
    $status = $data['status'] ?? 'open';
    
    // Validation
    if (empty($title)) {
        return ['success' => false, 'message' => 'Title is required.'];
    }
    
    if (!in_array($status, ['open', 'in_progress', 'closed'])) {
        return ['success' => false, 'message' => 'Invalid status.'];
    }
    
    if (strlen($description) > 200) {
        return ['success' => false, 'message' => 'Description cannot exceed 200 characters.'];
    }
    
    $tickets = getAllTickets();
    
    $newTicket = [
        'id' => uniqid(),
        'title' => $title,
        'description' => $description,
        'status' => $status,
        'created_at' => date('c'),
        'updated_at' => date('c')
    ];
    
    array_unshift($tickets, $newTicket);
    saveTickets($tickets);
    
    return ['success' => true, 'ticket' => $newTicket, 'message' => 'Ticket created successfully.'];
}

function updateTicket($data) {
    $id = $data['id'] ?? '';
    $title = trim($data['title'] ?? '');
    $description = trim($data['description'] ?? '');
    $status = $data['status'] ?? '';
    
    if (empty($title)) {
        return ['success' => false, 'message' => 'Title is required.'];
    }
    
    if (!in_array($status, ['open', 'in_progress', 'closed'])) {
        return ['success' => false, 'message' => 'Invalid status.'];
    }
    
    if (strlen($description) > 200) {
        return ['success' => false, 'message' => 'Description cannot exceed 200 characters.'];
    }
    
    $tickets = getAllTickets();
    
    foreach ($tickets as &$ticket) {
        if ($ticket['id'] === $id) {
            $ticket['title'] = $title;
            $ticket['description'] = $description;
            $ticket['status'] = $status;
            $ticket['updated_at'] = date('c');
            
            saveTickets($tickets);
            return ['success' => true, 'ticket' => $ticket, 'message' => 'Ticket updated successfully.'];
        }
    }
    
    return ['success' => false, 'message' => 'Ticket not found.'];
}

function deleteTicket($id) {
    $tickets = getAllTickets();
    
    foreach ($tickets as $index => $ticket) {
        if ($ticket['id'] === $id) {
            array_splice($tickets, $index, 1);
            saveTickets($tickets);
            return ['success' => true, 'message' => 'Ticket deleted successfully.'];
        }
    }
    
    return ['success' => false, 'message' => 'Ticket not found.'];
}

function getTicketStats() {
    $tickets = getAllTickets();
    
    $stats = [
        'total' => count($tickets),
        'open' => 0,
        'in_progress' => 0,
        'closed' => 0
    ];
    
    foreach ($tickets as $ticket) {
        if (isset($stats[$ticket['status']])) {
            $stats[$ticket['status']]++;
        }
    }
    
    return $stats;
}