<?php
session_start();
require "db.php";
if($_SERVER["REQUEST_METHOD"]!=="POST"){ header("Location: ../login.php"); exit; }
$email=trim($_POST["email"]??"");
$password=$_POST["password"]??"";
$stmt=$conn->prepare("SELECT id,name,password,role FROM users WHERE email=?");
$stmt->bind_param("s",$email); $stmt->execute(); $result=$stmt->get_result(); $row=$result->fetch_assoc();
if($row && password_verify($password,$row["password"])){
    $_SESSION["user_id"]=$row["id"];
    $_SESSION["name"]=$row["name"];
    $_SESSION["role"]=$row["role"];
    header("Location: ../books.php"); exit;
}
header("Location: ../login.php?error=".urlencode("Invalid email or password."));
?>
