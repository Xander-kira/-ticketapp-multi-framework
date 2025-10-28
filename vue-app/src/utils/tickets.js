const TICKETS_KEY = "ticketapp_tickets";

// Get array of ALL tickets from localStorage
export function getAllTickets() {
  try {
    const raw = localStorage.getItem(TICKETS_KEY);
    if (!raw) return [];
    return JSON.parse(raw);
  } catch {
    return [];
  }
}

// Save full ticket list (used by create/edit/delete flows)
export function saveAllTickets(ticketsArr) {
  localStorage.setItem(TICKETS_KEY, JSON.stringify(ticketsArr));
}

// Create a new ticket and persist it
export function createTicket({ title, description, status = "open" }) {
  const all = getAllTickets();
  const id = crypto.randomUUID
    ? crypto.randomUUID()
    : String(Date.now());

  const newTicket = {
    id,
    title,
    description,
    status, // "open" | "closed"
    createdAt: new Date().toISOString(),
  };

  all.push(newTicket);
  saveAllTickets(all);

  return newTicket;
}

// Update a ticket (e.g. close it)
export function updateTicket(id, updates) {
  const all = getAllTickets();
  const idx = all.findIndex((t) => t.id === id);
  if (idx === -1) return false;

  all[idx] = { ...all[idx], ...updates };
  saveAllTickets(all);
  return true;
}

// Delete a ticket
export function deleteTicket(id) {
  const all = getAllTickets();
  const filtered = all.filter((t) => t.id !== id);
  saveAllTickets(filtered);
}