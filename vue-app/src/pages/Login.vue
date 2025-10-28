<template>
  <div class="min-h-screen flex items-center justify-center px-4 bg-[#0a0c1a] text-white">
    <div
      class="w-full max-w-sm bg-[#0f172a] border border-[rgba(80,80,255,0.4)]
             shadow-[0_30px_80px_rgba(80,80,255,0.2)]
             rounded-xl p-6 text-left"
    >
      <h1 class="text-xl font-semibold text-white">Welcome back</h1>
      <p class="text-sm text-gray-400 mt-1">
        Log in to manage your tickets.
      </p>

      <!-- Session expired / forced logout message -->
      <div
        v-if="sessionExpiredMsg"
        class="mt-4 text-sm text-yellow-300 bg-yellow-900/20 border border-yellow-500/40 rounded-lg px-3 py-2"
      >
        {{ sessionExpiredMsg }}
      </div>

      <!-- Error message -->
      <div
        v-if="error"
        class="mt-4 text-sm text-red-400 bg-red-900/20 border border-red-500/40 rounded-lg px-3 py-2"
      >
        {{ error }}
      </div>

      <form @submit.prevent="handleSubmit" class="mt-6 flex flex-col gap-4">
        <!-- Email -->
        <div class="flex flex-col gap-2">
          <label class="text-xs text-gray-300" for="email">
            Email
          </label>
          <input
            id="email"
            v-model="email"
            @input="clearError"
            placeholder="you@example.com"
            class="bg-[#1e253d] border border-gray-600 text-white text-sm rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-[rgb(80,80,255)]"
          />
        </div>

        <!-- Password -->
        <div class="flex flex-col gap-2">
          <label class="text-xs text-gray-300" for="password">
            Password
          </label>
          <input
            id="password"
            type="password"
            v-model="password"
            @input="clearError"
            placeholder="••••••••"
            class="bg-[#1e253d] border border-gray-600 text-white text-sm rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-[rgb(80,80,255)]"
          />
        </div>

        <button
          type="submit"
          class="w-full text-center font-medium bg-[rgb(80,80,255)] hover:bg-[rgb(100,100,255)]
                 text-white rounded-lg px-4 py-2 text-sm
                 shadow-[0_20px_60px_rgba(80,80,255,0.4)]"
        >
          Log in
        </button>
      </form>

      <p class="text-xs text-gray-500 mt-6 text-center">
        No account?
        <RouterLink
          to="/signup"
          class="text-[rgb(80,80,255)] hover:text-[rgb(100,100,255)]"
        >
          Create one
        </RouterLink>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter, useRoute } from "vue-router";
import { createSession } from "@/utils/auth.js";
import { validateCredentials } from "@/utils/users.js";

const router = useRouter();
const route = useRoute();

// form state
const email = ref("");
const password = ref("");

// ui state
const error = ref("");

// in React you used: const sessionExpiredMsg = location.state?.message
// in Vue Router, we simulate that kind of "message" using query (?message=...)
const sessionExpiredMsg = ref(route.query.message || "");

function clearError() {
  error.value = "";
}

function handleSubmit() {
  error.value = "";

  if (!email.value.trim() || !password.value.trim()) {
    error.value = "All fields are required.";
    return;
  }

  // check credentials exist in localStorage
  const ok = validateCredentials(email.value, password.value);
  if (!ok) {
    error.value = "Invalid email or password.";
    return;
  }

  // good credentials -> create session + go dashboard
  createSession(email.value);

  // NOTE: in React you navigated to /app/dashboard
  // Your Vue routes are /dashboard so I'll send you there.
  router.push("/dashboard");
}
</script>