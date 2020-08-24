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
    <title>ASH-Search Result</title>
</head>
<body>


<form  method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <table align="center" width="60%">
        <tr align="left">
            <td width="50px" >
                <a href="friends_profile.php"><img src="../data/images/propicrishita.jpg" height="40px" width="40px"> </a>
            </td>
            <td>
                <a href="friends_profile.php"><font size="5">Rishita</font> </a>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <tr align="left">
            <td width="50px" >
                <a href="friends_profile.php"><img src="../data/images/propic.jpg" height="40px" width="40px"> </a>
            </td>
            <td>
                <a href="banned.php"><font size="5">Md. Hanif</font> </a>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
    </table>
</form>

</body>
</html>