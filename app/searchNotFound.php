<?php
session_start();

if($_SESSION['userloggedIn']){
    include_once "../logic/search_logic.php";
    include_once "../logic/user_top_bar.php";
    if($_SERVER['REQUEST_METHOD']=='POST'){

        if(isset($_POST['searchBtn'])){
            search($_POST['searchText']);

        }
    }
}
else{
    header("Location:loginandregistration.php");
}
?>
<html>
<head>

</head>
<body>

    <p align="center"><font size="10"><b>Sorry, no search result found.</b></font> </p>
</body>
</html>