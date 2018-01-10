<!DOCTYPE html>
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
                    
                    <p class="textLargeContent">
                        Forgot your password? No worries, fill up the form below
                        and we'll get you back to your day!
                    </p>
                                        
                    <form method="post" action="reset_password.php">
                        <p class="textLargeContent noMargin left">
                            Username
                        </p>
                        <input id="username" name="username" type="text" 
                               class="loginBox" required/>
                        <p class="textLargeContent noMargin left">
                            Email Address
                        </p>
                        <input id="email" name="email" type="email" 
                               class="loginBox" required/>
                        <p class="textError">
                            <?php 
                                if(isset($_GET['notification'])) {
                                    echo $_GET['notification'];
                                }
                            ?>
                        </p>                        
                        <p>
                            <input type="submit" value="Submit"/>
                            <input type="button" value="Cancel" 
                                   onclick="navigateToIndex();"/>
                        </p>
<!--                        <p class="textLargeContent">
                            <a href="send_reset_password_email.php">
                                Forgot your username?
                            </a>
                        </p>-->
                    </form>
                </div>
            </div>
        </div>
        <script src="../../js/navigation.js"></script>
    </body>
</html>

