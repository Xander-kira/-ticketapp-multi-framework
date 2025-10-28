# TicketApp - Twig/HTML Implementation

A modern support ticket management system built with static HTML templates and JavaScript, featuring a dark theme design and complete CRUD functionality for managing support tickets.

## 🚀 Features

- **Static HTML Templates**: Server-side ready Twig templates with JavaScript enhancement
- **Responsive Design**: Dark theme with Tailwind CSS 4, optimized for all screen sizes
- **Authentication System**: Login/signup with localStorage session management
- **Ticket Management**: Full CRUD operations (Create, Read, Update, Delete)
- **Client-side Routing**: JavaScript-based navigation simulation
- **Real-time Validation**: Form validation with user-friendly error messages
- **Status Management**: Track tickets with "open", "in_progress", and "closed" statuses

## 🛠️ Tech Stack

- **HTML5** - Semantic markup structure
- **Twig Templates** - PHP templating engine for server-side rendering
- **Tailwind CSS 4** - Utility-first CSS framework via CDN
- **Vanilla JavaScript** - No frameworks, pure JavaScript implementation
- **localStorage API** - Client-side data persistence

## 📦 Setup & Usage

### Option 1: Static HTML Files (Recommended for Testing)

1. **Navigate to the templates directory:**

   ```bash
   cd twig-app/templates
   ```

2. **Open any React-matching template in browser:**

   - `home_react_match.html` - Landing page
   - `login_react_match.html` - Login page
   - `signup_react_match.html` - Registration page
   - `dashboard_react_match.html` - Protected dashboard
   - `tickets_react_match.html` - Ticket management

3. **Use the navigation bar** to test different pages

### Option 2: Twig with PHP Server

1. **Install PHP and Twig:**

   ```bash
   composer require twig/twig
   ```

2. **Set up PHP server** with Twig rendering engine

3. **Configure routes** to render appropriate templates

## 🏗️ Project Structure

```
twig-app/
├── templates/
│   ├── home_react_match.html       # Landing page (React-identical)
│   ├── login_react_match.html      # User login (React-identical)
│   ├── signup_react_match.html     # User registration (React-identical)
│   ├── dashboard_react_match.html  # Protected dashboard (React-identical)
│   ├── tickets_react_match.html    # Ticket management (React-identical)
│   ├── base.twig                   # Base template for inheritance
│   ├── home.twig                   # Twig home template
│   ├── login.twig                  # Twig login template
│   ├── signup.twig                 # Twig signup template
│   ├── dashboard.twig              # Twig dashboard template
│   ├── tickets.twig                # Twig tickets template
│   └── 404.twig                    # Error page template
```

## 🎨 Design System

- **Primary Colors**: Brand blue (rgb(80,80,255)) with cyan accents
- **Background**: Dark theme (#0a0c1a) with layered gradients
- **Typography**: Clean, modern font hierarchy
- **Components**: Consistent button styles, form inputs, and cards
- **Layout**: Max-width 1440px containers, responsive grid systems

## 🔐 Authentication Implementation

### JavaScript Session Management

```javascript
const SESSION_KEY = "ticketapp_session";

function createSession(email) {
  const data = { email, createdAt: Date.now() };
  localStorage.setItem(SESSION_KEY, JSON.stringify(data));
}

function getSession() {
  const raw = localStorage.getItem(SESSION_KEY);
  return raw ? JSON.parse(raw) : null;
}
```

### Route Protection

- Each protected page checks authentication on load
- Automatic redirect to login if session not found
- Session validation with error messages

## 🎫 Ticket Features

### CRUD Operations (JavaScript)

```javascript
// Create ticket
function createTicket({ title, description, status }) {
  const tickets = getAllTickets();
  const newTicket = {
    id: crypto.randomUUID(),
    title,
    description,
    status,
    createdAt: new Date().toISOString(),
  };
  tickets.push(newTicket);
  localStorage.setItem("ticketapp_tickets", JSON.stringify(tickets));
  return newTicket;
}
```

### Features Include:

- **Create**: Form-based ticket creation with validation
- **Read**: Display all tickets in responsive grid
- **Update**: In-place editing with status changes
- **Delete**: Confirmation dialogs for safe deletion
- **Status Management**: Visual status indicators and filtering

## 🌟 Template Features

### React-Matching Templates

All `*_react_match.html` files provide:

- Identical layouts to React components
- Same styling and color schemes
- Consistent navigation patterns
- Matching form validation
- Identical user interactions

### Twig Templates

Standard Twig templates provide:

- Template inheritance with `base.twig`
- Server-side variable rendering
- Conditional logic and loops
- Include/extend functionality

## 📋 Template Breakdown

### Home Page (`home_react_match.html`)

- Hero section with animated background effects
- Wavy SVG graphics and gradient overlays
- Call-to-action buttons for login/signup
- Responsive layout with mobile optimization

### Authentication Pages

- **Login**: Email/password form with validation
- **Signup**: Registration form with confirmations
- Error handling and success messages
- Consistent styling with other implementations

### Dashboard (`dashboard_react_match.html`)

- Protected page requiring authentication
- Welcome message with user information
- Navigation to ticket management
- Session status display

### Tickets Page (`tickets_react_match.html`)

- Complete CRUD interface
- Create/edit form with validation
- Ticket grid with status badges
- Delete confirmation dialogs
- Status-based color coding

## 🔧 Customization

### Styling Updates

Tailwind CSS is loaded via CDN with custom configuration:

```javascript
tailwind.config = {
  theme: {
    extend: {
      colors: {
        "brand-blue": "rgb(80,80,255)",
        "brand-cyan": "rgb(0,212,255)",
        // Add custom colors
      },
    },
  },
};
```

### Adding New Templates

1. Create HTML file in `templates/` directory
2. Include Tailwind CSS CDN and configuration
3. Add navigation links to other pages
4. Implement JavaScript functionality as needed
5. Follow existing naming conventions

### JavaScript Modules

Each template includes embedded JavaScript for:

- Form handling and validation
- CRUD operations
- Authentication checks
- UI interactions and animations

## 📱 Browser Support

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+
- Mobile browsers with localStorage support

## 🚀 Development Workflow

### Testing Templates

1. Open HTML files directly in browser
2. Use browser developer tools for debugging
3. Test localStorage functionality
4. Verify responsive design at different screen sizes

### Twig Development

1. Set up local PHP server
2. Configure Twig environment
3. Create controller logic for routing
4. Pass data to templates as needed

## 🤝 Part of Multi-Framework Project

This Twig/HTML implementation is part of a multi-framework ticket management system that includes:

- **React** - Modern SPA implementation
- **Vue.js** - Alternative SPA implementation
- **Twig/HTML** (this implementation)

All implementations share identical features and design for consistency.

## 🔄 Implementation Comparison

| Feature        | Twig/HTML               | React           | Vue.js          |
| -------------- | ----------------------- | --------------- | --------------- |
| Rendering      | Server-side + Client JS | Client-side SPA | Client-side SPA |
| Templates      | HTML + Twig             | JSX Components  | Vue SFC         |
| State          | localStorage + DOM      | React State     | Vue Reactivity  |
| Routing        | Multi-page + JS         | React Router    | Vue Router      |
| Build          | No build step           | Vite bundling   | Vite bundling   |
| Learning Curve | Gentle                  | Moderate        | Gentle          |

## 💡 Use Cases

- **Prototype Development**: Quick static mockups
- **Server-side Rendering**: PHP/Twig backend integration
- **Progressive Enhancement**: Add interactivity to static sites
- **Learning Tool**: Understand framework concepts without abstractions
- **Fallback Solution**: Works without JavaScript frameworks
