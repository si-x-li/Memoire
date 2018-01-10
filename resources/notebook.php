<?php
    if(!session_id()) {
        session_start();
    }

    include("info.php");

    function createNotebook($fileName, $description, $date) {
        $id = grabUserID();
        $sql = "Insert into notebook (ownerID, fileName, description, creationDate) VALUES (?, ?, ?, ?)";
        $args = array($id, $fileName, $description, $date);
        
        $obj = new PDOMySQL();
        count($obj->query($sql, $args));
    }
