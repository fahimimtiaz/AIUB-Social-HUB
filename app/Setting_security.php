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

      
            <table align="left" width="20%" border ="0">

                <tr align="center">
                    <td>
                        <br><br><br>
                        <p><a href="setting_general.php"><font color="aqua" size ="3">General</font></a></p>
                        <p><a href="setting_security.php"><font  color="aqua" size ="3">Security & Login</font></a></p>
                    </td>
                </tr>


            </table>

            <table align="right" width="80%" border ="0">

            <tr>
                <td>
                    <br>
                    <font color="black" size="5">Security Settings</font>
                    <hr />
                </td>
            </tr>
            </table>

            <table align="right" width="80%">
                <tr>
                    <td>
                        <font color="black" size="3">Password</font> <br> <br>
                    </td>

                    <td align="left">
                        <font color="black" size="2">********</font> <br> <br>
                    </td>


                    <td align="left">
                         <p><a href="password_change.php"><font color="aqua" size ="2">change</font></a></p>
                    </td>



                </tr>

            </table>
           
        
    <body>
</html>