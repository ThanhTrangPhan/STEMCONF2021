<?php 
session_start();
include"connect_db.php";
$id= $_SESSION['id'];

$sql = "SELECT no FROM speaker WHERE ID_user ='{$id}' ORDER BY timeOn ASC, stage ASC ";

$stmt = $conn->prepare($sql);

if($stmt->execute()){
    $stmt->bind_result($no);  
    $no_schedule=array();
    while($stmt->fetch()){     
		$no_schedule[]=$no;
    }
    $list =json_encode($no_schedule);
    echo $list;
}
?>