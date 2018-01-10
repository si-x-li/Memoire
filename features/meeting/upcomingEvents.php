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
            <a href="#" class="w3-bar-item w3-button">
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
                    if(getNotificationCount() === 0) {
                        echo "<div class='outerDiv'><div class='innerDiv'>"
                                . "<div class='textAlignCenter'>"
                                   . "<p class='textExtraLargeTitle'>"
                                      . "Upcoming Events"
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
                                    . "Upcoming Events"
                                . "</p>"
                             . "</div>"
                             . "<div class='col-14'>";
                    }
                    
                    $data = getNotifications();
                    
                    $week_0to1 = array();
                    $week_2to4 = array();
                    $month_1to3 = array();
                    $month_4to12 = array();
                    $future = array();
                    
                    $events = array($week_0to1, $week_2to4, $month_1to3, 
                        $month_4to12, $future);
                    
                    for($i = 0; $i < count($data); $i++) {
                        $date = substr($data[$i][1], 0, 10);
                        $date1 = date_create($date);
                        $date2 = date_create(date('Y-m-d'));
                    
                        $difference = date_diff($date2, $date1);
                        $difference = $difference->format("%R%a days");
                        $difference = preg_replace("[^0-9\s]", "", $difference);
                        
                        if($difference <= 7) {
                            $events[0][] = array("start_date" => $data[$i][1],
                                "end_date" => $data[$i][2],
                                "location" => $data[$i][3],
                                "event" => $data[$i][4],
                                "meetingID" => $data[$i][5],
                                "category" => $data[$i][6]); 
                        } else if ($difference > 7 && $difference <= 28) {
                            $events[1][] = array("start_date" => $data[$i][1],
                                "end_date" => $data[$i][2],
                                "location" => $data[$i][3],
                                "event" => $data[$i][4],
                                "meetingID" => $data[$i][5],
                                "category" => $data[$i][6]);                             
                        } else if ($difference > 28 && $difference <= 90) {
                            $events[2][] = array("start_date" => $data[$i][1],
                                "end_date" => $data[$i][2],
                                "location" => $data[$i][3],
                                "event" => $data[$i][4],
                                "meetingID" => $data[$i][5],
                                "category" => $data[$i][6]);                             
                        } else if ($difference > 90 && $difference <= 365) {
                            $events[3][] = array("start_date" => $data[$i][1],
                                "end_date" => $data[$i][2],
                                "location" => $data[$i][3],
                                "event" => $data[$i][4],
                                "meetingID" => $data[$i][5],
                                "category" => $data[$i][6]);                             
                        } else {
                            $events[4][] = array("start_date" => $data[$i][1],
                                "end_date" => $data[$i][2],
                                "location" => $data[$i][3],
                                "event" => $data[$i][4],
                                "meetingID" => $data[$i][5],
                                "category" => $data[$i][6]);                             
                        }
                    }
                    
                    for($i = 0; $i < count($events); $i++) {
                        if(count($events[$i]) > 0) {
                            for($j = 0;$j < count($events[$i]);$j++){
                                if($i === 0 && $j === 0) {
                                    echo "<p><b>In 1 to 7 days</b></p>";
                                } else if ($i === 1 && $j === 0) {
                                    echo "<p><b>In 2 to 4 weeks</b></p>";
                                } else if ($i === 2 && $j === 0) {
                                    echo "<p><b>In 1 to 3 months</b></p>";
                                } else if ($i === 3 && $j === 0) {
                                    echo "<p><b>In 3 to 12 months</b></p>";
                                } else if ($i === 4 && $j === 0) {
                                    echo "<p><b>In 1 year or more</b></p>";
                                }
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
