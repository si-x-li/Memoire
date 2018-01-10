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
                            Change Password
                        </p>   
                        <div class="col-12">
                            <form action="database/changePasswordInDB.php"
                                  method="post"
                                  onsubmit="return checkPassword();">
                                <p>
                                    Password
                                </p>
                                <input type="password" class="formBox"
                                       name="password" id="password" 
                                       placeholder="Your new password"
                                       required>

                                <p>
                                    Confirm Password
                                </p>
                                <input type="password" class="formBox" 
                                       id="confirmPassword" 
                                       onkeyup="checkPassword();" 
                                       placeholder="Confirm your new password"
                                       required>
                                <p><br></p>
                                <div id="passwordError" class="textError"></div>
                                
                                <p>
                                    <input type="submit" value="Submit">
                                    <input type="button" value="Cancel"
                                           onclick="navigateToProfile()">
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="../js/navigation.js"></script>
        <script src="../js/resize.js"></script>
        <script src="../js/formValidation.js"></script>
    </body>
</html>
