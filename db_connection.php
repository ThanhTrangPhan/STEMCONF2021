<?php
include "connect_db.php";


$sql = "SELECT user.ID FROM user,speaker WHERE speaker.theme=? AND speaker.ID =user.ID ";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_GET['q']);

if($stmt->execute()){
    $stmt->bind_result($id);
    $detail = array();  

    while($stmt->fetch()){      

        $detail[]=$id;
    }
    $row=count($detail);
    echo "$row";
    $stmt->close();
    return $response;
} else {
    return NULL;
}
?>