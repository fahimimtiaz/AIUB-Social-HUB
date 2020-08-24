<?php
include_once "../data/user_data_access.php";
$result=get_user_un($_POST['uname']);
$res=mysqli_fetch_assoc($result);
$fndName=$res['firstname']." ".$res['lastname'];
echo $fndName;
?>