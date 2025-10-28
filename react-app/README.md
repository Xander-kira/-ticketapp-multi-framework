# TicketApp - React Implementation

A modern support ticket management system built with React, featuring a dark theme design and complete CRUD functionality for managing support tickets.

## 🚀 Features

- **Modern React Architecture**: Built with React 19, hooks, and functional components
- **Responsive Design**: Dark theme with Tailwind CSS 4, optimized for all screen sizes
- **Authentication System**: Login/signup with localStorage session management
- **Ticket Management**: Full CRUD operations (Create, Read, Update, Delete)
- **Protected Routes**: Secure navigation with authentication guards
- **Real-time Validation**: Form validation with user-friendly error messages
- **Status Management**: Track tickets with "open", "in_progress", and "closed" statuses

## 🛠️ Tech Stack

- **React 19** - Latest React with improved hooks and performance
- **React Router** - Client-side routing with protected routes
- **Tailwind CSS 4** - Utility-first CSS framework with custom theme
- **Vite** - Fast build tool and development server
- **JavaScript ES6+** - Modern JavaScript features

## 📦 Installation & Setup

1. **Navigate to the React app directory:**

   ```bash
   cd react-app
   ```

2. **Install dependencies:**

   ```bash
   npm install
   ```

3. **Start the development server:**

   ```bash
   npm run dev
   ```

4. **Open in browser:**
   - Local: http://localhost:5173
   - The app will automatically reload on file changes

## 🏗️ Project Structure

```
react-app/
├── src/
│   ├── components/
│   │   └── Navbar.jsx          # Navigation component
│   ├── pages/
│   │   ├── Landing.jsx         # Home/landing page
│   │   ├── Login.jsx           # User login
│   │   ├── Signup.jsx          # User registration
│   │   ├── Dashboard.jsx       # Protected dashboard
│   │   └── Tickets.jsx         # Ticket management (CRUD)
│   ├── utils/
│   │   ├── auth.js             # Authentication utilities
│   │   ├── tickets.js          # Ticket CRUD operations
│   │   └── users.js            # User management
│   ├── App.jsx                 # Main app component with routing
│   ├── ProtectedRoute.jsx      # Route protection wrapper
│   └── main.jsx                # App entry point
├── package.json
└── vite.config.js
```

## 🎨 Design System

- **Primary Colors**: Brand blue (rgb(80,80,255)) with cyan accents
- **Background**: Dark theme (#0a0c1a) with layered gradients
- **Typography**: Clean, modern font hierarchy
- **Components**: Consistent button styles, form inputs, and cards
- **Layout**: Max-width 1440px containers, responsive grid systems

## 🔐 Authentication

- **Session Storage**: Uses localStorage with key `ticketapp_session`
- **Protected Routes**: `/app/dashboard` and `/app/tickets` require authentication
- **Auto-redirect**: Unauthorized users are redirected to login with helpful messages

## 🎫 Ticket Features

### Create Tickets

- Required title field
- Optional description (max 200 characters)
- Status selection: open, in_progress, closed
- Automatic timestamp creation

### Manage Tickets

- **View**: Grid layout displaying all tickets with status badges
- **Edit**: In-place editing with form pre-population
- **Delete**: Confirmation dialog to prevent accidental deletion
- **Status Updates**: Change ticket status between open/in_progress/closed

### Data Persistence

- All tickets stored in localStorage with key `ticketapp_tickets`
- Unique ID generation using crypto.randomUUID()
- Automatic form validation and error handling

## 🧪 Available Scripts

- `npm run dev` - Start development server
- `npm run build` - Build for production
- `npm run preview` - Preview production build locally
- `npm run lint` - Run ESLint for code quality

## 🌟 Key Components

### Landing Page

- Hero section with animated background effects
- Wavy SVG graphics and gradient overlays
- Call-to-action buttons for login/signup

### Ticket Management

- Complete CRUD interface
- Real-time form validation
- Status-based color coding
- Responsive card layout

### Navigation

- Authenticated vs. unauthenticated states
- Smooth transitions and hover effects
- Mobile-responsive hamburger menu

## 🔧 Customization

### Theme Configuration

Edit `src/index.css` for global styles and Tailwind configuration in `tailwind.config.js`:

```javascript
theme: {
  extend: {
    colors: {
      'brand-blue': 'rgb(80,80,255)',
      'brand-cyan': 'rgb(0,212,255)',
      // Add your custom colors
    }
  }
}
```

### Adding New Features

1. Create new components in `src/components/`
2. Add pages to `src/pages/`
3. Update routing in `App.jsx`
4. Extend utilities in `src/utils/`

## 📱 Browser Support

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

## 🤝 Part of Multi-Framework Project

This React implementation is part of a multi-framework ticket management system that includes:

- **React** (this implementation)
- **Vue.js** - Alternative SPA implementation
- **Twig/HTML** - Static template implementation

All implementations share identical features and design for consistency.
