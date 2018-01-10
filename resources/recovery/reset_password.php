<?php 
    session_start();
    include("../info.php");
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    
    $obj = new PDOMySQL();
    $sql = "select ID from " . DB_NAME . ".members where username = ?";
    $args = array($username);
    
    $result = $obj->query($sql, $args);
    
    if(count($result) > 0) {
        $id = $result[0][0];
    } else {
        header("Location: forgot_password.php?notification=Combination does not exist!");
    }
    
    $sql = "select userEmail from " . DB_NAME . ".user where userID = ? and userEmail = ?";
    $args = array($id, $email);
    
    $result = $obj->query($sql, $args);
    
    if(count($result) === 0) {
        header("Location: forgot_password.php?notification=Combination does not exist!");
    } else {
        $_SESSION['idToChange'] = $id;
    }
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
                <div class="loginContainer textAlignCenter">
                    <div class="imageContainer">
                        <img src="../../images/logo.png" alt="Memoire LOGO"
                             style="width:400px">
                        
                    </div>
                    <form action="reset_password_in_database.php" 
                          method="post" onsubmit="return checkPassword();">
                        <p class="textLargeContent">
                            Create a new password.
                        </p>
                        
                        <p class="textLargeContent noMargin left">
                            Password
                        </p>
                        <input id="password" name="password" type="password" 
                               class="loginBox" required/>

                        <p class="textLargeContent noMargin left">
                            Confirm Password
                        </p>
                        <input id="confirmPassword" type="password" 
                               class="loginBox" onkeyup="checkPassword()" 
                               required/>
                        <p>
                        <div id="passwordError" class="textError"></div>

                        <p>
                            <input type="submit" value="Submit"/>
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


