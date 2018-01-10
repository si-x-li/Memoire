/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function isMatch(input1, input2) {
    if(input1 === input2) {
        return true;
    } 
    
    return false;
}

function checkPassword() {
    var pass1 = document.getElementById("password").value;
    var pass2 = document.getElementById("confirmPassword").value;
    
    if(pass2.length < 8) {
        document.getElementById("passwordError").innerHTML = "Passwords "
            + "should be 8-20 characters in length!";
        return false;
    } else if(pass2.length > 20) {
        document.getElementById("passwordError").innerHTML = "Passwords "
            + "should be 8-20 characters in length!";
    } else {
        if(!isMatch(pass1, pass2)) {
            document.getElementById("passwordError").innerHTML 
                    = "Passwords do not match!"
            return false;
        } else {
            document.getElementById("passwordError").innerHTML = "";
            return true;
        }
    }
}

function checkEmail() {
    var email1 = document.getElementById("email").value;
    var email2 = document.getElementById("confirmEmail").value;
    
    if(!isMatch(email1, email2)) {
        document.getElementById("emailError").innerHTML
                = "Emails do not match!";
        return false;
    } else {
        document.getElementById("emailError").innerHTML = "";
        return true;
    }
}

function checkUsernameAvail() {
    var username = document.getElementById("username").value;
    if (username === "") {
        document.getElementById("usernameError").innerHTML 
                = "Username cannot be blank!";
        return;
    } else { 
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("usernameError").innerHTML 
                        = this.responseText;
            }
        };
        xmlhttp.open("GET","../username_is_valid.php?username=" + username,
            true);
        xmlhttp.send();
    }
}

function proceedRegistration() {
    var usernameIsGood = false;
    if(document.getElementById("usernameError").innerHTML === "") {
        usernameIsGood = true;
    }

    if(usernameIsGood === true 
            && checkEmail() === true 
            && checkPassword() === true) {
        return true;
    }

    return false;
}

function checkTime() {

        var start_month = parseInt($("#startTime").val().substring(0, 2));
        var end_month = parseInt($("#endTime").val().substring(0, 2));
        
        var start_day = parseInt($("#startTime").val().substring(3, 5));
        var end_day = parseInt($("#endTime").val().substring(3, 5));
        
        var start_year = parseInt($("#startTime").val().substring(6, 10));
        var end_year = parseInt($("#endTime").val().substring(6, 10));
        
        var start_hour = parseInt($("#startTime").val().substring(11, 14));
        var end_hour = parseInt($("#endTime").val().substring(11, 14));
        
        var start_minute = parseInt($("#startTime").val().substring(14, 16));
        var end_minute = parseInt($("#endTime").val().substring(14, 16));

        var start_time_value = new Date(start_year, start_month - 1, start_day, start_hour, start_minute, 0, 0);
        var end_time_value = new Date(end_year, end_month - 1, end_day, end_hour, end_minute, 0, 0);
        
        if(start_time_value > end_time_value) {
            $("#timeError").html("End date and time must be greater than start date and time!");
            return false;
        } else {
            $("#timeError").html("");
            return true;
        }

}