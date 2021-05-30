<?php 
session_start();
include 'connect_db.php';
$id = $_POST['no'];  

$sql = "DELETE FROM speaker WHERE no='{$id}'";
$conn->query($sql);
$conn->close();
?>