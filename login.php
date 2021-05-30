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
    <script type="text/javascript" src="js/scroll.js"></script>
    <script type="text/php" src = "login_from.php"></script>
</head>
<body>
	
	<!-- navbar: -->
	<nav class="navbar navbar-default">
		<div class="container-fluid" >
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>                        
		      </button>
		      <a class="navbar-brand" href="main.php"><span class="conf">stemconf 2021</span> </a>
		    </div>
		    <div class="collapse navbar-collapse" >
		      <ul class="nav navbar-nav navbar-right">
		        <li><a class="nav-item" href="main.php">Trang chủ</a></li>
		      </ul>
		    </div>
		</div>
	</nav>	

	<div class="container-fluid">
		<img src="media/bg.png" style="width: 100%; height: auto;">
	</div>
        <?php
    // Initialize the session

    session_start();
     
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: /STEM/main_user.php");
        exit;
    }
     
    // Include config file
    include "connect_db.php";
    // Define variables and initialize with empty values
    $email = $password = "";
    $email_err = $password_err = $login_err = "";
     
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
     
        // Check if username is empty
        if(empty(trim($_POST["email"]))&& !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_err = "Hãy nhập email.";
        } else{
            $email = trim($_POST["email"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password_err = "Hãy nhập password.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate credentials
        if(empty($email_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT * FROM user WHERE email = ?";
            
            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_email);
                
                // Set parameters
                $param_email = $email;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    
                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt,$id,$fullname,$email, $ori_password,$dob,$phone,$gender,$ticket,$note );
                        if(mysqli_stmt_fetch($stmt)){
                            if(sha1($password) == $ori_password){
                                // Password is correct, so start a new session
                                
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                    
                                // Redirect user to welcome page

                                header("location:/STEM/account.php");
                                exit();
                            } else{
                                // Password is not valid, display a generic error message
                                $login_err = "Nhập sai password.";
                            }
                        }
                    } else{
                        // Username doesn't exist, display a generic error message
                        $login_err = "Nhập sai email.";
                    }
                } else{
                    echo "Đã có sự cố xảy ra. Hãy đăng nhập lại! Thật xin lỗi vì sự bất tiện này.";
                }

                // Close statement
                 mysqli_stmt_close($stmt);
            }
        }
        
        // Close connection
         mysqli_close($conn);
        }
?>
	<div class="container">

	    <div class="row">
	    	<div class="col-sm-5" >
	    		<form class="form-horizontal" 
	    		action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
	    			<h1 style="padding: 35px 0px;">Đăng nhập</h1>
	    			<?php 
				        if(!empty($login_err)){
				            echo '<div class="alert alert-danger">' . $login_err . '</div>';
				        }        
			        ?>
				    <div class="form-group">   
				      <label for="email" style="color:white;">Email:</label>
				        <input type="email" class="form-control " placeholder="Nhập email" name="email">
				        <span class="invalid-feedback" style="color:white;" ><?php echo $email_err; ?></span>
				    </div>
				    
				    <div class="form-group">
					    <label for="password" style="color:white;">Password:</label>
					    <input type="password" class="form-control"  name="password" placeholder="Nhập password">
					    <span class="invalid-feedback" style="color:white;"><?php echo $password_err; ?></span>
					</div>
					<div class="form-group form-check">
					    <label class="form-check-label" style="color:white;">
					      <input class="form-check-input" type="checkbox" name="loggedin"> Ghi nhớ đăng nhập
					    </label>
					 </div>
				
				    <button type="submit" class="btn btn-dange hover-1" name="login">Đăng nhập</button>
				      
				</form>
	    	</div>
	    	<div class="col-sm-2"></div>
	    	<div class="col-sm-5">
	    		<h1 style="padding: 35px 0px;">Đăng kí</h1>
	    		<form class="form-horizontal" 
	    		action="" method="POST" >
	    			
				    <div class="form-group">   
				      <label for="email" style="color:white;">Email:</label>
				        <input type="email" class="form-control" placeholder="Nhập email" name="email">
				    </div>
				    
				    <div class="form-group">
					    <label for="password" style="color:white;">Password:</label>
					    <input type="password" class="form-control" placeholder="Nhập password" id="pwd">
					</div>
					<div class="form-group">
					    <label for="password" style="color:white;">Xác nhận lại Password:</label>
					    <input type="password" class="form-control" placeholder="Nhập password" id="pwd">
					</div>
					<div class="form-group form-check">
					    <label class="form-check-label" style="color:white;">
					      <input class="form-check-input" type="checkbox" name="loggedin"> Ghi nhớ đăng nhập
					    </label>
					 </div>
				
				    <button type="submit" class="btn btn-dange hover-1" name="register">Đăng kí</button>
				      
				</form>
	    		
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
				        <input type="email" class="form-control" id="email" placeholder="Nhập email" name="email">
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