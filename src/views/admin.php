<?php
session_start();

if (!isset($_SESSION["auth"]) || $_SESSION["auth"] !== true) {
    header("Location: ../login.php");
    exit;
}

// Verify the cookie says admin — this is the intentionally vulnerable check
$cookie = base64_decode($_COOKIE['user'] ?? '');
if ($cookie !== 'user=admin') {
    header("Location: guest.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
    <style>
      :root {
        --bg: #0d0d0d; --card: #141414; --border: #2a2a2a;
        --accent: #c9a96e; --text: #f0ece4; --muted: #7a7066;
      }
      *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
      body {
        background: var(--bg); color: var(--text);
        font-family: 'DM Sans', sans-serif;
        min-height: 100vh; display: flex; align-items: center; justify-content: center;
      }
      .card {
        background: var(--card); border: 1px solid var(--border);
        border-radius: 16px; padding: 2.5rem 2.2rem;
        max-width: 460px; width: 100%; text-align: center;
        position: relative; overflow: hidden;
      }
      .card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent); opacity: 0.5;
      }
      h1 { font-family: 'Playfair Display', serif; font-size: 1.6rem; margin-bottom: 1rem; color: var(--accent); }
      .flag {
        margin-top: 1.5rem;
        background: #1a1a1a; border: 1px solid var(--border);
        border-radius: 8px; padding: 0.9rem 1.2rem;
        font-family: monospace; font-size: 1rem; color: var(--accent);
        letter-spacing: 0.04em;
      }
      .emoji { font-size: 3rem; margin-bottom: 1.2rem; display: block; }
    </style>
</head>
<body>
    <div class="card">
        <span class="emoji">🏆</span>
        <h1>Welcome, Admin.</h1>
        <div class="flag">byuctf{s00pa_s3cr3t_fl4g_placeholder}</div>
    </div>
</body>
</html>