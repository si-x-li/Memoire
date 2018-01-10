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
    
    $email = $_POST['email'];
    $userID = grabUserID();

    $sql = "update " . DB_NAME . ".user set userEmail = ? where userID = ?";
    $args = array($email, $userID);
    
    $obj = new PDOMySQL();
    $obj->query($sql, $args);
    
    header("Location: ../account.php?notification=Email+changed+successfully!");
