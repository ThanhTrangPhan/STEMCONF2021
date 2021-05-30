<?php
include"connect_db.php";

$sql = "SELECT user.ID,speaker.timeOn,speaker.stage FROM user,speaker WHERE speaker.theme=? AND speaker.ID_user =user.ID ORDER BY speaker.timeOn ASC,speaker.stage ASC ";

$stmt = $conn->prepare($sql);
$theme= $_GET['q'];
$stmt->bind_param("s",$theme);

if($stmt->execute()){
    $stmt->bind_result($id,$timeON,$st);
    $detail = array();  
    
    while($stmt->fetch()){      

        $detail[]=$id;
    }
    echo "<div class='container'>";
	echo "<div class='row'>";
	echo "<div class='col-sm-1'>";
	echo "</div>";
	echo "<div class='col-sm-3'>";
	echo "<p style='padding:0px;'>Tên diễn giả</p>";
	echo "</div>";
	echo "<div class='col-sm-2'>";
	echo "<p style='padding:0px;'>Số điện thoại</p>";
	echo "</div>";
	echo "<div class='col-sm-3'>";
	echo "<p style='padding:0px;'>Chủ đề </p>";
	echo "</div>";
	echo "<div class='col-sm-2'>";
	echo "<p style='padding:0px;'>Thời gian</p>";
	echo "</div>";
	echo "<div class='col-sm-1'>";
	echo "<p style='padding:0px;'>Stage</p>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "<br>";
    foreach ($detail as $u){
    	$sql = "SELECT Fullname, gender, phone, subject,timeOn,stage FROM user,speaker WHERE speaker.ID_user ='{$u}' AND speaker.theme ='{$theme}' AND speaker.ID_user =user.ID";
    	$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		mysqli_stmt_bind_result($stmt,$name,$sex,$phone,$sub,$time,$stage);
		mysqli_stmt_fetch($stmt);
		    if($sex == "Nam" ){
		    	echo "<div class='container'>";
				echo "<div class='row'>";
				echo "<div class='col-sm-1'>";
				echo "<img src='media/1.png' style='border-radius: 50%;width:50px;height:50px;'>";
				echo "</div>";
				echo "<div class='col-sm-3'>";
				echo "<p style='padding:0px;'>".$name."</p>";
				echo "</div>";
				echo "<div class='col-sm-2'>";
				echo "<p style='padding:0px;'>".$phone."</p>";
				echo "</div>";
				echo "<div class='col-sm-3'>";
				echo "<p style='padding:0px;'>".$sub."</p>";
				echo "</div>";
				echo "<div class='col-sm-2'>";
				echo "<p style='padding:0px;'>".$time."</p>";
				echo "</div>";
				echo "<div class='col-sm-1'>";
				echo "<p style='padding:0px;'>".$stage."</p>";
				echo "</div>";
				echo "</div>";
				echo "</div>";
				echo "<br><br>";
		    } else{
		    	echo "<div class='container'>";
				echo "<div class='row'>";
				echo "<div class='col-sm-1'>";
				echo "<img src='media/2.png' style='border-radius: 50%;width:50px;height:50px;'>";
				echo "</div>";
				echo "<div class='col-sm-3'>";
				echo "<p style='padding:0px;'>".$name."</p>";
				echo "</div>";
				echo "<div class='col-sm-2'>";
				echo "<p style='padding:0px;'>".$phone."</p>";
				echo "</div>";
				echo "<div class='col-sm-3'>";
				echo "<p style='padding:0px;'>".$sub."</p>";
				echo "</div>";
				echo "<div class='col-sm-2'>";
				echo "<p style='padding:0px;'>".$time."</p>";
				echo "</div>";
				echo "<div class='col-sm-1'>";
				echo "<p style='padding:0px;'>".$stage."</p>";
				echo "</div>";
				echo "</div>";
				echo "</div>";
				echo "<br>";
		    }
    	}
    
	
	$stmt->close();
}

?>