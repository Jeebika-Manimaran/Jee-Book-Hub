<?php
session_start();
require "db.php";
if(!isset($_SESSION["user_id"])){ header("Location: ../login.php"); exit; }
if($_SERVER["REQUEST_METHOD"]!=="POST"){ header("Location: ../my-books.php"); exit; }
$user_id=(int)$_SESSION["user_id"]; $issue_id=(int)($_POST["issue_id"]??0);
$conn->begin_transaction();
try{
    $stmt=$conn->prepare("SELECT book_id FROM issues WHERE id=? AND user_id=? AND return_date IS NULL FOR UPDATE");
    $stmt->bind_param("ii",$issue_id,$user_id); $stmt->execute(); $issue=$stmt->get_result()->fetch_assoc();
    if(!$issue) throw new Exception("Borrowing record not found.");
    $book_id=(int)$issue["book_id"];
    $update=$conn->prepare("UPDATE issues SET return_date=CURDATE() WHERE id=? AND user_id=? AND return_date IS NULL");
    $update->bind_param("ii",$issue_id,$user_id); $update->execute();
    $book=$conn->prepare("UPDATE books SET available_copies=available_copies+1 WHERE id=?");
    $book->bind_param("i",$book_id); $book->execute();
    $conn->commit();
    header("Location: ../my-books.php?returned=1"); exit;
}catch(Exception $e){
    $conn->rollback();
    header("Location: ../my-books.php?error=".urlencode($e->getMessage())); exit;
}
?>
