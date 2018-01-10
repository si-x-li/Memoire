<?php
    if(!session_id()) {
        session_start();
    }

    require("PDOMySQL.php");
    
    function grabUserID() {
        $sql = "SELECT ID FROM members WHERE username = ?";
        $username = $_SESSION['username'];
        $args = array("$username");
        
        $obj = new PDOMySQL();
        $result = $obj->query($sql, $args);

        return $result[0][0];
    }

    function getNextAvailableID() {
        $sql = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES "
                . "WHERE TABLE_SCHEMA = '" . DB_NAME . "' AND TABLE_NAME = 'members'";
        
        $obj = new PDOMySQL();
        $result = $obj->queryWithoutArgs($sql);
        
        return $result[0][0];
    }
    
    function getUserFirstName() {
        $sql = "SELECT userFirstName FROM user WHERE userID = ?";
        $userID = grabUserID();
        $args = array($userID);
        
        $obj = new PDOMySQL();
        $result = $obj->query($sql, $args);
        
        return $result[0][0];
    }
    
    function getUserLastName() {
        $sql = "SELECT userLastName FROM user WHERE userID = ?";
        $userID = grabUserID();
        $args = array($userID);
        
        $obj = new PDOMySQL();
        $result = $obj->query($sql, $args);
        
        return $result[0][0];
    }
    
    function getEmail() {
        $sql = "SELECT userEmail FROM user WHERE userID = ?";
        $userID = grabUserID();
        $args = array($userID);
        
        $obj = new PDOMySQL();
        $result = $obj->query($sql, $args);
        
        return $result[0][0];
    }
    
    function getNotificationCount() {
        $sql = "SELECT * FROM meeting WHERE initiate = ? AND endDate > NOW(); ";
        $userID = grabUserID();
        $args = array($userID);
        
        $obj = new PDOMySQL();
        $result = $obj->query($sql, $args);
        
        return count($result);
    }
    
    function getNotificationCountByCategory($category) {
        $sql = "SELECT * FROM meeting WHERE initiate = ? AND endDate > NOW() "
                . "AND category = ?";
        $userID = grabUserID();
        $args = array($userID, $category);
        
        $obj = new PDOMySQL();
        $result = $obj->query($sql, $args);
        
        return count($result);
    }
    
    function getNotifications() {
        $sql = "SELECT * FROM meeting WHERE initiate = ? AND endDate > NOW();";
        $userID = grabUserID();
        $args = array($userID);
        
        $obj = new PDOMySQL();
        $result = $obj->query($sql, $args);
        
        return $result;
    }

    function getNotificationsByCategory($category) {
        $sql = "SELECT * FROM meeting WHERE initiate = ? AND endDate > NOW() AND"
                . " category = ?";
        $userID = grabUserID();
        $args = array($userID, $category);
        
        $obj = new PDOMySQL();
        $result = $obj->query($sql, $args);
        
        return $result;
    }
    
    function getNotificationsByTime($startTime, $endTime) {
        $sql = "SELECT * FROM meeting WHERE initiate = ? AND startDate > ? AND"
                . " endDate < ? ORDER BY startDate ASC";
        $userID = grabUserID();
        $args = array($userID, $startTime, $endTime);
        
        $obj = new PDOMySQL();
        $result = $obj->query($sql, $args);
        
        return $result;
    }
    
    function getNotification($id) {
        $sql = "SELECT * FROM meeting WHERE initiate = ? AND meetingID = ?";
        $userID = grabUserID();
        $args = array($userID, $id);
        
        $obj = new PDOMySQL();
        $result = $obj->query($sql, $args);
        
        return $result;
    }
    
    function removeNotification($id) {
        $sql = "DELETE FROM meeting WHERE initiate = ? AND meetingID = ?";
        $userID = grabUserID();
        $args = array($userID, $id);
        
        $obj = new PDOMySQL();
        $result = $obj->query($sql, $args);
        
        return $result;
    }