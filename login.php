<?php
session_start();
if(isset($_SESSION['user_id'])) { header("Location: books.php"); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Jee Book Hub</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header"><div class="container nav">
<a class="brand" href="index.php">📚 <span>Jee Book Hub</span></a>
<nav><a href="index.php">Home</a><a href="books.php">Books</a><a href="register.php">Register</a></nav>
</div></header>
<main class="auth-page">
<div class="auth-card">
  <div class="auth-icon">🔐</div>
  <h1>Welcome back</h1>
  <p>Login to manage your borrowed books.</p>
  <?php if(isset($_GET['error'])): ?><div class="alert error"><?php echo htmlspecialchars($_GET['error']); ?></div><?php endif; ?>
  <?php if(isset($_GET['registered'])): ?><div class="alert success">Registration successful. You can login now.</div><?php endif; ?>
  <form action="php/login.php" method="POST">
    <label>Email</label>
    <input type="email" name="email" placeholder="Enter your email" required>
    <label>Password</label>
    <input type="password" name="password" placeholder="Enter your password" required>
    <button class="btn btn-primary full" type="submit">Login</button>
  </form>
  <p class="auth-bottom">Don't have an account? <a href="register.php">Create one</a></p>
</div>
</main>
<footer><div class="container">© 2026 Jee Book Hub</div></footer>
</body>
</html>
