<?php
    session_start();
//    error_reporting(0);
    if(!isset($_SESSION['authorized'])) {
        header("Location: ../../index.php");
    } else {
        if($_SESSION['authorized'] === false || !isset($_SESSION['username'])) {
            header("Location: ../../index.php");
        }
    }
    
    if(!isset($_POST['startTime']) || !isset($_POST['endTime'])) {
        header("Location: upcomingEvents.php");
    }
    
    include("../../resources/info.php");
    
    $start_day;
    $start_month;
    $start_year;
    $start_hour;
    $start_minute;
    
    $end_day;
    $end_month;
    $end_year;
    $end_hour;
    $end_minute;
    
    $start = $_POST['startTime'];
    $end = $_POST['endTime'];
        
    $start_month = substr($start, 0, 2);
    $start_day = substr($start, 3, 2);
    $start_year = substr($start, 6, 4);
    $start_hour = substr($start, 11, 2);
    $start_minute = substr($start, 14, 2);
    
    $end_month = substr($end, 0, 2);
    $end_day = substr($end, 3, 2);
    $end_year = substr($end, 6, 4);
    $end_hour = substr($end, 11, 2);
    $end_minute = substr($end, 14, 2);
    
    // Make start time and end time MySQL compliant
    $startTime = $start_year . "-" . $start_month . "-" . $start_day . " " 
            . $start_hour . ":" . $start_minute . ":00";
    
    $endTime = $end_year . "-" . $end_month . "-" . $end_day . " " 
            . $end_hour . ":" . $end_minute . ":00";
    
    
?>

<!DOCTYPE html>
<html class="textArial">
    <head>
        <title>Upcoming Events</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="../../css/w3-css.css">    
        <script src="../../js/resize.js"></script>
    </head>
    <body onresize="resizeEle();">
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
            <a href="set_up_meeting.php" class="w3-bar-item w3-button">
                Create a Reminder
            </a>
            <a href="upcomingEvents.php" class="w3-bar-item w3-button">
                Upcoming Events <span class="notification"><?php echo getNotificationCount(); ?></span>
            </a>
            <a href="search_by_time.php" class="w3-bar-item w3-button">
                <span style="margin-left: 40px;">Search by Time</span>
            </a>
            <a href="order.php?ind=Entertainment" class="w3-bar-item w3-button">
                <span style="margin-left: 40px;">Entertainment</span>
            </a>
            <a href="order.php?ind=Appointment" class="w3-bar-item w3-button">
                <span style="margin-left: 40px;">Appointment</span>
            </a>
            <a href="order.php?ind=Work" class="w3-bar-item w3-button">
                <span style="margin-left: 40px;">Work</span>
            </a>
            <a href="order.php?ind=Miscellaneous" class="w3-bar-item w3-button">
                <span style="margin-left: 40px;">Miscellaneous</span>
            </a>
            <a <?php echo "href='../" . grabUserID() . "/file_browser/index.php'"; ?>
                class="w3-bar-item w3-button">
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
            <div class="col-15">
                <?php
                    $data = getNotificationsByTime($startTime, $endTime);
                    
                    if(count($data) === 0) {
                        echo "<div class='outerDiv'><div class='innerDiv'>"
                                . "<div class='textAlignCenter'>"
                                   . "<p class='textExtraLargeTitle'>"
                                      . "Upcoming Events Between " . $startTime . " and " . $endTime
                                   . "</p>"
                                   . "<p>"
                                      . "Nothing to see here! You're all caught up on "
                                      . "your reminders!"
                                   . "</p>"
                                   . "<img src='../../images/background/accomplish.jpg'"
                                      . " width='50%'>"
                                . "</div>"
                             . "</div></div>";
                    } else {
                        echo "<div class='textAlignCenter'>"
                                . "<p class='textExtraLargeTitle'>"
                                    . "Upcoming Events Between " . $startTime . " and " . $endTime
                                . "</p>"
                             . "</div>"
                             . "<div class='col-14'>";
                    }
                    $events = array();
                    
                    for($i = 0; $i < count($data); $i++) {
                        $events[0][] = array("start_date" => $data[$i][1],
                                "end_date" => $data[$i][2],
                                "location" => $data[$i][3],
                                "event" => $data[$i][4],
                                "meetingID" => $data[$i][5],
                                "category" => $data[$i][6]); 
                    }
                    
                    for($i = 0; $i < count($events); $i++) {
                        if(count($events[$i]) > 0) {
                            for($j = 0;$j < count($events[$i]);$j++){
                                echo "<div class='col-13'>"
                                        . "<table style='width:100%'>"
                                            . "<tr>"
                                                . "<td style='width:70%'>"
                                                    . "<p>"
                                                        . "Event: " . $events[$i][$j]["event"] . "<br>"
                                                        . "Start time: " . $events[$i][$j]["start_date"] . "<br>"
                                                        . "End time: " . $events[$i][$j]["end_date"] . "<br>"
                                                        . "Location: " . $events[$i][$j]["location"] . "<br>"
                                                        . "Category: " . $events[$i][$j]["category"]
                                                    . "</p>"
                                                . "</td>"
                                                . "<td style='width:30%'>"
                                                    . "<form method='post' id='block" . $events[$i][$j]["meetingID"] . "'>"
                                                        . "<input type='button' value='Edit'"
                                                        .   " onclick='editEvent(" . $events[$i][$j]["meetingID"] . ");'>"
                                                        . "<input type='button' value='Delete'"
                                                        .   " onclick='deleteEvent(" . $events[$i][$j]["meetingID"] . ");'>"
                                                        . "<input type='hidden' value='" . $events[$i][$j]["meetingID"] . "'"
                                                        .   " name='meetingID'>"
                                                    . "</form>"
                                                . "</td>"
                                            . "</tr>"
                                        . "</table>"
                                    . "</div>";
                            }
                        } 
                        if($i === (count($events) - 1)) {
                            echo "</div>";
                        }
                    }
                ?>
            </div>
        </div>
        
        <script>
            function editEvent(num) {
                document.getElementById("block" + num).action = "edit_event.php";
                document.getElementById("block" + num).submit();
            }
            
            function deleteEvent(num) {
                document.getElementById("block" + num).action = "delete_event.php";
                document.getElementById("block" + num).submit();
            }
        </script>
    </body>
</html>
