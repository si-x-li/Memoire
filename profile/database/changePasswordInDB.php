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
    
    $password = $_POST['password'];
    $userID = grabUserID();

    $sql = "update " . DB_NAME . ".members set password = ? where ID = ?";
    $args = array($password, $userID);
    
    $obj = new PDOMySQL();
    $obj->query($sql, $args);
    
    header("Location: ../account.php?notification=Password+changed+successfully!");
    

