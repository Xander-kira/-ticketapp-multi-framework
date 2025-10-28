# TicketApp - Twig Version

## HNG Stage 2 Frontend Task

A complete ticket management web application built with **Twig templating engine** and **PHP backend**, featuring identical design and functionality to the React and Vue.js versions.

## 🚀 Features

### Core Functionality

- **Landing Page**: Wavy SVG background, decorative circles, responsive design (max-width 1440px)
- **Authentication**: Login/Signup with form validation and session management
- **Protected Routes**: Dashboard and Tickets pages require authentication
- **Dashboard**: Live statistics showing total, open, in-progress, and closed tickets
- **Ticket Management**: Full CRUD operations (Create, Read, Update, Delete)

### Design Requirements ✅

- **Max Width**: 1440px container, centered on large screens
- **Hero Section**: Wavy background implemented with SVG
- **Decorative Elements**: Multiple circular gradient elements
- **Responsive Design**: Mobile-first approach with tablet/desktop layouts
- **Color Coding**: Status-based colors (green=open, amber=in_progress, gray=closed)
- **Accessibility**: Semantic HTML, proper focus states, keyboard navigation

### Validation & Error Handling

- **Form Validation**: Real-time validation with inline error messages
- **Session Management**: Server-side sessions with `ticketapp_session` key
- **Error Feedback**: Toast notifications and inline error messages
- **Field Requirements**: Title and status are mandatory, description optional (200 char limit)
- **Status Validation**: Only accepts "open", "in_progress", "closed"

## 🛠 Technologies Used

- **Backend**: PHP 8.0+ with native session handling
- **Templating**: Twig 3.14+ templating engine
- **Styling**: Tailwind CSS 4.x via CDN
- **Database**: File-based JSON storage (development)
- **Server**: PHP built-in development server

## 📋 Prerequisites

- PHP 8.0 or higher
- Composer (for dependency management)
- Web browser with JavaScript enabled

## 🚀 Installation & Setup

### 1. Clone or Download

```bash
# Navigate to the twig-app directory
cd path/to/Ticket-app/twig-app
```

### 2. Install Dependencies

```bash
# Install Twig via Composer
composer install
```

### 3. Set Permissions (Unix/Linux/Mac)

```bash
# Make sure PHP can write to the data directory
chmod 755 data/
chmod 664 data/tickets.json  # if it exists
```

### 4. Start Development Server

```bash
# Option 1: Using Composer script
composer run serve

# Option 2: Direct PHP command
php -S localhost:8000 public/index.php

# Option 3: Using PowerShell (Windows)
php -S localhost:8000 public/index.php
```

### 5. Access the Application

Open your browser and visit: `http://localhost:8000`

## 📁 Project Structure

```
twig-app/
├── composer.json           # Dependency configuration
├── README.md              # This file
├── .gitignore             # Git ignore rules
├── public/
│   └── index.php          # Main application entry point
├── templates/
│   ├── base.twig          # Base template with common elements
│   ├── home.twig          # Landing page
│   ├── login.twig         # Login form
│   ├── signup.twig        # Registration form
│   ├── dashboard.twig     # Dashboard with statistics
│   ├── tickets.twig       # Ticket management (CRUD)
│   └── 404.twig           # Error page
├── data/
│   └── tickets.json       # Ticket storage (auto-created)
└── assets/
    └── (reserved for additional assets)
```

## 🎯 Usage Instructions

### Getting Started

1. **Visit Landing Page**: Navigate to `http://localhost:8000`
2. **Create Account**: Click "Get Started" → Fill signup form
3. **Login**: Use your email and any password (development mode)
4. **Explore Dashboard**: View ticket statistics
5. **Manage Tickets**: Create, edit, delete tickets

### Test User Credentials

Since this is a development application, any valid email format will work:

- **Email**: Any valid email format (e.g., `test@example.com`)
- **Password**: Any password (minimum 6 characters for signup)

### Core Features Demo

#### 1. Landing Page

- Responsive design with wavy background
- Decorative gradient circles
- Call-to-action buttons leading to auth

#### 2. Authentication

- **Signup**: Create new account with email validation
- **Login**: Sign in with form validation
- **Session**: Automatic session management
- **Logout**: Clear session and redirect

#### 3. Dashboard

- Live ticket statistics (auto-calculated)
- Quick navigation to ticket management
- User email display
- Responsive card layout

#### 4. Ticket Management

- **Create**: Add new tickets with validation
- **Read**: View all tickets in card layout
- **Update**: Edit existing ticket details
- **Delete**: Remove tickets with confirmation
- **Validation**: Real-time form validation
- **Status**: Color-coded status badges

## 🔒 Security Features

### Session Management

- Server-side PHP sessions
- Session timeout handling
- Automatic redirect for unauthorized access
- Proper session cleanup on logout

### Input Validation

- Server-side validation for all inputs
- XSS prevention through Twig auto-escaping
- Length limits on text fields
- Restricted status values

### Error Handling

- Graceful error messages
- Input sanitization
- Proper HTTP status codes
- User-friendly error feedback

## 🎨 Design Consistency

This Twig version maintains **pixel-perfect consistency** with React and Vue versions:

### Layout Rules

- **Container**: `max-width: 1440px` on all pages
- **Hero Section**: Identical wavy SVG background
- **Decorative Elements**: Same gradient circles and positioning
- **Typography**: Consistent font sizes and spacing
- **Color Scheme**: Matching color palette across frameworks

### Responsive Behavior

- **Mobile**: Stacked layouts, full-width elements
- **Tablet**: Adjusted grid columns, optimized spacing
- **Desktop**: Multi-column layouts, centered container

## 🧪 Testing the Application

### Manual Testing Checklist

#### Landing Page ✅

- [ ] Hero section displays with wavy background
- [ ] Decorative circles are visible
- [ ] CTA buttons work (Login/Signup)
- [ ] Responsive design works on mobile/tablet/desktop
- [ ] Max-width 1440px container is centered

#### Authentication ✅

- [ ] Signup form validates email format
- [ ] Password confirmation works
- [ ] Login form shows validation errors
- [ ] Successful auth redirects to dashboard
- [ ] Session persists across page reloads

#### Dashboard ✅

- [ ] Shows correct user email
- [ ] Displays accurate ticket statistics
- [ ] Logout button works
- [ ] Protected from unauthorized access

#### Ticket Management ✅

- [ ] Create new tickets with validation
- [ ] Edit existing tickets
- [ ] Delete tickets with confirmation
- [ ] Status color coding works
- [ ] Form validation prevents invalid data
- [ ] Real-time character count for description

#### Error Handling ✅

- [ ] Form validation shows inline errors
- [ ] Toast notifications appear
- [ ] Network errors are handled gracefully
- [ ] Session expiry redirects to login

## 🔧 Development Notes

### Customization Options

1. **Database**: Replace JSON storage with MySQL/PostgreSQL
2. **Authentication**: Integrate with OAuth providers
3. **Styling**: Customize Tailwind configuration
4. **Features**: Add file uploads, comments, assignments

### Known Limitations

- **Storage**: File-based storage (not production-ready)
- **Authentication**: Simplified auth (no password hashing)
- **Scalability**: Single-user sessions (no multi-user support)
- **Email**: No actual email sending functionality

### Production Considerations

- Implement proper database with migrations
- Add password hashing and secure authentication
- Set up proper error logging
- Configure web server (Apache/Nginx)
- Add CSRF protection
- Implement rate limiting

## 🐛 Troubleshooting

### Common Issues

#### Server Won't Start

```bash
# Check PHP version
php --version  # Should be 8.0+

# Check if port is available
netstat -an | findstr 8000  # Windows
lsof -i :8000              # Mac/Linux

# Try different port
php -S localhost:8080 public/index.php
```

#### Permission Errors

```bash
# Unix/Linux/Mac - Fix permissions
chmod -R 755 twig-app/
chmod -R 666 twig-app/data/

# Windows - Run terminal as Administrator
```

#### Composer Issues

```bash
# Reinstall dependencies
rm -rf vendor/
composer install

# Clear Composer cache
composer clear-cache
```

#### Template Errors

- Ensure all `.twig` files are in the `templates/` directory
- Check for syntax errors in Twig templates
- Verify Twig dependency is installed

---

**Happy coding! 🎉**

_This Twig implementation provides pixel-perfect consistency with the React and Vue versions while demonstrating mastery of server-side templating and PHP development._
