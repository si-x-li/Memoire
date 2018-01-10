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
    
    $target_data_path = grabUserID() . "/file_browser/files/Notes";
    
    $title = $_POST['title'];
    $data = $_POST['data'];
        
    echo $_POST['title'];
    echo $_POST['data'];
    
    $target_data_content = $data;
    
    $target_data_path .= "/" . $title . ".html";
    
    $handle = fopen($target_data_path, "w+");
    
    $target_link_content =
            "<!DOCTYPE html>"
            . "<html>"
                . "<head>"
                    . "<title>Void</title>"
                . "</head>"
                . "<body>"
                    . "<form id='form' method='post' action='../../../../notes.php' enctype='multipart/form-data'>"
                        . "<input type='hidden' name='title' value='" . $title . "'>"
                        . "<input type='hidden' name='data' value='" . $data . "'>"
                    . "</form>"
                    . "<script>"
                        . "document.getElementById('form').submit();"
                    . "</script>"
                . "</body>"
            . "</html>";
            
    fwrite($handle, $target_link_content);
    
