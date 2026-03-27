<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (strtolower($username) === 'admin' || strtolower($password) === 'admin') {
        $error = "Nice try. The admin doesn't take visitors.";
    } elseif ($username === 'guest' && $password === 'guest') {
        setcookie('user', base64_encode('user=guest'), 0, '/');
        header('Location: views/guest.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --bg: #0d0d0d; --card: #141414; --border: #2a2a2a;
      --accent: #c9a96e; --accent-dim: rgba(201,169,110,0.12);
      --text: #f0ece4; --muted: #7a7066; --input-bg: #1a1a1a; --error: #e07070;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      background: var(--bg); color: var(--text);
      font-family: 'DM Sans', sans-serif;
      min-height: 100vh; display: flex; align-items: center; justify-content: center;
    }
    body::before {
      content: ''; position: fixed; inset: 0;
      background: radial-gradient(ellipse 60% 50% at 80% 20%, rgba(201,169,110,0.07) 0%, transparent 60%),
                  radial-gradient(ellipse 40% 40% at 20% 80%, rgba(201,169,110,0.04) 0%, transparent 60%);
      pointer-events: none;
    }
    .container { width: 100%; max-width: 420px; padding: 1.5rem; position: relative; z-index: 1; animation: fadeUp 0.7s ease both; }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
    .wordmark { text-align: center; margin-bottom: 2.5rem; }
    .wordmark span { font-family: 'Playfair Display', serif; font-size: 1.9rem; letter-spacing: 0.08em; color: var(--accent); }
    .wordmark p { font-size: 0.78rem; color: var(--muted); letter-spacing: 0.18em; text-transform: uppercase; margin-top: 0.35rem; }
    .card { background: var(--card); border: 1px solid var(--border); border-radius: 16px; padding: 2.5rem 2.2rem; position: relative; overflow: hidden; }
    .card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent, var(--accent), transparent); opacity: 0.5; }
    h1 { font-family: 'Playfair Display', serif; font-size: 1.55rem; font-weight: 700; margin-bottom: 0.35rem; }
    .subtitle { font-size: 0.85rem; color: var(--muted); margin-bottom: 2rem; font-weight: 300; }
    .field { margin-bottom: 1.3rem; }
    label { display: block; font-size: 0.78rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--muted); margin-bottom: 0.5rem; }
    input[type="text"], input[type="password"] {
      width: 100%; background: var(--input-bg); border: 1px solid var(--border);
      border-radius: 8px; color: var(--text); font-family: 'DM Sans', sans-serif;
      font-size: 0.95rem; padding: 0.75rem 1rem; outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    input[type="text"]::placeholder, input[type="password"]::placeholder { color: var(--muted); }
    input[type="text"]:focus, input[type="password"]:focus { border-color: var(--accent); box-shadow: 0 0 0 3px var(--accent-dim); }
    .password-wrap { position: relative; }
    .password-wrap input { padding-right: 2.8rem; }
    .toggle-pw { position: absolute; right: 0.9rem; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--muted); padding: 0; display: flex; align-items: center; transition: color 0.2s; }
    .toggle-pw:hover { color: var(--accent); }
    .row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.8rem; margin-top: -0.3rem; }
    .remember { display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.83rem; color: var(--muted); user-select: none; }
    .remember input[type="checkbox"] { width: 16px; height: 16px; accent-color: var(--accent); cursor: pointer; padding: 0; }
    .forgot { font-size: 0.83rem; color: var(--accent); text-decoration: none; opacity: 0.85; transition: opacity 0.2s; }
    .forgot:hover { opacity: 1; }
    .btn-login { width: 100%; background: var(--accent); color: #0d0d0d; font-family: 'DM Sans', sans-serif; font-size: 0.92rem; font-weight: 600; letter-spacing: 0.06em; border: none; border-radius: 8px; padding: 0.85rem; cursor: pointer; transition: opacity 0.2s, transform 0.15s; text-transform: uppercase; }
    .btn-login:hover { opacity: 0.88; }
    .btn-login:active { transform: scale(0.98); }
    .alert {
      border-radius: 8px; padding: 0.75rem 1rem;
      font-size: 0.85rem; margin-bottom: 1.4rem;
      display: flex; align-items: flex-start; gap: 0.6rem;
    }
    .alert.error { background: rgba(224,112,112,0.1); border: 1px solid rgba(224,112,112,0.3); color: var(--error); }
    .alert.taunt { background: rgba(201,169,110,0.08); border: 1px solid rgba(201,169,110,0.25); color: var(--accent); font-style: italic; }
    .alert .icon { font-size: 1rem; flex-shrink: 0; margin-top: 1px; }
  </style>
</head>
<body>
  <div class="container">
    <div class="wordmark">
      <span>VAULT</span>
      <p>Secure Access Portal</p>
    </div>
    <div class="card">
      <h1>Welcome back.</h1>
      <p class="subtitle">Sign in to continue.</p>

      <?php if ($error !== ''): ?>
        <?php $isTaunt = str_contains($error, "admin"); ?>
        <div class="alert <?= $isTaunt ? 'taunt' : 'error' ?>">
          <span class="icon"><?= $isTaunt ? '🔒' : '⚠' ?></span>
          <span><?= htmlspecialchars($error) ?></span>
        </div>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="field">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Enter username" autocomplete="username"/>
        </div>
        <div class="field">
          <label for="password">Password</label>
          <div class="password-wrap">
            <input type="password" id="password" name="password" placeholder="Enter password" autocomplete="current-password"/>
            <button type="button" class="toggle-pw" onclick="togglePw()" aria-label="Toggle password visibility">
              <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>
        </div>
        <div class="row">
          <label class="remember">
            <input type="checkbox" name="remember"/> Remember me
          </label>
          <a href="#" class="forgot">Forgot password?</a>
        </div>
        <button type="submit" class="btn-login">Sign In</button>
      </form>
    </div>
  </div>
  <script>
    function togglePw() {
      const input = document.getElementById('password');
      const icon = document.getElementById('eye-icon');
      const isHidden = input.type === 'password';
      input.type = isHidden ? 'text' : 'password';
      icon.innerHTML = isHidden
        ? '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>'
        : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
    }
  </script>
</body>
</html>