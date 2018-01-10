<?php
    session_start();
    error_reporting(0);
    if(!isset($_SESSION['authorized'])) {
        header("Location: ../../index.php");
    } else {
        if($_SESSION['authorized'] === false || !isset($_SESSION['username'])) {
            header("Location: ../../index.php");
        }
    }
    
    include("../../resources/info.php");
?>
<!DOCTYPE html>
<html class="textArial">
    <head>
        <title>Create an Event</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="../../css/w3-css.css">    
        <link rel="stylesheet" href="../../js/trentrichardson/jquery-ui-timepicker-addon.css">
        
        <!-- Obtained from trentrichardson.com -->
        <link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.min.js"></script>
        <script type="text/javascript" src="../../js/trentrichardson/jquery-ui-timepicker-addon.js"></script>
        <script type="text/javascript" src="../../js/trentrichardson/jquery-ui-sliderAccess.js"></script>
    </head>
    <body onresize="resizeEle();" onload="resizeEle();">
        <div id="sidebar" 
             class="sidebar w3-black w3-bar-block textContent left">
            <a href="../../index.php"><img src="../../images/logo.jpg" 
                                           alt="logo" class="menuHome" title="Go to homepage"></a>
            <a href="../notes.php" class="w3-bar-item w3-button">
                New Note
            </a>
            <a href="../organize.php" class="w3-bar-item w3-button">
                Organize and Upload
            </a>
            <a href="#" class="w3-bar-item w3-button">
                Create a Reminder
            </a>
            <a href="upcomingEvents.php" class="w3-bar-item w3-button">
                Upcoming Events <span class="notification"><?php echo getNotificationCount(); ?></span>
            </a>
            <a <?php echo "href='../" . grabUserID() . "/file_browser/index.php'"
                    ;?> class="w3-bar-item w3-button">
                My Files
            </a>
            <a href="../../about.php" class="w3-bar-item w3-button bottom">
                About Mémoire
            </a>
        </div>
        
        <div id="navigator">
            <a href="../../profile/logout.php" class="navigatorButton right">
                Log out
            </a>
            <a href="../../profile/account.php" class="navigatorButton right">
                Profile
            </a>            
        </div>
        
        <div id="content">
            <div class="outerDiv">
                <div class="innerDiv">
                    <div class="textAlignCenter" id="meetingSetUp">
                        <p class="textExtraLargeTitle">
                            Create a Reminder
                        </p>                        
                        <form method="post" action="create_event.php" onsubmit="return checkTime();">
                            <div class="col-14">
                                <div class="col-6 left">
                                    <p>
                                        Event
                                    </p>
                                    <input type="text" name="event" required 
                                           class="formBox" placeholder="Event name">
                                    <p>
                                        Location
                                    </p>
                                    <input type="text" class="formBox" 
                                           name="location" required
                                           placeholder="Event location"> 
                                    <p>
                                        Category
                                    </p>
                                    <select name="category">
                                        <option value="Entertainment" selected>Entertainment</option>
                                        <option value="Appointment">Appointment</option>
                                        <option value="Work">Work</option>
                                        <option value="Miscellaneous">Miscellaneous</option>
                                    </select>
                                </div>
                                                                
                                <div class="col-6 right">
                                    <p>
                                        Start Date and Time
                                    </p>
                                    <input type="text" id="startTime"
                                           name="startTime" class="formBox" 
                                           required placeholder="Event start in MM/DD/YYYY HH:MM"
                                           title="Event start date and time in 24 hour format, e.g. 11/11/2017 11:11">
                                    
                                    <p>
                                        End Date and Time
                                    </p>
                                    <input type="text" id="endTime" 
                                           name="endTime" class="formBox" 
                                           required placeholder="Event end in MM/DD/YYYY HH:MM"
                                           title="Event end date and time in 24 hour format, e.g. 11/11/2017 11:11"
                                           onchange="checkTime();">
                                </div>
                            </div>
                            
                            <div class="col-14 clearBoth">
                                <p class="clearBoth textError" id="timeError" style="padding-top:25px"></p>
                                                                
                                <p class="clearBoth">
                                        <input type="submit" value="Create">
                                        <input type="button" value="Cancel"
                                               onclick="navigateToIndex()">
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="../../js/resize.js"></script>
        <script>
            $(document).ready(function() {
                $('#startTime').datetimepicker();
                $('#endTime').datetimepicker();
            });
        </script>
        <script src="../../js/navigation.js"></script>
        <script src="../../js/formValidation.js"></script>
    </body>
</html>
