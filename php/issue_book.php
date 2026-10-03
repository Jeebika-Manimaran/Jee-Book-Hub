<?php
session_start();
require "db.php";
if(!isset($_SESSION["user_id"])){ header("Location: ../login.php?error=".urlencode("Please login before borrowing a book.")); exit; }
if($_SERVER["REQUEST_METHOD"]!=="POST"){ header("Location: ../books.php"); exit; }
$user_id=(int)$_SESSION["user_id"]; $book_id=(int)($_POST["book_id"]??0);
$conn->begin_transaction();
try{
    $stmt=$conn->prepare("SELECT title,available_copies FROM books WHERE id=? FOR UPDATE");
    $stmt->bind_param("i",$book_id); $stmt->execute(); $book=$stmt->get_result()->fetch_assoc();
    if(!$book) throw new Exception("Book not found.");
    if((int)$book["available_copies"]<=0) throw new Exception("This book is currently unavailable.");
    $check=$conn->prepare("SELECT id FROM issues WHERE user_id=? AND book_id=? AND return_date IS NULL");
    $check->bind_param("ii",$user_id,$book_id); $check->execute();
    if($check->get_result()->num_rows>0) throw new Exception("You already borrowed this book.");
    $issue=$conn->prepare("INSERT INTO issues(user_id,book_id,issue_date) VALUES(?,?,CURDATE())");
    $issue->bind_param("ii",$user_id,$book_id); $issue->execute();
    $update=$conn->prepare("UPDATE books SET available_copies=available_copies-1 WHERE id=?");
    $update->bind_param("i",$book_id); $update->execute();
    $conn->commit();
    header("Location: ../books.php?borrowed=1"); exit;
}catch(Exception $e){
    $conn->rollback();
    header("Location: ../books.php?error=".urlencode($e->getMessage())); exit;
}
?>
