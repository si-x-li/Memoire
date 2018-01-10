<?php 

    session_start();   
    include("PDOMySQL.php");
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    /**
     * TODO add password hashing
     */
    $sql = "SELECT * FROM members WHERE username = ? AND password = ?";
    $args = array("$username", "$password");
    
    $obj = new PDOMySQL();
    $result = $obj->query($sql, $args);
    
    if(count($result) === 1) {
        $_SESSION['authorized'] = true;
        $_SESSION['username'] = $username;
        header("Location: ../welcome.php");
    }
    
    else {
        $_SESSION['authorized'] = false;
        if(!isset($_SESSION['loginAttempts'])) {
            $_SESSION['loginAttempts'] = 0;
        }
        $_SESSION['loginAttempts'] = $_SESSION['loginAttempts'] + 1;
        header("Location: ../index.php?error=This+Combination+Does+Not+Exist!");
    }
