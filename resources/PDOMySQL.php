<?php
    require("config/DB_Config.php");
    
    class PDOMySQL {
        private function getConnection(){
            $username = DB_USERNAME;
            $password = DB_PASSWORD;
            $host = DB_HOST;
            $database = DB_NAME;
            $connection = new PDO("mysql:dbname=$database;host=$host", $username, 
                    $password);
            return $connection;
        }
        
        public function query($query, $args) {
            $connection = $this->getConnection();
            $stmt = $connection->prepare($query);
            $stmt->execute($args);
            return $stmt->fetchAll();
        }
        
        public function queryWithoutArgs($query) {
            $connection = $this->getConnection();
            $stmt = $connection->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

