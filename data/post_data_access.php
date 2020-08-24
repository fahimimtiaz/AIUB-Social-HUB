<?php
include_once "../data/db.php";

function insertPost($post){
    $query="INSERT INTO `post`( `username`, `text`, `time`) VALUES ('$post[username]','$post[text]','$post[time]')";
    $result=execute_query($query);
    if($result){
        return $result;
    }
}
function getPostId($uName){
    $query="select max(id) as post_id from post  where username='$uName'";
    $result=execute_query($query);

    if($result){
        return mysqli_fetch_assoc($result);
    }
}
function insertPostFile($file)
{
    $query = "INSERT INTO `post_files`( `post_id`, `name`, `type`, `path`, `time`) VALUES ($file[post_id],'$file[name]','$file[type]','$file[path]','$file[time]')";

    $result = execute_query($query);

    if ($result) {
        return $result;
    }
}
function getAllPost(){
   $query= "SELECT * FROM `post` order by time desc";
    $result = execute_query($query);
    if ($result) {
        return mysqli_fetch_all($result);
    }
}

function getPostFiles($post_id){
    $query="SELECT * FROM `post_files` where post_id=$post_id order by type";
    $result = execute_query($query);
    if ($result) {
        return mysqli_fetch_all($result);
    }
}
function insertComment($comment){
    $query="INSERT INTO `post_comments`(`username`, `post_id`, `text`, `time`) VALUES ('$comment[username]',$comment[post_id],'$comment[text]','$comment[time]')";
    $result = execute_query($query);
    if ($result) {
        return $result;
    }
}
function getAllComments($post_id){
    $query="SELECT * FROM `post_comments` WHERE post_id=$post_id";
    $result = execute_query($query);
    if ($result) {
        return mysqli_fetch_all($result);
    }
}
function getUserPost($uName){
    $query= "SELECT * FROM `post` where username='$uName' order by time desc";
    $result = execute_query($query);
    if ($result) {
        return mysqli_fetch_all($result);
    }
}

?>