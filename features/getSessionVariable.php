<?php
    session_start();
    error_reporting(0);
    
    $var->cur = $_SESSION['UPLOAD'];
    $var->name = $_SESSION['UPLOAD_NAME'];
    $var->max = $_SESSION['MAX_UPLOAD'];
    
    echo json_encode($var);

