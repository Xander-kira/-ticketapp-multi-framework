import { createRouter, createWebHistory } from "vue-router";

import Home from "@/pages/Home.vue";
import Login from "@/pages/Login.vue";
import Signup from "@/pages/Signup.vue";
import Dashboard from "@/pages/Dashboard.vue";
import Tickets from "@/pages/Tickets.vue";

import { getSession } from "@/utils/auth.js";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: "/", component: Home },
    { path: "/auth/login", component: Login },
    { path: "/auth/signup", component: Signup },
    { path: "/app/dashboard", component: Dashboard },
    { path: "/app/tickets", component: Tickets },

    // catch-all -> go home
    { path: "/:pathMatch(.)", redirect: "/" },
  ],
});

// nav guard for protected pages
router.beforeEach((to, from, next) => {
  const protectedPaths = ["/app/dashboard", "/app/tickets"];
  const session = getSession(); // from utils/auth.js

  if (protectedPaths.includes(to.path) && !session) {
    // not logged in, bounce to login with a message
    next({
      path: "/auth/login",
      query: {
        message: "Your session has expired — please log in again.",
      },
    });
  } else {
    next();
  }
});

export default router;