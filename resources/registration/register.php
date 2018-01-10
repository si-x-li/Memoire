<?php
    error_reporting(0);
?>

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
                <div class="registrationContainer textAlignCenter">
                    <div class="imageContainer">
                        <img src="../../images/logo.png" alt="Memoire LOGO"
                             style="width:400px">
                    </div>
                    
                    <p class="textLargeContent">
                        Thank you for choosing Mémoire!
                    </p>
                    
                    <p class="textLargeContent textAlignJustified">
                        Should you find any bugs or glitches, 
                        please report them to our development team! We hope you 
                        enjoy our product thoroughly!
                    </p>
                    
                    <form method="post" onsubmit="return proceedRegistration();"
                          action="create_account.php">
                        <p class="textLargeContent noMargin left">
                            Username
                        </p>
                        <input id="username" name="username" type="text" 
                               class="loginBox" required 
                               onkeyup="checkUsernameAvail();"/>
                        <div id="usernameError" class="textError"></div>
                        
                        <p class="textLargeContent noMargin left">
                            Password
                        </p>
                        <input id="password" name="password" type="password" 
                               class="loginBox" required/>
                        
                        <p class="textLargeContent noMargin left">
                            Confirm Password
                        </p>
                        <input id="confirmPassword" 
                               type="password" class="loginBox" required
                               onkeyup="checkPassword();"/>
                        <div id="passwordError" class="textError"></div>
                        
                        <p class="textLargeContent noMargin left">
                            Email Address
                        </p>
                        <input id="email" name="email" type="email" 
                               class="loginBox" required/>
                        
                        <p class="textLargeContent noMargin left">
                            Confirm Email Address
                        </p>
                        <input id="confirmEmail" 
                               type="email" class="loginBox" required
                               onkeyup="checkEmail();"/>
                        <div id="emailError" class="textError"></div>
                        
                        <p>
                            <input type="submit" value="Register"/>
                            <input type="button" value="Cancel" 
                                   onclick="navigateToIndex();"/>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <script src="../../js/navigation.js"></script>
        <script src="../../js/formValidation.js"></script>
    </body>
</html>
