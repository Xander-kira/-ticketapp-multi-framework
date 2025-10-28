// src/utils/auth.js

const SESSION_KEY = "ticketapp_session";

// createSession(email)
// - called when user logs in successfully
// - stores their email + timestamp in localStorage
export function createSession(email) {
  const data = {
    email,
    createdAt: Date.now(),
  };
  localStorage.setItem(SESSION_KEY, JSON.stringify(data));
}

// getSession()
// - read the current session (or return null if not logged in)
export function getSession() {
  const raw = localStorage.getItem(SESSION_KEY);
  if (!raw) return null;
  try {
    return JSON.parse(raw);
  } catch {
    return null;
  }
}

// clearSession()
// - wipe session from localStorage (logout)
export function clearSession() {
  localStorage.removeItem(SESSION_KEY);
}