<?php
session_start();

if($_SESSION['userloggedIn']){
include_once "../logic/bannedUserTopbar.php";
}
else{
    header("Location:loginandregistration.php");
}
?>
<html>
<head>

</head>

<body>

<p align="center"><font size="10"><b>Your profile has been banned by Admin.<br>Please contact 'support@ash.com'</b></font> </p>



</body>




</html>



