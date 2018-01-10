<?php
    session_start();
    
    include("../info.php");

    if(!isset($_SESSION['idToChange']) || !isset($_POST['password'])) {
        header("Location: ../../index.php");
    }
    
    $id = $_SESSION['idToChange'];
    $password = $_POST['password'];
    
    $sql = "update " . DB_NAME . ".members set password = ? where ID = ?";
    $args = array($password, $id);
    
    $obj = new PDOMySQL();
    
    $result = $obj->query($sql, $args);
    
    header("Location: ../../index.php?notification=Password+has+been+reset+successfully!");
