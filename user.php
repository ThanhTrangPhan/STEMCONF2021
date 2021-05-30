<?php 
include "connect_db.php";

session_start();
if (isset($_SESSION['id'])) {
	$id=$_SESSION['id'];

	$sql = "SELECT * FROM user WHERE id = '{$id}'";
	
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	mysqli_stmt_bind_result($stmt,$id,$fullname,$email, $ori_password,$dob,$phone,$gender,$ticket,$note);
	mysqli_stmt_fetch($stmt);

	session_start();

    $_SESSION['id'] = $id;
    $_SESSION['fullname'] = $fullname;                            
    $_SESSION['email'] = $email;    
    $_SESSION['dob'] = $dob;
    $_SESSION['phone'] = $phone;
    $_SESSION['gender'] = $gender; 
    $_SESSION['ticket']=$ticket;
    $_SESSION['timer']=$note;
    mysqli_stmt_close($stmt);
}
 mysqli_close($conn);
?>