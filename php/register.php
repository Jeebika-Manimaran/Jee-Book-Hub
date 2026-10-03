<?php
require "db.php";
if($_SERVER["REQUEST_METHOD"]!=="POST"){ header("Location: ../register.php"); exit; }
$name=trim($_POST["name"]??"");
$email=trim($_POST["email"]??"");
$password=$_POST["password"]??"";
if($name==="" || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($password)<6){
    header("Location: ../register.php?error=".urlencode("Please enter valid details. Password must be at least 6 characters.")); exit;
}
$check=$conn->prepare("SELECT id FROM users WHERE email=?");
$check->bind_param("s",$email); $check->execute();
if($check->get_result()->num_rows>0){
    header("Location: ../register.php?error=".urlencode("Email is already registered.")); exit;
}
$hash=password_hash($password,PASSWORD_DEFAULT);
$stmt=$conn->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,'user')");
$stmt->bind_param("sss",$name,$email,$hash);
if($stmt->execute()) header("Location: ../login.php?registered=1");
else header("Location: ../register.php?error=".urlencode("Registration failed. Please try again."));
?>
