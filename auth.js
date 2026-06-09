const SMART_FUNDI_SESSION_KEY = "smart_fundi_session";

function readSession() {
  try {
    const raw = localStorage.getItem(SMART_FUNDI_SESSION_KEY);
    return raw ? JSON.parse(raw) : null;
  } catch {
    return null;
  }
}

function writeSession(profile) {
  const session = {
    name: profile.name,
    email: profile.email,
    createdAt: new Date().toISOString(),
  };

  localStorage.setItem(SMART_FUNDI_SESSION_KEY, JSON.stringify(session));
  return session;
}

function clearSession() {
  localStorage.removeItem(SMART_FUNDI_SESSION_KEY);
}

function requireSession() {
  const session = readSession();
  if (!session) {
    window.location.replace("login.php");
    return null;
  }
  return session;
}

function redirectIfAuthenticated() {
  if (readSession()) {
    window.location.replace("index.php");
  }
}

function syncSessionName() {
  const session = readSession();
  const sessionName = document.querySelector("#sessionName");
  if (sessionName) {
    sessionName.textContent = session?.name || "Mgeni";
  }
}

function initLoginPage() {
  const form = document.querySelector("#loginForm");
  const message = document.querySelector("#loginMessage");

  if (!form) return;

  form.addEventListener("submit", (event) => {
    event.preventDefault();
    const data = new FormData(form);
    const name = String(data.get("name") || "").trim();
    const email = String(data.get("email") || "").trim();
    const password = String(data.get("password") || "").trim();

    if (!name || !email || !password) {
      if (message) message.textContent = "Tafadhali jaza taarifa zote.";
      return;
    }

    writeSession({ name, email });
    window.location.replace("index.php");
  });
}

function initLogoutPage() {
  clearSession();
  setTimeout(() => {
    window.location.replace("login.php");
  }, 1600);
}

window.SmartFundiAuth = {
  readSession,
  writeSession,
  clearSession,
  requireSession,
  redirectIfAuthenticated,
  syncSessionName,
  initLoginPage,
  initLogoutPage,
};
