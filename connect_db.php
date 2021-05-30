<?php
session_start();
$host="localhost";
$username="root";
$password="";
$database="stem";
$conn=mysqli_connect($host,$username,$password,$database);
mysqli_query($conn,"SET NAMES 'utf8'");

?>