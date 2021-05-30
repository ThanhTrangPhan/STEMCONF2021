<?php
    // Initialize the session
     
    //Check if the user is already logged in, if yes then redirect him to welcome page
    // if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    //     header("location: /STEM/main_user.php");
    //     exit;
    // }
     
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
            header("location:/STEM/login.php");
        } else{
            $email = trim($_POST["email"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password_err = "Hãy nhập password.";
            header("location:/STEM/login.php");
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
                        mysqli_stmt_bind_result($stmt,$id,$fullname,$email,$ori_password,$dob,$phone,$gender );
                        if(mysqli_stmt_fetch($stmt)){
                            if(sha1($password) == $ori_password){
                                // Password is correct, so start a new session
                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["fullname"] = $fullname;                            
                                $_SESSION["email"] = $email;  
                                $_SESSION["password"] = $password;  
                                $_SESSION["dob"] = $dob;
                                $_SESSION["phone"] = $phone;
                                $_SESSION["gender"] = $gender;    
                                // Redirect user to welcome page                           
                                header("location:/STEM/main_user.php");
                            } else{
                                // Password is not valid, display a generic error message
                                $login_err = "Nhập sai password.";
                                header("location:/STEM/login.php");
                            }
                        }
                    } else{
                        // Username doesn't exist, display a generic error message
                        $login_err = "Nhập sai email.";
                        header("location:/STEM/login.php");
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