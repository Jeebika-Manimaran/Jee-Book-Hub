<?php
session_start();
require "php/db.php";
if(!isset($_SESSION['user_id']) || ($_SESSION['role']??'user')!=='admin') { header("Location: index.php"); exit; }
$books=$conn->query("SELECT * FROM books ORDER BY id DESC");
$users=$conn->query("SELECT id,name,email,created_at FROM users ORDER BY id DESC");
$active=$conn->query("SELECT COUNT(*) c FROM issues WHERE return_date IS NULL")->fetch_assoc()['c'];
$total=$conn->query("SELECT COUNT(*) c FROM books")->fetch_assoc()['c'];
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Admin - Jee Book Hub</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<header class="header"><div class="container nav"><a class="brand" href="index.php">📚 <span>Jee Book Hub</span></a><nav><a href="index.php">Home</a><a href="books.php">Books</a><a href="my-books.php">My Books</a><a href="php/logout.php" class="nav-login">Logout</a></nav></div></header>
<main class="container page">
<div class="page-title"><div><span class="eyebrow">MANAGEMENT</span><h1>Admin Dashboard</h1><p>Manage the library collection.</p></div></div>
<div class="stats"><div><strong><?php echo $total; ?></strong><span>Book Titles</span></div><div><strong><?php echo $active; ?></strong><span>Active Borrowings</span></div><div><strong><?php echo $users->num_rows; ?></strong><span>Registered Users</span></div></div>
<div class="admin-panel">
<h2>Add New Book</h2>
<form class="admin-form" action="php/add_book.php" method="POST">
<input name="title" placeholder="Book title" required><input name="author" placeholder="Author" required><input name="category" placeholder="Category" required><input name="copies" type="number" min="1" value="1" required><button class="btn btn-primary" type="submit">Add Book</button>
</form>
</div>
<div class="admin-panel"><h2>Current Books</h2><div class="table-wrap"><table><thead><tr><th>Title</th><th>Author</th><th>Category</th><th>Available</th></tr></thead><tbody>
<?php while($b=$books->fetch_assoc()): ?><tr><td><?php echo htmlspecialchars($b['title']); ?></td><td><?php echo htmlspecialchars($b['author']); ?></td><td><?php echo htmlspecialchars($b['category']); ?></td><td><?php echo $b['available_copies']; ?></td></tr><?php endwhile; ?>
</tbody></table></div></div>
</main><footer><div class="container">© 2026 Jee Book Hub · Admin</div></footer>
</body></html>
