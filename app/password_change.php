<?php
    include_once "../data/profile_data.php";


if($_SESSION['userloggedIn']){
    include_once "../logic/search_logic.php";
    include_once "../logic/user_top_bar.php";
    include_once "../logic/login_registration_logic.php";
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


<?php
$uName=$_SESSION['user']['username'];
	if(isset($_POST['change_password']))
	{
	    $oldPassword=$_POST['old_password'];
        $newPassword = $_POST['new_password'];
        $newPassword2 = $_POST['new_password2'];
        if($newPassword!=$oldPassword && $newPassword==$newPassword2 && isPassword($newPassword)){
        $query="update users set password='$newPassword' where username='$uName';";
        $result= execute_query($query);
        }

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
        <form method="post"  name="change_password"  onSubmit="return name_check();">
            <table align="center" width="80%">
                <tr>
                    <td align="left" width="15%">
                        Enter old password
                        <br> <br>

                        Enter New password
                        <br> <br>

                        Enter new password again
                        <br> <br>
                    </td>

                    <td align = "left" width="85%">
                        <input type="password" name ="old_password"> <br> <br>
                        <input type="password" name ="new_password"> <br> <br>
                        <input type="password" name ="new_password2"> <br> <br>
                        
                        <input type="submit" value="Save" name="change_password" class="save_button"><br> <br>
                        <!-- <a href="edit_successful.php"><input type="button" name="confirm_password" value="Confirm" ><a> -->

                    </td>

                </tr>

                

            </table>
        </form> 
        
    <body>
</html>