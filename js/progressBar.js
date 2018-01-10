window.onload = advanceProgressBar();

function advanceProgressBar() {
    var i = 0;
    
    // Check every 5.0s the progress of upload
    var id = setInterval(setProgressBar, 500);
    
    var cur;
    var max;
    var name;
    
    var redirect = false;
    
    function setProgressBar() {    
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                obj = JSON.parse(this.responseText);
                cur = parseInt(obj.cur);
                max = parseInt(obj.max);
                name = obj.name;
                try{
                    document.getElementById("progressBar").max = max;
                } catch(e) {}
                document.getElementById("progressBar").value = cur;
                document.getElementById("notification").innerHTML = 
                        "Uploading " + name + "..." + "     File " + cur + "/" + max;
            }
        };
        xhttp.open("POST", "getSessionVariable.php", true);
        xhttp.send();
        
        var progress = document.getElementById("progressBar");
        if(cur >= max) {
            window.onbeforeunload = null;
            var s = setInterval(goToHomepage, 2000);
            function goToHomepage() {
                document.getElementById("notification").style.display = "none";
                document.getElementById("notification2").innerHTML =
                    "<p>Upload finished! Automatically redirecting to homepage."
                    + "<br> Click <a href='http://sixunli.com/Project/HCI-Memoire/index.php'>"
                    + "here</a> if you are not redirected automatically."
                    + "</p>";
                if(i > 0 && redirect === false) {
                    window.location.href = "http://sixunli.com/Project/HCI-Memoire/index.php";
                    redirect = true;
                }
                i++;
            }           
            
        } else {
            progress.max = max;
            progress.value = cur;
        }
    }
}




