<?php
session_start();
require "php/db.php";
if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
$user_id=(int)$_SESSION['user_id'];
$stmt=$conn->prepare("SELECT issues.id AS issue_id, books.title, books.author, books.category, issues.issue_date, issues.return_date FROM issues JOIN books ON issues.book_id=books.id WHERE issues.user_id=? ORDER BY issues.id DESC");
$stmt->bind_param("i",$user_id); $stmt->execute(); $result=$stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Books - Jee Book Hub</title><link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header"><div class="container nav"><a class="brand" href="index.php">📚 <span>Jee Book Hub</span></a>
<nav><a href="index.php">Home</a><a href="books.php">Books</a><a href="my-books.php">My Books</a><?php if(($_SESSION['role']??'user')==='admin'): ?><a href="admin.php">Admin</a><?php endif; ?><a href="php/logout.php" class="nav-login">Logout</a></nav></div></header>
<main class="container page">
<div class="page-title"><div><span class="eyebrow">YOUR LIBRARY</span><h1>My Borrowed Books</h1><p>Hello, <?php echo htmlspecialchars($_SESSION['name']); ?>. Here are your borrowing records.</p></div><a class="btn btn-primary" href="books.php">Browse Books</a></div>
<div class="my-books-list">
<?php if($result->num_rows===0): ?>
<div class="empty"><div>📚</div><h2>No borrowed books yet</h2><p>Choose a book from the collection to get started.</p><a class="btn btn-primary" href="books.php">Browse Books</a></div>
<?php else: while($row=$result->fetch_assoc()): ?>
<div class="borrow-card">
  <div class="borrow-icon">📖</div>
  <div class="borrow-info"><span class="tag"><?php echo htmlspecialchars($row['category']); ?></span><h3><?php echo htmlspecialchars($row['title']); ?></h3><p>by <?php echo htmlspecialchars($row['author']); ?></p><small>Borrowed on: <?php echo htmlspecialchars($row['issue_date']); ?></small></div>
  <div class="borrow-action">
  <?php if($row['return_date']===NULL): ?>
    <span class="status borrowed">Borrowed</span>
    <form action="php/return_book.php" method="POST"><input type="hidden" name="issue_id" value="<?php echo $row['issue_id']; ?>"><button class="btn btn-small btn-danger" type="submit">Return Book</button></form>
  <?php else: ?>
    <span class="status returned">Returned</span><small>on <?php echo htmlspecialchars($row['return_date']); ?></small>
  <?php endif; ?>
  </div>
</div>
<?php endwhile; endif; ?>
</div></main>
<footer><div class="container">© 2026 Jee Book Hub</div></footer>
</body></html>
