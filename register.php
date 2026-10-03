<?php
session_start();
if(isset($_SESSION['user_id'])) { header("Location: books.php"); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - Jee Book Hub</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header"><div class="container nav">
<a class="brand" href="index.php">📚 <span>Jee Book Hub</span></a>
<nav><a href="index.php">Home</a><a href="books.php">Books</a><a href="login.php">Login</a></nav>
</div></header>
<main class="auth-page">
<div class="auth-card">
  <div class="auth-icon">✨</div>
  <h1>Create account</h1>
  <p>Join Jee Book Hub and start borrowing books.</p>
  <?php if(isset($_GET['error'])): ?><div class="alert error"><?php echo htmlspecialchars($_GET['error']); ?></div><?php endif; ?>
  <form action="php/register.php" method="POST">
    <label>Full Name</label>
    <input type="text" name="name" placeholder="Enter your name" required>
    <label>Email</label>
    <input type="email" name="email" placeholder="Enter your email" required>
    <label>Password</label>
    <input type="password" name="password" minlength="6" placeholder="Minimum 6 characters" required>
    <button class="btn btn-primary full" type="submit">Create Account</button>
  </form>
  <p class="auth-bottom">Already registered? <a href="login.php">Login here</a></p>
</div>
</main>
<footer><div class="container">© 2026 Jee Book Hub</div></footer>
</body>
</html>
