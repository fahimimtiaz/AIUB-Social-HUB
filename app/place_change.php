<?php

    include_once "../data/profile_data.php";

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

<?php
	if(isset($_POST['change_place']))
	{
        $place = $_POST['place'];
        
        $query="update profile set place='$place' where username='$user_name';";
        $result= execute_query($query);

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
                    <font color="black" size="5">General Account Settings</font>
                    <hr />
                    <!-- <font color="black" size="3">Name</font> <br> <br>
                    <font color="black" size="3">Contact</font> <br> <br>
                    <font color="black" size="3">Temperature</font> <br> <br> -->
                </td>
            </tr>
            </table>
        <form method="post"  name="change_name"  onSubmit="return name_check();">
            <table align="right" width="80%">
                <tr>
                    <td>
                        <font color="black" size="3">Name</font> <br> <br>
                        <font color="black" size="3">Contact</font> <br> <br>
                        <font color="black" size="3">Lives in</font> <br> <br>
                        <font color="black" size="3">Hometown</font> <br> <br>
                        <font color="black" size="3">Department</font> <br> <br>
                        <font color="black" size="3">Temperature</font> <br> <br>
                    </td>

                    <td align="left">
                         <font color="black" size="2"><?php echo $fullname; ?></font> <br> <br>
                        <font color="black" size="2"><?php echo $email; ?></font> <br> <br>
                        <input type="text" name="place">  <br> <br>
                        <font color="black" size="2"><?php echo $hometown; ?></font> <br> <br>           
                        <font color="black" size="2"><?php echo $department; ?></font> <br> <br>
                        <font color="black" size="2">Celsius</font> <br> <br>
                    </td>


                    <td align="left">
                        <p><a href="name_change.php"><font color="aqua" size ="2">edit</font></a></p>
                        <!-- <a href="edit_successful.php"><input type="button" name="name_change" value="Save"><a> <br> <br> -->
                        <p><a href="contact_change.php"><font color="aqua" size ="2">edit</font></a></p>
                        <input type="submit" value="Save" name="change_place" class="save_button"><br> <br>
                        <p><a href="hometown_change.php"><font color="aqua" size ="2">edit</font></a></p>  
                        <p><a href="department_change.php"><font color="aqua" size ="2">edit</font></a></p>
                        <p><a href="setting_general.php"><font color="aqua" size ="2">edit</font></a></p>
                    </td>



                </tr>

            </table>
        <form>  
        
    <body>
</html>