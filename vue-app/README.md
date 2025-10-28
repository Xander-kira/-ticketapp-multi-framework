# TicketApp - Vue.js Implementation# vue-app

A modern support ticket management system built with Vue.js 3, featuring a dark theme design and complete CRUD functionality for managing support tickets.This template should help get you started developing with Vue 3 in Vite.

## 🚀 Features## Recommended IDE Setup

- **Vue 3 Composition API**: Modern Vue architecture with reactive state management[VS Code](https://code.visualstudio.com/) + [Vue (Official)](https://marketplace.visualstudio.com/items?itemName=Vue.volar) (and disable Vetur).

- **Responsive Design**: Dark theme with Tailwind CSS 4, optimized for all screen sizes

- **Authentication System**: Login/signup with localStorage session management## Recommended Browser Setup

- **Ticket Management**: Full CRUD operations (Create, Read, Update, Delete)

- **Protected Routes**: Secure navigation with Vue Router guards- Chromium-based browsers (Chrome, Edge, Brave, etc.):

- **Real-time Validation**: Form validation with user-friendly error messages - [Vue.js devtools](https://chromewebstore.google.com/detail/vuejs-devtools/nhdogjmejiglipccpnnnanhbledajbpd)

- **Status Management**: Track tickets with "open", "in_progress", and "closed" statuses - [Turn on Custom Object Formatter in Chrome DevTools](http://bit.ly/object-formatters)

- Firefox:

## 🛠️ Tech Stack - [Vue.js devtools](https://addons.mozilla.org/en-US/firefox/addon/vue-js-devtools/)

- [Turn on Custom Object Formatter in Firefox DevTools](https://fxdx.dev/firefox-devtools-custom-object-formatters/)

- **Vue 3** - Progressive JavaScript framework with Composition API

- **Vue Router** - Official routing library with navigation guards## Customize configuration

- **Tailwind CSS 4** - Utility-first CSS framework with custom theme

- **Vite** - Fast build tool and development serverSee [Vite Configuration Reference](https://vite.dev/config/).

- **JavaScript ES6+** - Modern JavaScript features

## Project Setup

## 📦 Installation & Setup

````sh

1. **Navigate to the Vue app directory:**npm install

   ```bash```

   cd vue-app

   ```### Compile and Hot-Reload for Development



2. **Install dependencies:**```sh

   ```bashnpm run dev

   npm install```

````

### Compile and Minify for Production

3. **Start the development server:**

   `bash`sh

   npm run devnpm run build

   ```

   ```

4. **Open in browser:**

   - Local: http://localhost:5173

   - The app will automatically reload on file changes# 🎫 HNG TicketApp (Vue Version)

## 🏗️ Project StructureA Ticket Management Web App built with _Vue 3 + Vite + Tailwind CSS_, for the HNG Stage 2 Frontend task.

````This app implements:

vue-app/- Landing page with custom glow blobs, SVG wave footer, decorative elements, and max-width 1440px layout

├── src/- LocalStorage-based auth (login / signup)

│   ├── components/- Protected Dashboard with live ticket stats

│   │   ├── HelloWorld.vue      # Example component- Tickets page with full CRUD (create, read, update, delete)

│   │   └── TheWelcome.vue      # Welcome section- Form validation and inline error/success feedback

│   ├── pages/- Route protection and session handling

│   │   ├── Home.vue            # Landing page

│   │   ├── Login.vue           # User login---

│   │   ├── Signup.vue          # User registration

│   │   ├── Dashboard.vue       # Protected dashboard## 🚀 Tech Stack

│   │   └── Tickets.vue         # Ticket management (CRUD)- Vue 3 (Composition API + <script setup>)

│   ├── router/- Vite

│   │   └── index.js            # Vue Router configuration- Tailwind CSS

│   ├── utils/- Vue Router

│   │   ├── auth.js             # Authentication utilities- localStorage (simulated auth + tickets DB)

│   │   ├── tickets.js          # Ticket CRUD operations

│   │   └── users.js            # User management---

│   ├── App.vue                 # Root component

│   └── main.js                 # App entry point## 🔐 Auth / Session

├── package.json- When you log in successfully, we store a session object in localStorage under the key ticketapp_session.

└── vite.config.js- Protected pages (/app/dashboard and /app/tickets) check this session.

```- If you're not logged in and you try to access them, you are redirected to /auth/login with a message:

  "Your session has expired — please log in again."

## 🎨 Design System

---

- **Primary Colors**: Brand blue (rgb(80,80,255)) with cyan accents

- **Background**: Dark theme (#0a0c1a) with layered gradients## 📊 Dashboard

- **Typography**: Clean, modern font hierarchyThe dashboard shows:

- **Components**: Consistent button styles, form inputs, and cards- Total tickets

- **Layout**: Max-width 1440px containers, responsive grid systems- Open tickets (status = open)

- Closed tickets (status = closed)

## 🔐 Authentication

These stats are calculated from real saved tickets.

- **Session Storage**: Uses localStorage with key `ticketapp_session`

- **Protected Routes**: `/app/dashboard` and `/app/tickets` require authentication---

- **Router Guards**: Automatic redirect for unauthorized access

- **Session Validation**: Checks authentication state on route changes## 📝 Tickets CRUD

On /app/tickets you can:

## 🎫 Ticket Features- Create a new ticket

- Edit a ticket

### Create Tickets- Delete a ticket (with confirmation)

- Required title field with real-time validation- See tickets in responsive cards with color-coded statuses

- Optional description (max 200 characters with counter)

- Status selection: open, in_progress, closedValidation rules:

- Automatic timestamp creation- title is required

- status must be one of: open, in_progress, closed

### Manage Tickets- description is optional but limited to 200 characters

- **View**: Responsive grid layout with status badges

- **Edit**: In-place editing with form pre-populationAny invalid input shows inline error messages.

- **Delete**: Confirmation dialog to prevent accidental deletion

- **Status Updates**: Dynamic status changes with color coding---



### Data Persistence## ♿ Accessibility

- All tickets stored in localStorage with key `ticketapp_tickets`- Semantic elements where possible

- Unique ID generation using crypto.randomUUID()- Focus states are visible (Tailwind ring classes)

- Reactive state management with Vue 3 refs- Status colors:

- Automatic form validation and error handling  - open → green tone

  - in_progress → amber tone

## 🧪 Available Scripts  - closed → gray tone

- Text contrast uses light-on-dark with sufficient contrast

- `npm run dev` - Start development server with hot reload

- `npm run build` - Build for production---

- `npm run preview` - Preview production build locally

## ▶ Run locally

## 🌟 Key Vue Features

```bash

### Composition API# install deps

- `ref()` and `reactive()` for state managementnpm install

- `onMounted()` lifecycle hooks

- Computed properties for derived state# start dev server

- Watch effects for reactive updatesnpm run dev


### Component Structure
```vue
<template>
  <!-- Template with Vue directives -->
</template>

<script setup>
// Composition API setup
import { ref, onMounted } from 'vue'
</script>
````

### Vue Directives Used

- `v-model` - Two-way data binding
- `v-if/v-else` - Conditional rendering
- `v-for` - List rendering
- `@click/@submit` - Event handling
- `:class` - Dynamic class binding

## 🛡️ Route Protection

Vue Router guards implemented for authentication:

```javascript
router.beforeEach((to, from, next) => {
  const protectedPaths = ["/app/dashboard", "/app/tickets"];
  const session = getSession();

  if (protectedPaths.includes(to.path) && !session) {
    next({
      path: "/auth/login",
      query: { message: "Please log in to continue" },
    });
  } else {
    next();
  }
});
```

## 🎯 Vue-Specific Implementation

### Reactive State Management

```javascript
// Ticket state
const tickets = ref([]);
const title = ref("");
const description = ref("");
const status = ref("open");

// Form state
const error = ref("");
const successMsg = ref("");
const editingId = ref(null);
```

### Event Handling

```javascript
// Form submission
function handleSubmit() {
  clearAlerts();

  if (!title.value.trim()) {
    error.value = "Title is required.";
    return;
  }

  // CRUD operations...
}
```

### Lifecycle Management

```javascript
onMounted(() => {
  tickets.value = getAllTickets();
});
```

## 🔧 Customization

### Tailwind Configuration

Customize the theme in `tailwind.config.js`:

```javascript
module.exports = {
  content: ["./index.html", "./src/**/*.{vue,js,ts}"],
  theme: {
    extend: {
      colors: {
        "brand-blue": "rgb(80,80,255)",
        "brand-cyan": "rgb(0,212,255)",
      },
    },
  },
};
```

### Adding New Pages

1. Create `.vue` files in `src/pages/`
2. Add routes to `src/router/index.js`
3. Implement authentication guards if needed
4. Use consistent styling patterns

## 📱 Browser Support

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

## 🚀 Development Features

- **Vue DevTools**: Integrated debugging support
- **Hot Module Replacement**: Instant updates during development
- **Vue Inspector**: Component inspection in browser
- **TypeScript Ready**: Can be extended with TypeScript support

## 🤝 Part of Multi-Framework Project

This Vue.js implementation is part of a multi-framework ticket management system that includes:

- **React** - Alternative SPA implementation
- **Vue.js** (this implementation)
- **Twig/HTML** - Static template implementation

All implementations share identical features and design for consistency.

## 🔄 Framework Comparison

| Feature          | Vue Implementation        | React Implementation |
| ---------------- | ------------------------- | -------------------- |
| State Management | Composition API with refs | useState hooks       |
| Routing          | Vue Router                | React Router         |
| Templates        | Single File Components    | JSX                  |
| Reactivity       | Built-in reactive system  | Manual state updates |
| Learning Curve   | Gentle, template-based    | Steeper, JSX-based   |
