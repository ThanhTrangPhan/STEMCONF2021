<?php 
session_start();
include 'connect_db.php';
$id = $_POST['id'];  
$name = $_POST['name'];  
$dob = $_POST['dob'];
$email = $_POST['email'];  
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$sql = "UPDATE user SET Fullname='{$name}', email='{$email}',dob='{$dob}',phone='{$phone}',gender='{$gender}' WHERE id='{$id}'";
$conn->query($sql);
header("location:/STEM/account.php");
?>