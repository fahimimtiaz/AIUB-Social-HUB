<?php
include_once "../data/post_data_access.php";
function insert_post($uName,$post_txt){
    date_default_timezone_set("Asia/Dhaka");
    $time=date('Y-m-d H-i-s');
    $post=array(
        'username'=>$uName,
        'text'=>$post_txt,
        'time'=>$time
    );
    return insertPost($post);
}
function get_post_id($uName){
    return getPostId($uName);
}
function insert_File_Post($post_id, $FileName, $fileType, $targetFilePath){
    date_default_timezone_set("Asia/Dhaka");
$time=date('Y-m-d H-i-s');
$file=array(
    'post_id'=>$post_id,
    'name'=>$FileName,
    'type'=>$fileType,
    'path'=>$targetFilePath,
    'time'=>$time
);
return insertPostFile($file);
}

function get_All_Post(){
    return getAllPost();
}
function get_post_files($post_id){
    return getPostFiles($post_id);
}
function insert_comment($uName,$post_id,$comText){
    date_default_timezone_set("Asia/Dhaka");
    $time=date('Y-m-d H-i-s');
    $comment=array(
        'username'=>$uName,
        'post_id'=>$post_id,
        'text'=>$comText,
        'time'=>$time
    );
    return insertComment($comment);
}
function get_All_Comments($post_id){
    return getAllComments($post_id);
}
function get_user_post($uName){
    return getUserPost($uName);
}
?>