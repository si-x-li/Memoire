<?php
    session_start();
    include("../../resources/info.php");
    include("../../resources/config/DB_Config.php");
    
    if(!isset($_SESSION['authorized'])) {
        header("Location: ../../index.php");
    } else {
        if($_SESSION['authorized'] === false || !isset($_SESSION['username'])) {
            header("Location: ../../index.php");
        }
    }
    
    
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userID = grabUserID();
    
    $sql = "update " . DB_NAME . ".user set userFirstName = ?, "
            . "userLastName = ? where userID = ?";
    $args = array($firstName, $lastName, $userID);
    
    $obj = new PDOMySQL();
    $obj->query($sql, $args);
    
    header("Location: ../account.php?notification=Name+changed+successfully!");

