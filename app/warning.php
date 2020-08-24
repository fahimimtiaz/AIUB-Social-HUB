
<?php
session_start();

if($_SESSION['adminloggedIn']) {

    include_once "../logic/admin_top_bar.php";
    include_once "../logic/search_logic.php";
    include_once "../logic/user_logic.php";
    $userName=$_SESSION['friendId'];
    if($_SERVER['REQUEST_METHOD']=="POST") {

        if(isset($_POST['noticebtn'])) {
            $warn_msg=addslashes($_POST['notice']);
            insertwarn_msg($userName,$warn_msg);

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


        <table align="left">

            <tr>
                <td>
                    <img src="../data/images/admin.png" alt="Admin" height="100" width=100>Admin
                    <br>
                    <br>
                
                </td>
            
            </tr>

            <tr>
                <td>
                
                <a href="admin.php"> News Feed</a>
                </td>
            
            </tr>

            <tr>
                <td>
                    <a href="users.php">All Users</a>                    
                </td>
                
            
            </tr>


          
    
    </table> 
    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <table width="50%" align="center">

        <tr>
        <td>
            <h3>Warn User</h3>
        </td>

        </tr>

        <tr>
            <td align="left">

            <textarea name="notice" cols="30" rows="10" ></textarea>
            <br>

            </td>
        </tr>

        
        <tr>
            <td >

            <input type="submit" name="noticebtn" value="Warn">

            </td>
        </tr>

     </table>
    </form>

    </body>






</html>