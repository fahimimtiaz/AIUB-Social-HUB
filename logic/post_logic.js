function changePostId(commentBtnId) {
    var btnId=commentBtnId.id;
    var postIdArr=btnId.split('_');
    var postId=postIdArr[1];
    document.getElementById('postIdHolder').value=postId;
}
var friendId=undefined;
function setFriendId(user) {
    var Id=user.id;
    var Idarr=Id.split('_',2);
    friendId=Idarr[1];

    var ajax=new XMLHttpRequest();
    ajax.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
        }
    };
    ajax.open("POST","../logic/setUserId.php",true);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ajax.send("uname="+friendId);
}