<?php
include_once "../data/user_data_access.php";
$result=get_user_un($_POST['uname']);
if(mysqli_num_rows($result)==1){
    echo "1";
}
?>