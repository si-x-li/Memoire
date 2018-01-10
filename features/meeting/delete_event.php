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
        
    removeNotification($_POST['meetingID']);
    
    header("Location: ../../welcome.php?notification=Reminder+removed+successfully!");
    
