<?php
    
    require('PDOMySQL.php');

    checkUsername();
    
    function checkUsername() {
        $sql = "SELECT * FROM members WHERE username = ?";
        $args = array($_GET['username']);

        $obj = new PDOMySQL();
        $result = $obj->query($sql, $args);

        if (count($result) === 0) {
            return true;
        }

        echo "Username is not available!";
        return false;
    }
