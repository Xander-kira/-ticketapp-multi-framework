<template>
  <div
    class="min-h-screen flex items-center justify-center px-4 bg-[#0a0c1a] text-white"
  >
    <div
      class="w-full max-w-sm bg-[#0f172a] border border-[rgba(80,80,255,0.4)] shadow-[0_30px_80px_rgba(80,80,255,0.2)] rounded-xl p-6 text-left"
    >
      <h1 class="text-xl font-semibold text-white">Create account</h1>
      <p class="text-sm text-gray-400 mt-1">Get access to TicketApp.</p>

      <!-- Error message -->
      <div
        v-if="error"
        class="mt-4 text-sm text-red-400 bg-red-900/20 border border-red-500/40 rounded-lg px-3 py-2"
      >
        {{ error }}
      </div>

      <!-- Success message -->
      <div
        v-if="success"
        class="mt-4 text-sm text-green-400 bg-green-900/20 border border-green-500/40 rounded-lg px-3 py-2"
      >
        {{ success }}
      </div>

      <!-- FORM -->
      <form @submit.prevent="handleSubmit" class="mt-6 flex flex-col gap-4">
        <!-- Email -->
        <div class="flex flex-col gap-2">
          <label class="text-xs text-gray-300" for="email">Email</label>
          <input
            id="email"
            v-model="email"
            @input="clearMessages"
            placeholder="you@example.com"
            class="bg-[#1e253d] border border-gray-600 text-white text-sm rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-[rgb(80,80,255)]"
          />
        </div>

        <!-- Password -->
        <div class="flex flex-col gap-2">
          <label class="text-xs text-gray-300" for="password">Password</label>
          <input
            id="password"
            type="password"
            v-model="password"
            @input="clearMessages"
            placeholder="••••••••"
            class="bg-[#1e253d] border border-gray-600 text-white text-sm rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-[rgb(80,80,255)]"
          />
        </div>

        <button
          type="submit"
          class="w-full text-center font-medium bg-[rgb(80,80,255)] hover:bg-[rgb(100,100,255)] text-white rounded-lg px-4 py-2 text-sm shadow-[0_20px_60px_rgba(80,80,255,0.4)]"
        >
          Sign up
        </button>
      </form>

      <p class="text-xs text-gray-500 mt-6 text-center">
        Already have an account?
        <RouterLink
          to="/login"
          class="text-[rgb(80,80,255)] hover:text-[rgb(100,100,255)]"
        >
          Log in
        </RouterLink>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { registerUser } from "@/utils/users.js";

const router = useRouter();

// form state
const email = ref("");
const password = ref("");

// feedback
const error = ref("");
const success = ref("");

// clear messages
function clearMessages() {
  error.value = "";
  success.value = "";
}

// handle signup
function handleSubmit() {
  clearMessages();

  try {
    registerUser(email.value, password.value);
    success.value = "Account created. You can now log in.";

    // redirect to login
    setTimeout(() => {
      router.push("/login");
    }, 500);
  } catch (err) {
    error.value = err.message || "Could not create account.";
  }
}
</script>