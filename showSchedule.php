<?php
include"connect_db.php";
$id= $_GET['q'];
$date="";
$sql = "SELECT no,theme,subject,timeOn,stage FROM speaker WHERE ID_user ='{$id}' ORDER BY timeOn ASC, stage ASC ";

$stmt = $conn->prepare($sql);

if($stmt->execute()){
    $stmt->bind_result($no,$theme,$subject,$time,$stage);
    $detail = array();  
    $no_schedule=array();
    while($stmt->fetch()){     
        if($theme=="Vật liệu"){
		    $date = "14-6-2021";
		} else if($theme =="Công nghệ xanh và thông minh"){
		    $date="12-6-2021";
		} else {
		    $date ="13-6-2021";
		}
		$detail[]=array($theme,$subject,$time,$stage,$date);
		$no_schedule[]=$no;
    }
    $list =json_encode($no_schedule);
    echo $list;
    
    echo "<div class='container' id='table'>";
	echo "<div class='row'>";
	echo "<div class='col-sm-1'>";
	echo "<p style='padding:0px;'>STT</p>";
	echo "</div>";
	echo "<div class='col-sm-2'>";
	echo "<p style='padding:0px;'>Chủ đề</p>";
	echo "</div>";
	echo "<div class='col-sm-2'>";
	echo "<p style='padding:0px;'>Nội dung</p>";
	echo "</div>";
	echo "<div class='col-sm-2'>";
	echo "<p style='padding:0px;'>Ngày</p>";
	echo "</div>";
	echo "<div class='col-sm-2'>";
	echo "<p style='padding:0px;'>Thời gian</p>";
	echo "</div>";
	echo "<div class='col-sm-1'>";
	echo "<p style='padding:0px;'>Stage</p>";
	echo "</div>";
	echo "<div class='col-sm-2'>";
	echo "<p style='padding:0px;'>Tác vụ</p>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "<br>";
	$row= mysqli_stmt_num_rows($stmt);
    for ($i=0;$i<$row;++$i){
		 $stt=$i+1;
		    echo "<div class='container' id ='row".$i."'>";
			echo "<div class='row'>";
			echo "<div class='col-sm-1'>";
			echo "<p style='padding:0px;'>".$stt."</p>";
			echo "</div>";
			echo "<div class='col-sm-2'>";
			echo "<p style='padding:0px;'>".$detail[$i][0]."</p>";
			echo "</div>";
			echo "<div class='col-sm-2'>";
			echo "<p style='padding:0px;'>".$detail[$i][1]."</p>";
			echo "</div>";
			echo "<div class='col-sm-2'>";
			echo "<p style='padding:0px;'>".$detail[$i][4]."</p>";
			echo "</div>";
			echo "<div class='col-sm-2'>";
			echo "<p style='padding:0px;'>".$detail[$i][2]."</p>";
			echo "</div>";
			echo "<div class='col-sm-1'>";
			echo "<p style='padding:0px;'>".$detail[$i][3]."</p>";
			echo "</div>";
			echo "<div class='col-sm-2'>";
			echo "<button class='btn btn-danger hover' style='width:80px;height:20px;padding:0px;font-size:10px; margin:0px;' onclick='cancelSchedule(".$i.")'>Hủy</button>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "<br>";


	} 

}
    
$stmt->close();

?>