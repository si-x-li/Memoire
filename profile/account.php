<?php
    session_start();
    error_reporting(0);
    if(!isset($_SESSION['authorized'])) {
        header("Location: ../index.php");
    } else {
        if($_SESSION['authorized'] === false || !isset($_SESSION['username'])) {
            header("Location: ../index.php");
        }
    }
    
    include("../resources/info.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Your Profile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="../css/w3-css.css">  
    </head>
    
    <body onresize="resizeEle();">
        <div id="sidebar" 
             class="sidebar w3-black w3-bar-block textContent left">
            <a href="../welcome.php"><img src="../images/logo.jpg" alt="logo" 
                             class="menuHome" title="Go to homepage"></a>
            <a href="changePassword.php" class="w3-bar-item w3-button">
                Change Password
            </a>
            <a href="changeName.php" class="w3-bar-item w3-button">
                Change Name
            </a>
            <a href="changeEmail.php" 
               class="w3-bar-item w3-button">
                Change Email
            </a>
            <a href="../about.php" class="w3-bar-item w3-button bottom">
                About Mémoire
            </a>
        </div>
        
        <div id="navigator">
            <a href="../profile/logout.php" class="navigatorButton right">
                Log out
            </a>
            <a href="../profile/account.php" class="navigatorButton right">
                Profile
            </a>            
        </div>
        
        <div id="content">
            <div class="outerDiv">
                <div class="innerDiv">
                    <div class="textAlignCenter">
                        <p class="textExtraLargeTitle">
                            Your Profile at a Glance
                        </p>   
                        <div class="col-12">
                            <p>
                                First Name
                            </p>
                            <input type="text" class="formBox" 
                                   value="<?php echo getUserFirstName(); ?>" 
                                   placeholder="Your first name" disabled/>
                            
                            <p>
                                Last Name
                            </p>
                            <input type="text" class="formBox" 
                                   value="<?php echo getUserLastName(); ?>" 
                                   placeholder="Your last name" disabled/>
                            
                            <p>
                                Email
                            </p>
                            <input type="text" class="formBox" 
                                   value="<?php echo getEmail();?>" 
                                   placeholder="Your email" disabled/>
                        </div>
                        <p style="color: #09863e">
                            <?php 
                                if(isset($_GET['notification'])) {
                                    echo $_GET['notification'];
                                }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="../js/resize.js"></script>
    </body>
</html>