<?php
    include("../info.php");
    
    if(!isset($_POST['username']) || !isset($_POST['password']) 
            || !isset($_POST['email'])) {
        header("Location: register.php");
    }
    
    $root = dirname(__FILE__, 3);
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $id = getNextAvailableID();
    $obj = new PDOMySQL();
    
    /** Create user credentials */ 
    $sql = "insert into members (username, password) values (?, ?)";
    $args = array($username, $password);
    $obj->query($sql, $args);
    
    /** Create user profile */ 
    $sql = "insert into user (userID, userEmail) values (?, ?)";
    $args = array($id, $email);
    $obj->query($sql, $args);
  
    $files = array("assets/css/styles.css", "assets/js/script.js", 
        "files/Notes/Lorem Ipsum 1.html", "files/Notes/Lorem Ipsum 2.html", 
        "files/Organize/Org1/cat.jpg", "files/Organize/Org2/Lorem Ipsum.rar", 
        "files/Organize/Org2/cat.jpg", "index.php", "scan.php");
    
    /** Copy required files to the user account */
    foreach ($files as $unique) {
        $source_file = $root . "/features/file_browser/" .  $unique;
        $destination_file = $root . "/features/" . $id . "/file_browser/" . $unique;

        $dst_info = pathinfo($destination_file);
        if(!file_exists($dst_info["dirname"])) {
            mkdir($dst_info["dirname"], 0777, true);
        } 

        copy($source_file, $destination_file);
    }
    
    header("Location: ../../index.php?notification=Account created successfully!");
    

