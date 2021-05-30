<?php
session_start();
include "connect_db.php";
$sql = "INSERT INTO user(note) VALUES(?) ";


$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_GET['q']);

$stmt->execute();
$stmt->close();
$conn->close();
?>