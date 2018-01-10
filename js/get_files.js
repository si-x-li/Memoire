// MAXIMUM of 5MB per file
// MAXIMUM of 128MB per upload
const MAX_UPLOAD_SIZE = 1024 * 1024 * 5;
const TOTAL_MAX_UPLOAD_SIZE = 1024 * 1024 * 128;


function getFileName(inputName, outputName) {
    var input = document.getElementById(inputName);
    var output = document.getElementById(outputName);
    
    var message = "";
    
    if(input.files.length > 4) {
        for (var i = 0; i < 4; i++) {
            if(i === 0) {
                message += "<p style='border: 1px solid #ccc;'>";
            }
            message += input.files.item(i).name + "<br>";
        }
        message += "...";
    } else {
        message += "<p style='border: 1px solid #ccc;'>";
        for (var i = 0; i < input.files.length; i++) {
            message += input.files.item(i).name + "<br>";
        }
    }
    message += "</p>";
    
    output.innerHTML = message;
}

function validateFileSize(inputName, errorText) {
    var input = document.getElementById(inputName);
    var errorOutput = document.getElementById(errorText);
    
    errorOutput.innerHTML = "";
    var size = 0;
    for(var i = 0; i < input.files.length; i++) {
        size += input.files.item(i).size;
        if(input.files.item(i).size > MAX_UPLOAD_SIZE) {
            errorOutput.innerHTML += "\"" + input.files.item(i).name + "\" exceeds 5M per file limit!<br>";
        }
        if(input.files.item(i).name.indexOf(".") === -1) {
            errorOutput.innerHTML += "\"" + input.files.item(i).name + "\" is not a file!<br>";
        }
    }
    if(size > TOTAL_MAX_UPLOAD_SIZE) {
        errorOutput.innerHTML += "Total upload size exceeded 128M limit!";
    }
}

function validateFiles(errorText) {
    var errorOutput = document.getElementById(errorText).innerHTML;
    
    if(errorOutput === "") {
        return true;
    } else {
        return false;
    }
}
