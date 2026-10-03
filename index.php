<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Jee Book Hub</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header">
  <div class="container nav">
    <a class="brand" href="index.php">📚 <span>Jee Book Hub</span></a>
    <nav>
      <a href="index.php">Home</a>
      <a href="books.php">Books</a>
      <?php if(isset($_SESSION['user_id'])): ?>
        <a href="my-books.php">My Books</a>
        <?php if(($_SESSION['role'] ?? 'user') === 'admin'): ?><a href="admin.php">Admin</a><?php endif; ?>
        <a href="php/logout.php" class="nav-login">Logout</a>
      <?php else: ?>
        <a href="login.php" class="nav-login">Login</a>
      <?php endif; ?>
    </nav>
  </div>
</header>

<main>
<section class="hero">
  <div class="container hero-grid">
    <div>
      <span class="eyebrow">WELCOME TO YOUR DIGITAL LIBRARY</span>
      <h1>Read more.<br><span>Learn more.</span></h1>
      <p>Jee Book Hub makes it easy to discover books, borrow them, track your borrowed books and return them whenever you are done.</p>
      <div class="hero-actions">
        <a href="books.php" class="btn btn-primary">Explore Books</a>
        <?php if(!isset($_SESSION['user_id'])): ?><a href="register.php" class="btn btn-light">Create Account</a><?php endif; ?>
      </div>
    </div>
    <div class="hero-card">
      <div class="book-stack">
        <div class="fake-book book-one">READ</div>
        <div class="fake-book book-two">LEARN</div>
        <div class="fake-book book-three">GROW</div>
      </div>
      <div>
        <strong>Your books, one place.</strong>
        <p>Search, borrow and return with a few clicks.</p>
      </div>
    </div>
  </div>
</section>

<section class="container feature-section">
  <div class="section-heading">
    <span class="eyebrow">WHAT YOU CAN DO</span>
    <h2>Everything you need for borrowing</h2>
  </div>
  <div class="feature-grid">
    <div class="feature-card"><div class="feature-icon">🔎</div><h3>Find Books</h3><p>Search books by title, author or category.</p></div>
    <div class="feature-card"><div class="feature-icon">📖</div><h3>Borrow Books</h3><p>Borrow an available copy and track it in My Books.</p></div>
    <div class="feature-card"><div class="feature-icon">↩️</div><h3>Return Easily</h3><p>Return borrowed books and make the copy available again.</p></div>
  </div>
</section>

<section class="container info-strip">
  <div><strong>Simple</strong><span>Easy navigation</span></div>
  <div><strong>Dynamic</strong><span>PHP + MySQL</span></div>
  <div><strong>Secure</strong><span>Hashed passwords</span></div>
  <div><strong>Responsive</strong><span>Works on small screens</span></div>
</section>
</main>

<footer><div class="container">© 2026 Jee Book Hub · Read. Learn. Grow.</div></footer>
</body>
</html>
