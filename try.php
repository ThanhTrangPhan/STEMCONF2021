 <?php 
session_start();
include 'connect_db.php';
$theme = $_POST['theme'];  
$time = $_POST['time'];  
$sub = $_POST['sub'];
$id = $_SESSION['id'];
$sql = "SELECT ID_user FROM speaker WHERE theme='{$theme}' AND timeON='{$time}'";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
mysqli_stmt_bind_result($stmt,$id);
mysqli_stmt_fetch($stmt);
echo "string";
if(mysqli_stmt_num_rows($stmt) == 3){
    echo "<div class='alert alert-danger' style='font-size:18px;'>Đã hết stage vào khung giờ".$time." này! Hãy chọn khung giờ khác !</div>";
} else {
    if (mysqli_stmt_num_rows($stmt) == 2){
    echo "<div class='alert alert-success' style='font-size:18px;'>Đã thành công đặt stage vào khung giờ".$time." này! Stage của bạn là stage 3 !</div>";
    $stage = 3;
    }else if (mysqli_stmt_num_rows($stmt) == 1){
    echo "<div class='alert alert-success' style='font-size:18px;'>Đã thành công đặt stage vào khung giờ".$time." này! Stage của bạn là stage 2 !</div>";
    $stage = 2;
    }else if (mysqli_stmt_num_rows($stmt) == 0){
    echo "<div class='alert alert-success' style='font-size:18px;'>Đã thành công đặt stage vào khung giờ".$time." này! Stage của bạn là stage 1 !</div>";
    $stage = 1;
    }   
    $sql = "INSERT INTO speaker(ID_user,theme,subject,timeOn,stage) VALUES('{$id}','{$theme}','{$subject}','{$time}','{$stage}') ";
    $conn->query($sql);
}
?>