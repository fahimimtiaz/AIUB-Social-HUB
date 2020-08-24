<?php
include_once "../data/user_data_access.php";
$res=getUserProfile($_POST['uname']);
//$res=mysqli_fetch_assoc($result);
$proPic="";

$proPic="<img src=\" ".$res['pro_pic']."\" align=\"left\" height=\"40px\" width=\"40px\" >";

echo $proPic;
?>