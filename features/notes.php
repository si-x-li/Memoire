<?php
    session_start();
    error_reporting(0);
    if(!isset($_SESSION['authorized'])) {
        header("Location: ../index.php");
    } else {
        if($_SESSION['authorized'] === false || !isset($_SESSION['username'])) {
            header("Location: ../index.php");
        }
    }

    include("../resources/info.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php 
            if(isset($_POST['title'])) {
                echo $_POST['title'];
            } else {
                echo "New Notes";
            }
            ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="../css/w3-css.css">  
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="../ckeditor/ckeditor.js"></script>
    </head>
    
    <body onresize="resizeEle();">
        <div id="sidebar" 
             class="sidebar w3-black w3-bar-block textContent left">
            <a href="../welcome.php"><img src="../images/logo.jpg" alt="logo" 
                             class="menuHome" title="Go to homepage"></a>
            <a href="notes.php" class="w3-bar-item w3-button">
                New Note
            </a>
            <a href="organize.php" class="w3-bar-item w3-button">
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
            <a <?php echo "href='" . grabUserID() . "/file_browser/index.php'"; ?> class="w3-bar-item w3-button">
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
            <div class="outerDiv" id="splashScreen">
                <div class="innerDiv">
                    <div class="textAlignCenter">
                        <img src="../images/splashscreen/spinner.gif" 
                             alt="Loading spinner">
                        <p>
                            Loading application
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="outerDiv" id="appScreen" style="display:none">
                <div class="innerDiv">
                    <div id="editor" class="textAlignCenter">
                        <div class="success" id="notification" 
                                     style="display:none"></div>
                        <form>
                            <div class="col-1 left">
                                <p style="margin: 10px;">
                                    Title:
                                </p>
                            </div>

                            <div class="col-13 right">
                                <input class="formBox" type="text" id="title"
                                       maxlength="128" required name="title"
                                       placeholder="Enter a file name"
                                       title="Give your notes a meaningful title, e.g. geo_notes_thursday"
                                       style="margin-top:5px"
                                       <?php
                                           if(isset($_POST['title'])) {
                                               echo "value='" . $_POST["title"]
                                                       . "'";
                                           }
                                           ?>>
                            </div>
                            <div class="col-15 clearBoth">
                            
                                <textarea id="mainEditor" onchange=""><?php 
                                        if(isset($_POST['data'])) {
                                            echo $_POST['data'];
                                        }
                                    ?></textarea>

                                <div id="recordBar">
                                    <a href="https://www.cam-recorder.com/"
                                       target="_blank">
                                        <img src="../images/icons/video.png"
                                             class="recordBarButton" 
                                             title="Take a video note">
                                    </a>
                                    <a href="https://www.cam-recorder.com/"
                                       target="_blank">
                                        <img src="../images/icons/image.png"
                                             class="recordBarButton"
                                             title="Take a picture note">
                                    </a>
                                    <a href="https://www.cam-recorder.com/"
                                       target="_blank">
                                        <img src="../images/icons/microphone.png"
                                             class="recordBarButton"
                                             title="Take an audio note">
                                    </a>
                                </div>
                                <div id="debug"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="../js/resize.js"></script>        
        <script src="../js/bootCKEditor.js"></script>
        <script>              
            CKEDITOR.replace('mainEditor', {
                on: {
                    save: function(evt)
                    {
                        
                        var data = evt.editor.getData();
                        var title = document.getElementById("title").value;
                        
                        if(title === "") {
                            title = "document_autosave" + 
                                    Math.floor(Math.random() * 2000000000);
                        }
                        
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                $("#notification").html("Document saved"
                                    + " as " + title + ".html");
                                $("#notification").show(500);
                                $("#notification").delay(5000);
                                $("#notification").hide(500);
                            }
                        };
                        xhttp.open("POST", "upload_notes_handler.php", true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send("title=" + title + "&data=" + data);
                        
                        window.onbeforeunload = function() {};
                        
                        return false;
                    }
                }
            });
            
            for (var i in CKEDITOR.instances) {
                CKEDITOR.instances[i].on('change', function() { 
                    window.onbeforeunload = function(e){ 
                    var dialog = "Exit without saving?";
                    e.returnValue = dialog;
                    return dialog;
                };});
            }
            
            $(document).ready(function() {
                $("#appScreen").delay(5000).show(1000);
            });
        </script>

    </body>
</html>
