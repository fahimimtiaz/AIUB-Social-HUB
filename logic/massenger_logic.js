var friend_id=undefined;
function getUserMsg(username) {
friend_id=username.id;
var user_id=document.getElementById('username').value;
document.getElementById('friendUN').value=friend_id;
getFndName();
getPropic();
var users=[user_id,friend_id];
    var msg=document.getElementById('messages');
    var XHR=new XMLHttpRequest();
    XHR.onreadystatechange=function () {
        if(this.readyState==4 && this.status==200){
            msg.innerHTML=this.responseText;


        }
    }
    XHR.open("POST","../logic/getUserMsg.php",true);
    XHR.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    XHR.send("users="+users);


}
function getFndName() {
    var friendName=document.getElementById('friendName');
    var ajax=new XMLHttpRequest();
    ajax.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
            friendName.innerHTML=this.responseText;

        }
    };
    ajax.open("POST","../logic/getFriendName.php",true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send("uname="+friend_id);
}
function getPropic() {
    var proPic=document.getElementById('proPic');
    var ajax=new XMLHttpRequest();
    ajax.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
            proPic.innerHTML=this.responseText;

        }
    };
    ajax.open("POST","../logic/getUserPropic.php",true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send("uname="+friend_id);
}
function validFileSize() {
    var mediaFiles=document.getElementById('files').files;
    var totalSize=0;
    for (let i=0; i<mediaFiles.length;i++){
        totalSize =totalSize + mediaFiles[i].size;
    }
    if(totalSize>8388608){
        alert("Sum of the all file's size should not exceed 8MB.")
        return false;
    }
    return true;
}

