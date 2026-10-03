<?php
session_start();
require "db.php";
if(!isset($_SESSION["user_id"]) || ($_SESSION["role"]??"user")!=="admin"){ header("Location: ../index.php"); exit; }
if($_SERVER["REQUEST_METHOD"]!=="POST"){ header("Location: ../admin.php"); exit; }
$title=trim($_POST["title"]??""); $author=trim($_POST["author"]??""); $category=trim($_POST["category"]??""); $copies=(int)($_POST["copies"]??0);
if($title==="" || $author==="" || $category==="" || $copies<1){ header("Location: ../admin.php"); exit; }
$stmt=$conn->prepare("INSERT INTO books(title,author,category,available_copies) VALUES(?,?,?,?)");
$stmt->bind_param("sssi",$title,$author,$category,$copies); $stmt->execute();
header("Location: ../admin.php"); exit;
?>
