<?php
include_once "../data/user_data_access.php";
        function get_all_user(){
            return getAllUser();
        }
        function change_status($username,$value){
            return changeStatus($username,$value);
        }
function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}
function insert_msg($uName,$friendUN,$textMsg,$fileType, $FileName){
    date_default_timezone_set("Asia/Dhaka");
            $time=date('Y-m-d H-i-s');
            $msg=array(
                'from_user'=>$uName,
                'to_user'=>$friendUN,
                'message'=>$textMsg,
                'type'=>$fileType,
                'name'=>$FileName,
                'time'=>$time

            );
            return insertMsg($msg);
}
function get_messages($uName,$friendUN){
            $users=array(
                'user1'=>$uName,
                'user2'=>$friendUN
            );
            return getMessages($users);
}
function startsWith ($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}
function getUserName($uName){
            $result= get_user_un($uName);
            return mysqli_fetch_assoc($result);
}

if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['ban']))
{
    $ban=explode(',',$_GET['ban'],2);
    $id = $ban[0];
    $statVal=$ban[1];
    return banUser($id,$statVal);

}
function get_user_profile($uName){
    return getUserProfile($uName);
}

function insertwarn_msg($uname,$msg)
{
    date_default_timezone_set('Asia/Dhaka');
    $time=date('Y-m-d H-i-s');
    $info=array(
        'username'=>$uname,
        'warn_message'=>$msg,
        'time'=>$time
    );
    return insert_warn_msg($info);

}
function  get_user_warning($id){

    return get_warnings($id);
}

?>