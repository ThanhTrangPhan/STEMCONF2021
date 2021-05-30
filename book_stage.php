<?php 
            session_start();
            include 'connect_db.php';
            
            $messg="";
            $date ="";
            $theme = $_POST['theme'];  
            $time = $_POST['timeOn'];  
            $sub = $_POST['subject'];
            $id = $_SESSION['id'];
            $sql = "SELECT ID_user FROM speaker WHERE theme='{$theme}' AND timeON='{$time}'";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt,$user);
            mysqli_stmt_fetch($stmt);
            if($theme=="Vật liệu"){
                $date = "14-6-2021";
            } else if($theme =="Công nghệ xanh và thông minh"){
                $date="12-6-2021";
            } else {
                $date ="13-6-2021";
            }
            if(mysqli_stmt_num_rows($stmt) == 3){
                $messg= "<div class='alert alert-danger' style='font-size:18px;'>Đã hết stage vào khung giờ ".$time." này! Hãy chọn khung giờ khác !</div>";
                

            } else {
                $stage=0;
                $row=mysqli_stmt_num_rows($stmt);
                if ($row  == 2){
                    $stage = 3;

                }else if ($row == 1){ 
                    $stage = 2;
                }else if ($row == 0){
                    $stage = 1;
                    
                }   
                $sql = "INSERT INTO speaker(ID_user,theme,subject,timeOn,stage) VALUES (?,?,?,?,?) ";
                $stmt = mysqli_prepare($conn, $sql);
                $stmt->bind_param("isssi", $id, $theme,$sub,$time,$stage);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                if($stage!=0 && $time!=""){
                    $messg=  "<div class='alert alert-success' style='font-size:18px;'>Đã thành công đặt stage vào ".$time." ! Stage của bạn là stage ".$stage.", ngày ".$date.". Để xem thông tin lịch trình của bạn, hãy vào mục Tùy chọn.</div>";
                }
                
            }
?>