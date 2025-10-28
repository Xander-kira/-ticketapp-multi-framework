<template>
  <div class="w-full max-w-[1440px] mx-auto px-6 md:px-8 py-10 text-left text-white">
    <!-- PAGE HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
      <div>
        <h1 class="text-2xl font-semibold text-white">Tickets</h1>
        <p class="text-sm text-gray-400">
          Create, edit, resolve, and track all support tickets here.
        </p>
      </div>

      <button
        v-if="editingId"
        @click="cancelEdit"
        class="text-xs font-medium bg-gray-700 hover:bg-gray-600 text-white rounded-lg px-3 py-2"
      >
        Cancel edit
      </button>
    </div>

    <!-- CREATE / EDIT FORM -->
    <div
      class="bg-[#0f172a] border border-[rgba(80,80,255,0.4)] rounded-xl shadow-[0_30px_80px_rgba(80,80,255,0.15)] p-6 max-w-xl"
    >
      <h2 class="text-lg font-medium text-white mb-4">
        {{ editingId ? "Update Ticket" : "New Ticket" }}
      </h2>

      <!-- feedback messages -->
      <div
        v-if="error"
        class="mb-4 text-sm text-red-400 bg-red-900/20 border border-red-500/40 rounded-lg px-3 py-2"
      >
        {{ error }}
      </div>

      <div
        v-if="successMsg"
        class="mb-4 text-sm text-green-400 bg-green-900/20 border border-green-500/40 rounded-lg px-3 py-2"
      >
        {{ successMsg }}
      </div>

      <form @submit.prevent="handleSubmit" class="flex flex-col gap-4">
        <!-- Title (REQUIRED) -->
        <div class="flex flex-col gap-2">
          <label class="text-xs text-gray-300" for="title">
            Title <span class="text-red-400">*</span>
          </label>
          <input
            id="title"
            class="bg-[#1e253d] border border-gray-600 text-white text-sm rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-[rgb(80,80,255)]"
            placeholder="Cannot login / App is crashing / etc..."
            v-model="title"
            @input="clearAlerts"
          />
        </div>

        <!-- Description (OPTIONAL BUT MAX 200 CHARS) -->
        <div class="flex flex-col gap-2">
          <label class="text-xs text-gray-300" for="description">
            Description
          </label>
          <textarea
            id="description"
            rows="3"
            class="bg-[#1e253d] border border-gray-600 text-white text-sm rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-[rgb(80,80,255)] resize-none"
            placeholder="Extra details for context (optional, 200 chars max)"
            v-model="description"
            @input="limitDescription"
          />
          <div class="text-[10px] text-gray-500 text-right">
            {{ description.length }}/200
          </div>
        </div>

        <!-- Status (REQUIRED: open / in_progress / closed) -->
        <div class="flex flex-col gap-2">
          <label class="text-xs text-gray-300" for="status">
            Status <span class="text-red-400">*</span>
          </label>
          <select
            id="status"
            class="bg-[#1e253d] border border-gray-600 text-white text-sm rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-[rgb(80,80,255)]"
            v-model="status"
            @change="clearAlerts"
          >
            <option value="open">open</option>
            <option value="in_progress">in_progress</option>
            <option value="closed">closed</option>
          </select>
          <p class="text-[10px] text-gray-500">
            Only "open", "in_progress", or "closed" are allowed.
          </p>
        </div>

        <button
          type="submit"
          class="text-sm font-medium bg-[rgb(80,80,255)] hover:bg-[rgb(100,100,255)] text-white rounded-lg px-4 py-2 shadow-[0_20px_60px_rgba(80,80,255,0.4)]"
        >
          {{ editingId ? "Save Changes" : "Create Ticket" }}
        </button>
      </form>
    </div>

    <!-- DELETE CONFIRM (inline alert box style) -->
    <div
      v-if="isDeletingId"
      class="mt-6 max-w-xl bg-[#2d0f14] border border-red-500/40 rounded-xl p-4 text-sm"
    >
      <p class="text-red-300 font-medium mb-3">
        Are you sure you want to delete this ticket? This cannot be undone.
      </p>
      <div class="flex gap-3">
        <button
          @click="confirmDelete"
          class="bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-lg px-3 py-2"
        >
          Yes, delete it
        </button>
        <button
          @click="cancelDelete"
          class="bg-gray-700 hover:bg-gray-600 text-white text-xs font-medium rounded-lg px-3 py-2"
        >
          Cancel
        </button>
      </div>
    </div>

    <!-- TICKET LIST -->
    <div class="mt-10">
      <h2 class="text-lg font-medium text-white mb-4">All Tickets</h2>

      <div
        v-if="tickets.length === 0"
        class="text-sm text-gray-500 bg-[#1e253d] border border-gray-700 rounded-lg px-4 py-6 max-w-xl"
      >
        <p class="text-center">
          No tickets yet. Create your first ticket above.
        </p>
      </div>

      <div
        v-else
        class="grid gap-4 md:grid-cols-2 lg:grid-cols-3"
      >
        <div
          v-for="t in tickets"
          :key="t.id"
          class="bg-[#0f172a] border border-gray-700 rounded-xl shadow-[0_20px_60px_rgba(0,0,0,0.6)] p-5 flex flex-col justify-between"
        >
          <div>
            <div class="flex items-start justify-between gap-3">
              <h3 class="text-white font-semibold text-base leading-snug break-words">
                {{ t.title }}
              </h3>

              <!-- STATUS BADGE -->
              <span
                class="text-[10px] font-medium rounded-md px-2 py-1 leading-none whitespace-nowrap border"
                :class="statusStyles(t.status)"
              >
                {{ t.status }}
              </span>
            </div>

            <p
              v-if="t.description"
              class="text-gray-400 text-xs mt-3 leading-relaxed break-words"
            >
              {{ t.description }}
            </p>

            <p class="text-[10px] text-gray-600 mt-3">
              Created: {{ formatDate(t.createdAt) }}
            </p>
          </div>

          <div class="flex flex-wrap gap-2 mt-4">
            <button
              @click="startEdit(t)"
              class="bg-gray-700 hover:bg-gray-600 text-white text-[11px] font-medium rounded-lg px-3 py-1.5"
            >
              Edit
            </button>

            <button
              @click="askDelete(t.id)"
              class="bg-red-600 hover:bg-red-700 text-white text-[11px] font-medium rounded-lg px-3 py-1.5"
            >
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// Vue state / lifecycle
import { ref, onMounted } from "vue";

// localStorage helpers (same logic as React utils)
import {
  getAllTickets,
  createTicket,
  deleteTicket,
  updateTicket,
} from "@/utils/tickets.js";

// -----------------------------
// STATE
// -----------------------------
const tickets = ref([]);

const title = ref("");
const description = ref("");
const status = ref("open");

const error = ref("");
const successMsg = ref("");

const editingId = ref(null);
const isDeletingId = ref(null);

// -----------------------------
// LIFECYCLE: load existing tickets ONCE
// (💡 NOTE: we DO NOT create any ticket here)
// -----------------------------
onMounted(() => {
  tickets.value = getAllTickets();
});

// -----------------------------
// HELPERS
// -----------------------------
function clearAlerts() {
  error.value = "";
  successMsg.value = "";
}

function limitDescription(e) {
  if (description.value.length > 200) {
    description.value = description.value.slice(0, 200);
  }
  clearAlerts();
}

function resetForm() {
  title.value = "";
  description.value = "";
  status.value = "open";
  editingId.value = null;
  clearAlerts();
}

// validate and submit (create or update)
function handleSubmit() {
  clearAlerts();

  // required: title
  if (!title.value.trim()) {
    error.value = "Title is required.";
    return;
  }

  // max length for description (we already enforce, but double-check)
  if (description.value.length > 200) {
    error.value = "Description is too long (max 200).";
    return;
  }

  // allowed statuses
  if (!["open", "in_progress", "closed"].includes(status.value)) {
    error.value = "Status must be open, in_progress, or closed.";
    return;
  }

  try {
    if (editingId.value) {
      // UPDATE
      const updated = updateTicket(editingId.value, {
        title: title.value,
        description: description.value,
        status: status.value,
      });

      // sync local list
      tickets.value = tickets.value.map((t) =>
        t.id === editingId.value ? updated : t
      );

      successMsg.value = "Ticket updated successfully.";
    } else {
      // CREATE
      const created = createTicket({
        title: title.value,
        description: description.value,
        status: status.value,
      });

      tickets.value = [created, ...tickets.value];

      successMsg.value = "Ticket created successfully.";
    }

    resetForm();
  } catch (err) {
    error.value = err?.message || "Something went wrong. Please retry.";
  }
}

// start editing
function startEdit(ticket) {
  editingId.value = ticket.id;
  title.value = ticket.title;
  description.value = ticket.description;
  status.value = ticket.status;
  clearAlerts();
}

// cancel editing
function cancelEdit() {
  resetForm();
}

// ask to delete
function askDelete(id) {
  isDeletingId.value = id;
}

// confirm delete
function confirmDelete() {
  if (!isDeletingId.value) return;
  deleteTicket(isDeletingId.value);
  tickets.value = tickets.value.filter((t) => t.id !== isDeletingId.value);
  isDeletingId.value = null;
  successMsg.value = "Ticket deleted.";
}

// cancel delete
function cancelDelete() {
  isDeletingId.value = null;
}

// styling for status chips
function statusStyles(st) {
  if (st === "open")
    return "bg-green-500/20 text-green-300 border-green-500/40";
  if (st === "in_progress")
    return "bg-amber-500/20 text-amber-300 border-amber-500/40";
  return "bg-gray-500/20 text-gray-300 border-gray-500/40";
}

// format date display
function formatDate(ts) {
  return new Date(ts).toLocaleString();
}
</script>