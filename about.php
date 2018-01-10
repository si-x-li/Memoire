<?php
    session_start();
    error_reporting(0);
    if(!isset($_SESSION['authorized'])) {
        header("Location: index.php");
    } else {
        if($_SESSION['authorized'] === false || !isset($_SESSION['username'])) {
            header("Location: index.php");
        }
    }
    
    include ("resources/info.php");
?>

<html class="textArial">
    <head>
        <title>About Mémoire</title>
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
                             class="menuHome" title="Go to homepage"></a>
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
                        <div class="col-14">
                            <p class="textExtraLargeTitle">
                                About Mémoire
                            </p>                        
                            <p class="textLargeContent textAlignJustified">
                                Mémoire is a project created with the goal of 
                                easing communication burden. It was designed 
                                with the user in mind. Throughout the design
                                phases, we have met with numerous testers to
                                ensure system stability, usability, and 
                                efficiency. We would like to thank each tester
                                for selflessly taking time out of their day to
                                assist in the development of our project.
                            </p>
                            <p class="textLargeContent textAlignJustified">
                                We would also like to express our gratitude 
                                toward CKEditor for providing source codes for 
                                the text editor, w3schools.com for references 
                                on AJAX, JS, CSS and HTML , cam-recorder.com
                                for their webcam recording website and 
                                tutorialzine for their file browser. We would 
                                also like to thank our entire team for making 
                                this project a reality. 
                            </p>
                            <p class="textLargeContent textAlignJustified">
                                Please do not hesitate to 
                                <a href="mailto: si.x.li@mail.mcgill.ca"
                                   class="colorHyperBlue">
                                    contact us
                                </a> here if you have any questions about the
                                product. We will be more than happy to help you
                                with your inquiry.
                            </p>
                            <p class="textContent">
                                &copy; Mémoire - 2017
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="js/resize.js"></script>
    </body>
</html>
