<?php
include_once "db.php";
function insertUser($user){
    $query="INSERT INTO `users`(`id`, `firstname`, `lastname`, `username`, `email`, `password`, `birthday`, `gender`,status) VALUES (NULL,'$user[firstname]','$user[lastname]','$user[username]','$user[email]','$user[password]','$user[birthday]','$user[gender]','$user[status]')";
    $result= execute_query($query);
    $res=insertProfile($user['username']);
    if($result && $res){
        return $result;
    }

}
function insertProfile($username){
    $query="INSERT INTO `profile`(`username`) VALUES ('$username')";
    $result= execute_query($query);
    if($result){
        return $result;
    }

}
function get_user($info){

    $query="select * from users where username='$info[username]' and password='$info[password]'";
    $result= execute_query($query);
    if($result){
        return $result;
    }
}
function get_admin($info){

    $query="select * from admin where username='$info[username]' and password='$info[password]'";
    $result= execute_query($query);
    if($result){
        return $result;
    }
}

function get_user_un($info){

    $query="select * from users where username='$info'";
    $result= execute_query($query);
    if($result){
        return $result;
    }
}
function getAllUser(){

    $query="select * from users";
    $result= execute_query($query);
    if($result){
        return mysqli_fetch_all($result);
    }
}
function changeStatus($username,$value){
    $query="update users set status=$value where username='$username'";
    $result= execute_query($query);
    if($result){
        return $result;
    }
}
function insertMsg($msg){
    $query="INSERT INTO `chat_messages`( `from_user`, `to_user`, `message`, `type`, `name`, `time`) VALUES ('$msg[from_user]','$msg[to_user]','$msg[message]','$msg[type]','$msg[name]','$msg[time]')";
    $result= execute_query($query);
    if($result){
        return $result;
    }
}
function getMessages($users){
    $query="select * from chat_messages where from_user='$users[user1]' and to_user='$users[user2]' or from_user='$users[user2]' and to_user='$users[user1]' order by id";
    $result= execute_query($query);
    if($result){
        return mysqli_fetch_all($result);
    }
}
function getUserProfile($uName){
    $query="SELECT * FROM `profile` WHERE username='$uName'";
    $result= execute_query($query);
    //var_dump($result);
    if($result){
        return mysqli_fetch_assoc($result);
    }
}


function banUser($id,$statVal)
{
    $query="UPDATE users set ban_status=$statVal WHERE id='$id' ";
    $result=execute_query($query);
    if($result)
        return 1;
    else
        return 0;


}

function insert_warn_msg($msgInfo){

    $query="INSERT INTO `notification`(`username`, `warn_message`, `time`) VALUES ('$msgInfo[username]','$msgInfo[warn_message]','$msgInfo[time]')";
    $result=execute_query($query);
    if($result){
        return $result;
    }
}

function get_warnings($id){

    $query="select * from notification where username='$id'";
    $result=execute_query($query);
    if($result)
        return mysqli_fetch_all($result);

}
function search_user($searchValue){
    $query="select * from users u, profile p where 
u.username=p.username and p.username like '%$searchValue%' or 
u.username=p.username and u.firstname like '%$searchValue%' or 
u.username=p.username and u.lastname like '%$searchValue%' or 
u.username=p.username and u.email like '%$searchValue%' or 
u.username=p.username and u.gender like '%$searchValue%' or 
u.username=p.username and p.department like '%$searchValue%' or 
u.username=p.username and p.place like '%$searchValue%' or 
u.username=p.username and p.hometown like '%$searchValue%'";
    echo $query;
    $result=execute_query($query);
    if($result){
        return mysqli_fetch_all($result);
    }

}

?>