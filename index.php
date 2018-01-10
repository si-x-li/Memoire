<?php 
    session_start();
    error_reporting(0);
    if(isset($_SESSION['authorized'])){
        if($_SESSION['authorized'] === TRUE && isset($_SESSION['username'])) {
            header("Location: welcome.php");
        }
    }
?>

<!DOCTYPE html>
<html class="textArial">
    <head>
        <title>Log in to Mémoire</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body id="loginScreen">
        <div class="outerDiv">
            <div class="innerDiv">
                <div class="loginContainer textAlignCenter">
                    <div class="imageContainer">
                        <img src="images/logo.png" alt="Memoire LOGO"
                             style="width:400px">
                    </div>
                    <form method="post" 
                          action="resources/login.php">
                        <p class="textLargeContent noMargin left">
                            Username
                        </p>
                        <input name="username" type="text" class="loginBox" 
                               required title="Your username">

                        <p class="textLargeContent noMargin left">
                            Password
                        </p>
                        <input name="password" type="password" class="loginBox" 
                               required title="Your password">
                        <p class="textError">
                            <?php 
                                if(!isset($_SESSION['loginAttempts'])) {
                                    $_SESSION['loginAttempts'] = 0;
                                }
                                if($_SESSION['loginAttempts'] > 5) {
                                    echo "Have You Forgotten Your Password?";
                                } 
                                else{
                                    if(isset($_GET['error'])) {
                                        echo $_GET['error'];
                                    }
                                }
                                ?>
                        </p>  
                        
                        <p style="color: #09863e">
                            <?php 
                                if(isset($_GET['notification'])) {
                                    echo $_GET['notification'];
                                }
                            ?>
                        </p>
                        
                        <input type="submit" class="submitLogin" 
                               value="Login">
                        <p class="textLargeContent">
                            <a href="resources/registration/register.php">
                                New User? Register Here!
                            </a>
                        </p>
                        <p class="textLargeContent">
                            <a href="resources/recovery/forgot_password.php">
                                Forgot Password?
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
