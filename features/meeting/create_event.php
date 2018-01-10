<?php
    require("../../resources/info.php");
    
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
    
    $id = grabUserID();
    $start = $_POST['startTime'];
    $end = $_POST['endTime'];
    $event = $_POST['event'];
    $location = $_POST['location'];
    $category = $_POST['category'];
        
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
    $start = $start_year . "-" . $start_month . "-" . $start_day . " " 
            . $start_hour . ":" . $start_minute . ":00";
    
    $end = $end_year . "-" . $end_month . "-" . $end_day . " " 
            . $end_hour . ":" . $end_minute . ":00";
    
    $obj = new PDOMySQL();
    $sql = "insert into meeting (initiate, startDate, endDate, location, event, category)"
            . " values (?, ?, ?, ?, ?, ?)";
    $args = array($id, $start, $end, $location, $event, $category);
    $obj->query($sql, $args);
    
    header("Location: ../../welcome.php?notification=Reminder+created+successfully!");
    