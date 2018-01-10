<?php
    session_start();
//    error_reporting(0);
    require("../resources/info.php");
    require("../resources/config/CONFIG.php");
    if($_SESSION['authorized'] === false) {
        header("Location: index.php");
    }
    
    if(!isset($_POST['title']) || !isset($_POST['tags'])) {
        header("Location: organize.php");
    }
?>

<!DOCTYPE html>
<html class="textArial">
    <head>
        <title>Uploading...</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="../css/w3-css.css">        
    </head>
    <body onresize="advanceProgressBar(); resizeEle();">
        <div id="sidebar" 
             class="sidebar w3-black w3-bar-block textContent left">
            <a href="../welcome.php"><img src="../images/logo.jpg" alt="logo" 
                             class="menuHome" title="Go to homepage"></a>
            <a href="notes.php" class="w3-bar-item w3-button">
                New Note
            </a>
            <a href="#" class="w3-bar-item w3-button">
                Organize and Upload
            </a>
            <a href="meeting/set_up_meeting.php" 
               class="w3-bar-item w3-button">
                Create a Reminder
            </a>
            <a href="meeting/upcomingEvents.php" 
               class="w3-bar-item w3-button">
                Upcoming Events <span class="notification"><?php echo getNotificationCount(); ?></span>
            </a>
            <a <?php echo "href='" . grabUserID() . "/file_browser/index.php'";
                    ?> class="w3-bar-item w3-button">
                My Files
            </a>
            <a href="../about.php" class="w3-bar-item w3-button bottom">
                About Mémoire
            </a>
        </div>
        
        <div id="navigator">
            <a href="../profile/logout.php" class="navigatorButton right">
                Log out
            </a>
            <a href="../profile/account.php" class="navigatorButton right">
                Profile
            </a>            
        </div>
        
        <div id="content">
            <div class="outerDiv">
                <div class="innerDiv">
                    <div class="textAlignCenter">
                        <p class="textExtraLargeTitle">
                            Uploading files to server...
                            <br>
                            <progress max="100" value="0" id="progressBar"
                                      style="color: black">
                            </progress>
                        </p>
                        
                        <div id="notification"></div>
                        <div id="notification2"></div>
                        <div id="info" style="display:none"></div>
                        <?php 
                            $id = grabUserID();
                            $title = $_POST["title"];
                            
                            $root = dirname(__FILE__, 1);
                            
                            $total = count($_FILES['fileUploader']['name']);
                            $target_dir =  $id . 
                                    "/file_browser/files/Organize/" . $title . 
                                    "/";
                                                        
                            $tags = explode(", ", $_POST["tags"]);
                            
                            $count = 0;
                            $_SESSION['UPLOAD'] = $count;
                            $_SESSION['MAX_UPLOAD'] = $total;
                            for($i = 0; $i < $total; $i++) {
                                $file_info = pathinfo($_FILES["fileUploader"]["name"][$i]);
                                $_SESSION['UPLOAD_NAME'] = $file_info["filename"] . $file_info["extension"];
                                $filename = $file_info["filename"];
                                $extension = $file_info["extension"];
                                
                                $target_file = $target_dir . $filename;
                                
                                // Remove everything but numbers and letters from tags
                                foreach($tags as $tag) {
                                    $tag = preg_replace("[^0-9a-zA-Z_\s]", "", $tag);
                                    $target_file .= SEPARATOR . $tag;
                                }
                                
                                $target_file .= "." . $extension;
                            
                                if($_FILES["fileUploader"]["size"][$i] > MAX_UPLOAD_SIZE) {
                                    continue;
                                } 
                                $target_info = pathinfo($target_file);
                                if(!file_exists($target_info["dirname"])) {
                                    mkdir($target_info["dirname"], 0777, true);
                                }
                                move_uploaded_file($_FILES["fileUploader"]["tmp_name"][$i], $target_file);
                              
                                $count++;
                                $_SESSION['UPLOAD'] = $count;
                                $_SESSION['UPLOAD_NAME'] = $file_info["filename"] . "." . $file_info["extension"];
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <script>
            window.onbeforeunload = function(e){ 
                var dialog = "Uploads are still in progress..."
                e.returnValue = dialog;
                return dialog;
            };
        </script>
        <script src="../js/progressBar.js"></script>
        <script src="../js/resize.js"></script>
    </body>
</html>


