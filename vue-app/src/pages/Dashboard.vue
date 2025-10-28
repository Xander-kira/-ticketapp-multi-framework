<template>
  <!-- Full-page dark background -->
  <div
    class="min-h-screen bg-[#0a0c1a] flex items-center justify-center px-6 text-white"
  >
    <!-- Dashboard card centered -->
    <div
      class="max-w-md w-full bg-[#0f172a] border border-[rgba(80,80,255,0.4)]
             rounded-xl shadow-[0_30px_80px_rgba(80,80,255,0.2)] p-6"
    >
      <!-- Header row with user + logout -->
      <div class="flex items-start justify-between">
        <div>
          <h1 class="text-xl font-semibold text-white">Dashboard</h1>
          <p class="text-xs text-gray-400 mt-1">
            Signed in as
            <span class="text-[rgb(80,80,255)]">
              {{ sessionEmail || "unknown" }}
            </span>
          </p>
        </div>

        <button
          @click="handleLogout"
          class="text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg px-3 py-2"
        >
          Logout
        </button>
      </div>

      <!-- LIVE STATS -->
      <div class="mt-6 grid grid-cols-3 gap-3 text-center text-xs">
        <!-- Total tickets -->
        <div class="bg-[#1e253d] rounded-lg p-3 border border-gray-600">
          <div class="text-white font-semibold text-lg">
            {{ stats.total }}
          </div>
          <div class="text-gray-400">Total</div>
        </div>

        <!-- Open tickets -->
        <div class="bg-[#1e253d] rounded-lg p-3 border border-gray-600">
          <div class="text-green-400 font-semibold text-lg">
            {{ stats.open }}
          </div>
          <div class="text-gray-400">Open</div>
        </div>

        <!-- Closed tickets -->
        <div class="bg-[#1e253d] rounded-lg p-3 border border-gray-600">
          <div class="text-gray-300 font-semibold text-lg">
            {{ stats.closed }}
          </div>
          <div class="text-gray-400">Closed</div>
        </div>
      </div>

      <!-- LITTLE HINT / NAV -->
      <div class="mt-8 text-[11px] text-gray-500 leading-relaxed text-center">
        <p>
          These stats are calculated from your actual tickets saved in
          localStorage. Create or close tickets on the
          <button
            @click="goTickets"
            class="text-[rgb(80,80,255)] hover:text-[rgb(100,100,255)] underline underline-offset-2"
          >
            Tickets page
          </button>.
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from "vue";
import { useRouter } from "vue-router";
import { getSession, clearSession } from "@/utils/auth.js";
import { getAllTickets } from "@/utils/tickets.js";

const router = useRouter();

const stats = reactive({
  total: 0,
  open: 0,
  closed: 0,
});

const sessionEmail = ref("");

onMounted(() => {
  const session = getSession();
  sessionEmail.value = session?.email || "";

  const all = getAllTickets();

  const openCount = all.filter((t) => t.status === "open").length;
  const closedCount = all.filter((t) => t.status === "closed").length;

  stats.total = all.length;
  stats.open = openCount;
  stats.closed = closedCount;
});

function handleLogout() {
  clearSession();
  router.push("/");
}

function goTickets() {
  router.push("/tickets");
}
</script>