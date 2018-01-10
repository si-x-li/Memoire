<?php
    session_start();
    require("resources/info.php");
    error_reporting(0);
    if(!isset($_SESSION['authorized'])) {
        header("Location: index.php");
    } else {
        if($_SESSION['authorized'] === false || !isset($_SESSION['username'])) {
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html class="textArial">
    <head>
        <title>Welcome <?php echo $_SESSION['username']; ?>!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="css/w3-css.css">        
    </head>
    <body onresize="resizeEle();" onload="resizeEle();">
        <div id="sidebar" 
             class="sidebar w3-black w3-bar-block textContent left">
            <a href="#"><img src="images/logo.jpg" alt="logo" 
                             class="menuHome"></a>
            <a href="features/notes.php" class="w3-bar-item w3-button">
                New Note
            </a>
            <a href="features/organize.php" class="w3-bar-item w3-button">
                Organize and Upload
            </a>
            <a href="features/meeting/set_up_meeting.php" 
               class="w3-bar-item w3-button">
                Create a Reminder
            </a>
            <a href="features/meeting/upcomingEvents.php" 
               class="w3-bar-item w3-button">
                Upcoming Events <span class="notification"><?php echo getNotificationCount(); ?></span>
            </a>
            <a <?php echo "href='features/" . grabUserID() . "/file_browser/index.php'"; ?> class="w3-bar-item w3-button">
                My Files
            </a>
            <a href="about.php" class="w3-bar-item w3-button bottom">
                About Mémoire
            </a>
        </div>
        
        <div id="navigator">
            <a href="profile/logout.php" class="navigatorButton right">
                Log out
            </a>
            <a href="profile/account.php" class="navigatorButton right">
                Profile
            </a>            
        </div>
        
        <div id="content">
            <div class="outerDiv">
                <div class="innerDiv">
                    <div class="textAlignCenter">
                        <p class="textExtraLargeTitle">
                            Welcome to Mémoire <?php echo $_SESSION['username']; ?>!
                        </p>                        
                        <p class="textLargeContent">
                            Note taking revolutionized
                        </p>
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
        
        <script src="js/resize.js"></script>
    </body>
</html>


