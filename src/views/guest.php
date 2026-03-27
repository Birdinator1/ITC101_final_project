<?php
$cookie = base64_decode($_COOKIE['user'] ?? '');
if ($cookie === 'user=admin') {
    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Page</title>
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
      p { color: var(--muted); font-size: 0.95rem; line-height: 1.6; }
      .emoji { font-size: 3rem; margin-bottom: 1.2rem; display: block; }
    </style>
</head>
<body>
    <div class="card">
        <span class="emoji">🚪</span>
        <h1>You're a Guest.</h1>
        <p>Welcome to this soopa secure website! We don't have anything for guests here, sorry. I wrote you a Haiku tho!</p>
        <p>You are just a guest</p>
        <p>If only you were greater</p>
        <p>They call me "guest hater"</p>
    </div>
</body>
</html>