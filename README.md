# TicketApp - Multi-Framework Implementation

A comprehensive support ticket management system implemented across three different frameworks, demonstrating identical functionality and design patterns. Built for HNG Stage 2 task.

## 🚀 Project Overview

This project showcases the same ticket management application built with three different technologies:

- **React** - Modern SPA with hooks and functional components
- **Vue.js** - Progressive framework with Composition API
- **Twig/HTML** - Static templates with JavaScript enhancement

All implementations feature identical:

- Dark theme design with Tailwind CSS
- Authentication system with localStorage
- Complete CRUD operations for ticket management
- Protected routes and navigation
- Responsive design patterns

## 📁 Project Structure

```
Ticket-app/
├── react-app/           # React 19 + Vite implementation
│   ├── src/
│   │   ├── components/
│   │   ├── pages/
│   │   ├── utils/
│   │   └── ...
│   ├── package.json
│   └── README.md
├── vue-app/            # Vue 3 + Composition API implementation
│   ├── src/
│   │   ├── components/
│   │   ├── pages/
│   │   ├── router/
│   │   ├── utils/
│   │   └── ...
│   ├── package.json
│   └── README.md
├── twig-app/           # Twig templates + JavaScript implementation
│   ├── templates/
│   │   ├── *_react_match.html
│   │   ├── *.twig
│   │   └── ...
│   └── README.md
└── README.md          # This file
```

## 🛠️ Tech Stack Comparison

| Framework            | React          | Vue.js          | Twig/HTML          |
| -------------------- | -------------- | --------------- | ------------------ |
| **Version**          | React 19       | Vue 3           | HTML5 + Twig       |
| **Build Tool**       | Vite           | Vite            | None/PHP           |
| **Styling**          | Tailwind CSS 4 | Tailwind CSS 4  | Tailwind CSS 4     |
| **State Management** | useState hooks | Composition API | localStorage + DOM |
| **Routing**          | React Router   | Vue Router      | Multi-page + JS    |
| **Server**           | SPA            | SPA             | Static/PHP         |

## 🚀 Quick Start

### React Implementation

```bash
cd react-app
npm install
npm run dev
# Open http://localhost:5173
```

### Vue.js Implementation

```bash
cd vue-app
npm install
npm run dev
# Open http://localhost:5173 (different port if React is running)
```

### Twig/HTML Implementation

```bash
cd twig-app/templates
# Open any *_react_match.html file in browser
```

## ✨ Features Implemented

### 🔐 Authentication System

- **Login/Signup Pages**: User registration and authentication
- **Session Management**: localStorage-based sessions
- **Protected Routes**: Dashboard and tickets require authentication
- **Auto-redirect**: Unauthorized users redirected to login

### 🎫 Ticket Management (CRUD)

- **Create Tickets**: Form-based creation with validation
- **View Tickets**: Responsive grid layout with status badges
- **Edit Tickets**: In-place editing with pre-populated forms
- **Delete Tickets**: Confirmation dialogs for safe deletion
- **Status Management**: Open, in-progress, closed tracking

### 🎨 Design System

- **Dark Theme**: Consistent #0a0c1a background across all frameworks
- **Brand Colors**: rgb(80,80,255) primary, cyan accents
- **Responsive Layout**: Mobile-first design with breakpoints
- **UI Components**: Consistent buttons, forms, cards, and navigation

### 🛡️ User Experience

- **Form Validation**: Real-time validation with error messages
- **Loading States**: User feedback during operations
- **Responsive Design**: Works on desktop, tablet, and mobile
- **Accessibility**: Semantic HTML and keyboard navigation

## 📊 Implementation Comparison

### State Management

- **React**: `useState` and `useEffect` hooks
- **Vue**: `ref()` and `onMounted()` Composition API
- **Twig**: Vanilla JavaScript with localStorage

### Component Architecture

- **React**: Functional components with JSX
- **Vue**: Single File Components with templates
- **Twig**: HTML templates with embedded JavaScript

### Routing Strategy

- **React**: Client-side SPA routing with React Router
- **Vue**: Client-side SPA routing with Vue Router
- **Twig**: Multi-page application with JavaScript navigation

## 🧪 Testing & Verification

### Manual Testing Checklist

- [ ] All three implementations run successfully
- [ ] Authentication works in all frameworks
- [ ] CRUD operations function identically
- [ ] Design consistency across implementations
- [ ] Responsive behavior on different screen sizes
- [ ] localStorage persistence works correctly

### Browser Testing

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

## 🎯 Framework-Specific Features

### React Advantages

- Virtual DOM for performance
- Large ecosystem and community
- Mature tooling and debugging
- Industry standard for many teams

### Vue.js Advantages

- Gentle learning curve
- Built-in reactivity system
- Template-based development
- Excellent developer experience

### Twig/HTML Advantages

- No build step required
- Server-side rendering ready
- Progressive enhancement
- Works without JavaScript frameworks

## 🚀 Deployment Options

### React App

- **Vercel**: Automatic deployment with GitHub integration
- **Netlify**: Static site hosting with CI/CD
- **AWS S3**: Static website hosting

### Vue App

- **Vercel**: Vue-specific optimizations
- **Netlify**: Vue build pipeline support
- **Firebase Hosting**: Google Cloud integration

### Twig App

- **GitHub Pages**: Static HTML files
- **PHP Hosting**: Traditional LAMP stack servers
- **Any Web Server**: Static file serving

## 📚 Learning Resources

### React

- [React Documentation](https://react.dev)
- [React Router](https://reactrouter.com)
- [Vite Documentation](https://vitejs.dev)

### Vue.js

- [Vue.js Documentation](https://vuejs.org)
- [Vue Router](https://router.vuejs.org)
- [Composition API Guide](https://vuejs.org/guide/extras/composition-api-faq.html)

### Twig

- [Twig Documentation](https://twig.symfony.com)
- [PHP Documentation](https://php.net)
- [Tailwind CSS](https://tailwindcss.com)

## 🤝 Contributing

1. Choose your preferred framework directory
2. Follow the individual README instructions
3. Maintain design consistency across implementations
4. Test changes in all three frameworks
5. Update documentation as needed

## 📄 License

This project is built for educational purposes as part of the HNG Stage 2 task. Feel free to use and modify for learning purposes.

## 🔗 Links

- **React Demo**: [Live React App](https://your-react-app.vercel.app)
- **Vue Demo**: [Live Vue App](https://your-vue-app.vercel.app)
- **Twig Demo**: [Live Twig App](https://your-twig-app.github.io)

---

Built with ❤️ for HNG Stage 2 Task - Multi-Framework Ticket Management System
