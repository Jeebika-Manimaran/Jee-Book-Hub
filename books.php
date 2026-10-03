<?php
session_start();
require "php/db.php";
$result = $conn->query("SELECT id,title,author,category,available_copies FROM books ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Books - Jee Book Hub</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header"><div class="container nav">
<a class="brand" href="index.php">📚 <span>Jee Book Hub</span></a>
<nav>
<a href="index.php">Home</a><a href="books.php">Books</a>
<?php if(isset($_SESSION['user_id'])): ?><a href="my-books.php">My Books</a><?php if(($_SESSION['role']??'user')==='admin'): ?><a href="admin.php">Admin</a><?php endif; ?><a href="php/logout.php" class="nav-login">Logout</a>
<?php else: ?><a href="login.php" class="nav-login">Login</a><?php endif; ?>
</nav></div></header>

<main class="container page">
<div class="page-title">
  <div><span class="eyebrow">JEE BOOK HUB COLLECTION</span><h1>Find your next book</h1><p>Search and borrow from the available collection.</p></div>
  <?php if(isset($_SESSION['user_id'])): ?><a class="btn btn-primary" href="my-books.php">📚 My Books</a><?php endif; ?>
</div>

<div class="toolbar">
  <input id="searchInput" type="text" placeholder="🔎 Search title, author or category...">
  <select id="categoryFilter"><option value="">All categories</option></select>
</div>

<div class="book-grid" id="bookGrid">
<?php while($book=$result->fetch_assoc()): ?>
  <article class="book-card" data-title="<?php echo htmlspecialchars(strtolower($book['title'].' '.$book['author'].' '.$book['category'])); ?>" data-category="<?php echo htmlspecialchars($book['category']); ?>">
    <div class="book-cover"><span>📖</span></div>
    <div class="book-content">
      <span class="tag"><?php echo htmlspecialchars($book['category']); ?></span>
      <h3><?php echo htmlspecialchars($book['title']); ?></h3>
      <p class="author">by <?php echo htmlspecialchars($book['author']); ?></p>
      <div class="book-bottom">
        <span class="<?php echo $book['available_copies']>0?'available':'unavailable'; ?>">
          <?php echo $book['available_copies']>0 ? $book['available_copies'].' available' : 'Currently unavailable'; ?>
        </span>
        <?php if($book['available_copies']>0): ?>
          <?php if(isset($_SESSION['user_id'])): ?>
          <form action="php/issue_book.php" method="POST"><input type="hidden" name="book_id" value="<?php echo $book['id']; ?>"><button class="btn btn-small btn-primary" type="submit">Borrow</button></form>
          <?php else: ?><a class="btn btn-small btn-primary" href="login.php">Login to borrow</a><?php endif; ?>
        <?php else: ?><button class="btn btn-small disabled" disabled>Unavailable</button><?php endif; ?>
      </div>
    </div>
  </article>
<?php endwhile; ?>
</div>
<div id="noResults" class="empty hidden"><div>📚</div><h2>No books found</h2><p>Try a different search.</p></div>
</main>
<footer><div class="container">© 2026 Jee Book Hub · Read. Learn. Grow.</div></footer>
<script src="js/app.js"></script>
</body>
</html>
