/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
const sidebarWidth = 250;
const navigatorHeight = 100;
const statusBarHeight = 15;
const statusBarID = "statusBar";
const recordBarHeight = 50;
const recordBarID = "recordBar";

const upcomingInfoHeight = 172;

window.onload=load;

function load() {
    try {
        resizeEle();
        resizeUploadButton();
        resizeRecordBar();
    } catch (e) {}
}

function resizeEle() {
    var width = window.innerWidth;
    var height = window.innerHeight;
    
    document.getElementById("sidebar").style.width 
            = sidebarWidth + "px";
                
    document.getElementById("content").style.left 
            = sidebarWidth + "px";
    document.getElementById("content").style.width 
            = (width-sidebarWidth) + "px";
    document.getElementById("content").style.height 
            = (height-navigatorHeight) + "px";
    document.getElementById("content").style.top 
            = (navigatorHeight) + "px";
}

function resizeRecordBar() {
    document.getElementById("recordBar").style.height = recordBarHeight + "px";
}

function resizeUploadButton() {
    var windowWidth = window.innerWidth;
    var width = 0.9375*0.4375*(windowWidth - sidebarWidth);

    var outerDiv = document.getElementsByClassName("uploadOuter");
    document.getElementById("uploadButton").style.width = width + "px";    

    for(var i = 0; i < outerDiv.length; i++){
        outerDiv[i].style.width = width + "px";
    }
}
