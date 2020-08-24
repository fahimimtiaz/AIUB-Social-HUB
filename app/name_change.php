<?php

    include_once "../data/profile_data.php";


if($_SESSION['userloggedIn']){
    include_once "../logic/search_logic.php";
    include_once "../logic/user_top_bar.php";
    include_once "../logic/login_registration_logic.php";
    $uName=$_SESSION['user']['username'];
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
	if(isset($_POST['change_name']))
	{
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        if(!empty($fname) && !empty($lname) && isName($fname) && isName($lname)){
        $query="update users set firstname='$fname',lastname='$lname' where username='$uName';";
        $result= execute_query($query);}

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
                        First Name : <input type="text" name="fname">  
                        Last Name : <input type="text" name="lname"><br> <br>
                        <font color="black" size="2"><?php echo $email; ?></font> <br> <br>
                        <font color="black" size="2"><?php echo $place; ?></font> <br> <br>
                        <font color="black" size="2"><?php echo $hometown; ?></font> <br> <br>
                        <font color="black" size="2"><?php echo $department; ?></font> <br> <br>
                        <font color="black" size="2">Celsius</font> <br> <br>
                    </td>


                    <td align="left">
                        <input type="submit" value="Save" name="change_name" class="save_button"><br> <br>
                        <!-- <a href="edit_successful.php"><input type="button" name="name_change" value="Save"><a> <br> <br> -->
                        <p><a href="contact_change.php"><font color="aqua" size ="2">edit</font></a></p>
                        <p><a href="place_change.php"><font color="aqua" size ="2">edit</font></a></p>
                        <p><a href="hometown_change.php"><font color="aqua" size ="2">edit</font></a></p>
                        <p><a href="department_change.php"><font color="aqua" size ="2">edit</font></a></p>
                       
                        <p><a href="setting_general.php"><font color="aqua" size ="2">edit</font></a></p>
                    </td>



                </tr>

            </table>
        <form>  
        
    <body>
</html>