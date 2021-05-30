<?php 
session_start();
include 'connect_db.php';
$id = $_SESSION['id'];  
$timer = $_POST['timer'];  

$sql = "UPDATE user SET note='{$timer}' WHERE ID='{$id}'";
$conn->query($sql);

	

?>