const USERS_KEY = "ticketapp_users";

export function getUsers() {
  try {
    const raw = localStorage.getItem(USERS_KEY);
    if (!raw) return [];
    return JSON.parse(raw);
  } catch {
    return [];
  }
}

export function saveUsers(users) {
  localStorage.setItem(USERS_KEY, JSON.stringify(users));
}

export function registerUser(email, password) {
  if (!email || !password) {
    throw new Error("Email and password are required.");
  }

  const users = getUsers();

  // check if already registered
  if (users.some((u) => u.email === email)) {
    throw new Error("Email already registered.");
  }

  users.push({ email, password });
  saveUsers(users);
}

// returns true if credentials match an existing user
export function validateCredentials(email, password) {
  const users = getUsers();
  const user = users.find(
    (u) => u.email === email && u.password === password
  );
  return !!user;
}

// optional helper, not strictly required
export function loginUser(email, password) {
  const isValid = validateCredentials(email, password);
  if (!isValid) {
    throw new Error("Invalid credentials.");
  }
  return { email };
}