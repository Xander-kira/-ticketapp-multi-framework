<template>
  <!-- whole app background -->
  <div class="min-h-screen bg-[#0a0c1a] text-white flex flex-col">

    <!-- NAVBAR (shared across all pages) -->
    <header class="bg-[#0f172a] border-b border-slate-800">
      <nav
        class="max-w-[1440px] mx-auto flex flex-wrap items-center gap-6 text-sm font-medium text-slate-200 px-4 py-4 md:px-8"
      >
        <RouterLink
          to="/"
          class="hover:text-indigo-400"
          :class="isActive('/')"
        >
          Home
        </RouterLink>

        <RouterLink
          to="/auth/login"
          class="hover:text-indigo-400"
          :class="isActive('/auth/login')"
        >
          Login
        </RouterLink>

        <RouterLink
          to="/auth/signup"
          class="hover:text-indigo-400"
          :class="isActive('/auth/signup')"
        >
          Signup
        </RouterLink>

        <RouterLink
          to="/app/dashboard"
          class="hover:text-indigo-400"
          :class="isActive('/app/dashboard')"
        >
          Dashboard
        </RouterLink>

        <RouterLink
          to="/app/tickets"
          class="hover:text-indigo-400"
          :class="isActive('/app/tickets')"
        >
          Tickets
        </RouterLink>
      </nav>
    </header>

    <!-- PAGE CONTENT -->
    <!-- flex-1 makes this stretch so footer stays at bottom -->
    <main class="flex-1">
      <!-- This is where whatever route you're on will render -->
      <RouterView />
    </main>

    <!-- FOOTER (shared across all pages) -->
    <footer class="bg-[#0f172a] border-t border-slate-800 text-[11px] text-slate-400 text-center py-4">
      TicketApp • HNG Stage 2 • Vue Version
    </footer>
  </div>
</template>

<script setup>
import { useRoute } from "vue-router";
import { RouterLink, RouterView } from "vue-router";

// we use this to highlight the active link
const route = useRoute();

function isActive(prefix) {
  // if the current route path STARTS WITH the prefix, highlight
  return route.path.startsWith(prefix)
    ? "text-indigo-400"
    : "";
}
</script>

<style>
/* no extra styles needed, Tailwind handles design */
</style>