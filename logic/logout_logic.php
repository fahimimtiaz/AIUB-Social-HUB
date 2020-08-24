<?php
session_start();
if($_SESSION['userloggedIn']) {
    include_once "../logic/user_logic.php";
    change_status($_SESSION['user']['username'],0);
}
session_unset();
session_destroy();
header("Location:../index.php");
?>