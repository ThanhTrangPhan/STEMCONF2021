<?php   
    session_start();
    include ('user.php');
    if (isset($_SESSION['id'])) {
        $user= array($_SESSION['id'],$_SESSION['fullname'],$_SESSION['email'],$_SESSION['dob'],$_SESSION['phone'],$_SESSION['gender'],$_SESSION['ticket'],$_SESSION['timer']);
    }
    if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['name']);
    header("location: main.php");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STEMCONF 2021</title>
    <link rel="shortcut icon" href="media/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/update_info.js"></script>
    <script type="text/javascript" src="js/active_nav_li.js"></script>
    <script type="text/javascript" src="js/open_content.js"></script>  
    <script type="text/javascript" src="js/choose_theme.js"></script>
    <script type="text/javascript" src="js/bookStage.js"></script>
    <script type="text/javascript" src="js/showSchedule.js"></script>
    <script type="text/javascript" src="js/setTimer.js"></script>
    <script type="text/javascript" src="js/cancelSchedule.js"></script>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
    
    <!-- navbar: -->
    <nav class="navbar navbar-default navbar-fixed-top" id="mynavbar">
        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
              <a class="navbar-brand" href="main_user.php"><span class="conf">stemconf</span> </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav navbar-right">
                <li><a class="nav-item" href="main_user.php">Trang chủ</a></li>
                <li><a class="nav-item" href="schedule.php">Lịch chương trình</a></li>
                <li><a class="nav-item" href="#">Tài khoản</a></li>
                <li><a class="nav-item" href="main_user.php?logout='1'">Đăng xuất</a></li>
              </ul>
            </div>
        </div>
    </nav>
    <br><br><br><br>
    <div class="container">
        
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <br><br><br>
                <?php
                if($user[5]=="Nam"){
                    echo "<img src='media/1.png' style='border-radius: 50%;width: 350px; height: auto;'>";
                } else {
                    echo "<img src='media/2.png' style='border-radius: 50%;width: 350px; height: auto;'>";
                }
                ?>
            </div>
            <div class="col-sm-0"></div>
            <div class="col-sm-8">
                <h1>Thông tin cá nhân</h1>
                    
                        <form action="update_info.php" method="POST" id="personal">
                            <div class="row">
                                <div class="col-sm-6">
                                   
                                  <label for ="name ">Họ và tên : </label>
                                  <input type="text" id="name" name="name" value="<?php echo $user[1] ?>" class="form-control well well-sm" disabled>
                               
                                  <label for ="email ">Email : </label>
                                  <input type="text" id="email" name="email" value="<?php echo $user[2] ?>" class="form-control well well-sm" disabled>
                                
                                  <label for ="dob">Ngày sinh: </label>
                                  <input type="text" id="dob" name="dob" value="<?php echo $user[3] ?>" class="form-control well well-sm" disabled >
                                
                                </div>
                                <div class="col-sm-6">
                                    
                                  <label for ="id">ID : </label>
                                  <input type="text" id="id" name="id" value="<?php echo $user[0] ?>" class="form-control well well-sm" disabled>
                                
                                
                                  <label for ="phone ">Số điện thoại: </label>
                                  <input type="text" id="phone" name="phone" value="<?php echo $user[4] ?>" class="form-control well well-sm"disabled >
                                
                                  <label for ="gender">Giới tính: </label>
                                  <input type="text" id="gender" name="gender" value="<?php echo $user[5] ?>" class="form-control well well-sm" disabled >
                            
                            </div>
                            </div>
                            <button type="button" id="change" class="btn btn-danger hover" name="btn" value="change" onclick="changeInfo()">Thay đổi thông tin</button>
                        </form>
                        <!-- <div class="col-sm-6">
                            <p style="padding: 0px;">Họ và tên:</p>
                            <div class="well well-sm" id="name">
                                <?php echo $user[1] ?>
                            </div>
                            <p style="padding: 0px;">Email:</p>
                            <div class="well well-sm" id="email">
                                <?php echo $user[2] ?>
                            </div>
                            <p style="padding: 0px;">Ngày sinh:</p>
                            <div class="well well-sm" id="dob">
                                <?php echo $user[3] ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <p style="padding: 0px;">ID:</p>
                            <div class="well well-sm" id="id">
                                <?php echo $user[0] ?>
                            </div>
                            <p style="padding: 0px;">Số điện thoại:</p>
                            <div class="well well-sm" id="phone">
                                <?php echo $user[4] ?>
                            </div>
                            <p style="padding: 0px;">Giới tính:</p>
                            <div class="well well-sm" id="gender">
                                <?php echo $user[5] ?>
                            </div>
                            <button type="button" class="btn btn-danger" onclick="change_info()" style="font-size:14px;" id="change" value="change">Thay đổi thông tin</button>
                        </div> -->
                    

                
            </div>
        </div>
    </div>
    <br><br><br><br>
    <div class="container tab">
      <button class="tablinks" onclick="openEvent(event, 'interest')">Nội dung quan tâm </button>
      <button class="tablinks" onclick="openEvent(event, 'stage')">Đăng kí stage</button>
      <button class="tablinks" onclick="openEvent(event, 'option')">Tùy chọn</button>
    </div>

    <div id="interest" class="container tabcontent">
        <h3>Nội dung quan tâm</h3>
        <div class="row">
            <div class="col-sm-10" >

                <form action="" style="width:350px;"> 
                    <select name="interest_theme" onchange="showSubject(this.value)" id="select_theme">
                        <option value="" >Chọn 1 chủ đề bạn quan tâm...</option>
                        <option value="Công nghệ xanh và thông minh">Công nghệ xanh và thông minh - 12/6/2021</option>
                        <option value="Điện toán đám mây và siêu máy tính">Điện tử đám mây và siêu máy tính - 13/6/2021</option>
                        <option value="Vật liệu">Vật liệu - 14/6/2021</option>
                    </select>
                </form>
                <br>
                
            </div>

        </div>
        <div id="txtHint"></div>

    </div>
    </div>

    <div id="stage" class="container tabcontent">
      <h3>Đăng kí Stage</h3>
      <br><br>
      <div class="container">
        <?php
            if ($user[6]==NULL){
                echo '<div class="alert alert-danger" style="font-size:18px;">Bạn cần đăng kí vé trước khi đăng kí Stage! Hãy quay lại sau khi đăng kí vé nhé !</div>';
            }
        ?>

       
          <div class="row">
             <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="form_submit_stage">
                <div class="col-sm-6">
                    <label for="theme">Chủ đề: </label>
                    <select name="theme" id="theme" required="">
                        <option></option>
                        <option value="Công nghệ xanh và thông minh">Công nghệ xanh và thông minh - 12/6/2021</option>
                        <option value="Điện toán đám mây và siêu máy tính">Điện toán đám mây và siêu máy tính - 13/6/2021</option>
                        <option value="Vật liệu">Vật liệu - 14/6/2021</option>
                    </select>
                    <br><br><br>
                    <label for="timeOn">Thời gian:</label>
                    <input type="time" id="timeOn" name="timeOn" required="">
                    <br><br><br>
                    <label for="subject">Nội dung:</label>
                    <input type="text" id="subject" name="subject" required="">
                    <br><br><br>
                    <button type="submit" class="btn btn-danger hover-1" name="book_stage"  style="margin:5px 100px;">Đăng kí </button>
                </div>
                <div class="col-sm-6">
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
            mysqli_close($conn);
            ?>
                    <?php 
                    if(!empty($messg)){
                            echo '<div class="alert alert-success">' . $messg . '</div>';
                        } 
                    ?>
                </div>
            </form>
          </div>
      </div>
    </div>

    
    <div id="option" class="container tabcontent">
      <h3>Tùy chọn </h3><br><br>
      <div class="container">
          <div class="row">
            <div class="col-sm-2"></div>
              <div class="col-sm-6">
                  <button class="btn btn-danger hover" onclick="showSchedule(<?php echo $user[0]?>)">Lịch trình của <?php echo $user[1]?></button>

                  <br><br><br><br>
              </div>

          </div>
          <div id="txtHint2"></div><br><br>
          <div class="row">
              <div class="col-sm-5">
              <label for = "datetime"  >Đặt hẹn giờ:</label>
              <input type="datetime-local" id="datetime" name="datetime" value="2021-06-12T09:00:00">
              <button onclick="setTimer()">Hẹn giờ</button>
              </div>
              <div class="col-sm-7">
                  <div id="timer" onload="doTimer()" onchange="doTimer()" style="font-family:'Montserrat-SemiBold';font-size:30px ;color: white;"></div>
              </div>
          </div>
      </div>
      
      
    </div>

    <footer class="container-fluid" id="contact" style="padding-bottom: 20px; margin-bottom: 10px;">
        <div class="row">
            <div class="col-sm-5">
                <p><span class="conf">stemconf 2021</span> </p>
                <p style="padding: 0px 95px 20px 95px;">STEMCONF 2021 là chuỗi hội thảo dưới sự bảo hộc của tổ chức STEM Quốc tế. Mọi hoạt động tổ chức đều hướng đến mục đích thảo luận, nghiên cứu.</p>
                <div id="menu-icon">
                    <a href="https://twitter.com/"><img src="media/twitter-3.svg"></a> &nbsp
                    <a href="https://www.facebook.com/"><img src="media/1200px-Facebook_circle_pictogram.svg.png"></a> &nbsp
                    <a href="https://mail.google.com/mail/u/0/#inbox"><img src="media/gmail-icon-logo-9ADB17D3F3-seeklogo.com.png"></a> &nbsp
                    <a href="https://www.instagram.com/"><img src="media/ce104e6527a9a9ea6a725b558a56ef9b.png"></a> &nbsp
                    <a href="https://www.pinterest.com/"><img src="media/pinterest-3.svg"></a> &nbsp
                </div> 

            </div>
            <div class="col-sm-3">
                <h3 style="padding-top:20px;">Liên hệ</h3>
                <p style="padding:0px"><span class="glyphicon glyphicon-map-marker"></span> Trung tâm Hội nghị Quốc gia Việt Nam, Phạm Hùng, Nam Từ Liêm, Hà Nội</p>
                <p style="padding:0px"><span class="glyphicon glyphicon-phone"></span> +84 1515151515</p>
                <p style="padding:0px"><span class="glyphicon glyphicon-envelope"></span>  stemconf2021@gmail.com</p>
            </div>
            <div class="col-sm-4">
                <h3 style="padding-top:20px;">Nhận thư thông báo</h3>
                <p style="padding:0px"> Đăng kí nhận thư về hội thảo.<br>Đừng bỏ lỡ sự kiện quan trọng !</p>
                <form class="form-horizontal" action="/action_page.php">
                    <div class="form-group">   
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" placeholder="Nhập email ..." name="email">
                      </div>
                    </div>
                   
                    <div class="form-group">        
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-dange hover-1">Đăng kí</button>
                      </div>
                    </div>
                </form>
            </div>
        </div>
    </footer>

</body>
</html>