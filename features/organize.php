<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['authorized'])) {
    header("Location: ../index.php");
} else {
    if ($_SESSION['authorized'] === false || !isset($_SESSION['username'])) {
        header("Location: ../index.php");
    }
}

include("../resources/info.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Organize</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">

        <!--
            CSS obtained from w3schools.com
        -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="../css/w3-css.css">

        <!--
            CSS obtained from bootstrap-tokenfield
        -->
        <link rel="stylesheet" href="../bootstrap-tokenfield/css/bootstrap-tokenfield.css">
        <link rel="stylesheet" href="../bootstrap-tokenfield/css/tokenfield-typeahead.css">
    </head>

    <body onresize="resizeEle(); resizeUploadButton();">
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
            <a <?php echo "href='" . grabUserID() . "/file_browser/index.php'";?> class="w3-bar-item w3-button">
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
                        <form action="upload_handler.php" enctype="multipart/form-data"
                              method="post" onsubmit="return validateFiles('error');">
                            <div class="col-14">                                   
                                <p class="textExtraLargeTitleFixed">
                                    Organize
                                </p>
                                <div class="col-15">
                                    <p>
                                        Title
                                    </p>
                                    <input name="title" type="text" maxlength="128"
                                           class="formBox"
                                           placeholder="Enter a name for folder" 
                                           required>
                                    <p>
                                        Tags
                                    </p>
                                    <div class="tokenfield textAlignLeft" 
                                         style="border:1px solid #ccc; 
                                         padding: 5px;">
                                        <input name="tags" id="tags" type="text"
                                               placeholder="Enter a tag and press enter">
                                    </div>
                                </div>

                                <div class="col-15">
                                    <p>Selected Files</p>
                                    <div id="selectedFiles">
                                        <p style="border: 1px solid #ccc"></p>
                                    </div>
                                </div>

                                <div class="col-15" style="border:1px solid #ccc">
                                    <label for="fileUploader" class="uploadLabel" style="position: relative; top: 100px;"
                                           title="Click here to select your files">
                                        <span class="uploadButton" id="uploadPlaceholder">
                                            Click here or drag and drop your files
                                        </span>
                                    </label>
                                    <input type="file" name="fileUploader[]" 
                                           id="fileUploader" style="padding: 75px 150px;"
                                           onchange="getFileName('fileUploader', 'selectedFiles');
                                                   validateFileSize('fileUploader', 'error');"
                                           multiple required>
                                </div>      
                            </div>

                            <div id="textUploadError" class="col-14">
                                <p id="error" class="textError"></p>
                            </div>

                            <div class="col-14 clearBoth">
                                <p>
                                    <br>
                                    <input type="submit" value="Upload"
                                           title="Upload selected files to server">
                                    <input type="button" 
                                           onclick="navigateToIndex();"
                                           value="Cancel">
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="//code.jquery.com/jquery-1.9.1.js"></script>
        <script src="../bootstrap-tokenfield/bootstrap-tokenfield.js"></script>
        <script>
            $('#tags').tokenfield();
        </script>
        <script src="../js/resize.js"></script>
        <script src="../js/get_files.js"></script>
        <script src="../js/navigation.js"></script>
    </body>
</html>
