<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html class="textArial">
    <head>
        <title>Register for Mémoire</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    <body id="loginScreen">
        <div class="outerDiv">
            <div class="innerDiv">
                <div class="loginContainer textAlignCenter">
                    <div class="imageContainer">
                        <img src="../../images/logo.png" alt="Memoire LOGO"
                             style="width:400px">
                    </div>
                    
                    <div id="confirmForm" class="textLargeContent 
                         textAlignJustified">
                        <p>
                            If we find your email in our database, we will
                            send instructions to your email on how to reset
                            your password. You should receive this email within
                            10 minutes. Do not forget to check your spam or
                            junk inbox. It could happen that our messages get
                            flagged as junk.
                        </p>
                        <p>
                            Click <a href="../../index.php" 
                                     class="colorHyperBlue">here</a> to go back
                            to the logging page.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function navigateToIndex() {
                window.location.href = "../../index.php";
            }
        </script>
    </body>
</html>



