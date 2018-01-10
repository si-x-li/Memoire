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
                    
                    <div id="form">
                        <p class="textLargeContent textAlignJustified">
                            Forgot your password and username? No worries, fill up 
                            the form below and we'll send you an email to send you
                            full instruction on how to get back to your account!
                        </p>

                        <form method="post" action="confirm_email.php">
                            <p class="textLargeContent noMargin left">
                                Email Address
                            </p>
                            <input id="email" name="email" type="email" 
                                   class="loginBox" required/>
                            <p>
                                <input type="submit" value="Submit"/>
                                <input type="button" value="Cancel" 
                                       onclick="navigateToIndex();"/>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="../../js/navigation.js"></script>
    </body>
</html>


