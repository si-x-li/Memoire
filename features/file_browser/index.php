<?php
    session_start();
    error_reporting(0);
    if (!isset($_SESSION['authorized'])) {
        header("Location: ../../index.php");
    } else { 
        if($_SESSION['authorized'] === false || !isset($_SESSION['username'])) {
            header("Location: ../../index.php");
        }
    }
?>

<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>Your Files</title>


        <!-- Include our stylesheet -->
        <link href="assets/css/styles.css" rel="stylesheet"/>
        <link href="../../../css/style.css" rel="stylesheet"/>
    </head>
    <body>
		<a href="../../../index.php">
			<header style="background-color: #fff">
				<div class="textAlignLeft">
					
						<img src="../../../images/logo.png" class="menuHome">
					
				</div>
			</header>
		</a>
        
        <div class="filemanager">
            <div class="search">
                <input type="search" placeholder="Find a file.." />
            </div>

            <div class="breadcrumbs"></div>

            <ul class="data"></ul>

            <div class="nothingfound">
                <div class="nofiles"></div>
                <span>No files here.</span>
            </div>

        </div>

        <!-- Include our script files -->
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="assets/js/script.js"></script>

    </body>
</html>
