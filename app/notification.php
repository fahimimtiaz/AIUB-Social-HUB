<?php
session_start();

if($_SESSION['userloggedIn']){
    include_once "../logic/search_logic.php";
    include_once "../logic/user_top_bar.php";
    include_once "../logic/user_logic.php";
    if($_SERVER['REQUEST_METHOD']=='POST'){

        if(isset($_POST['searchBtn'])){
            search($_POST['searchText']);

        }
    }

    $id=$_SESSION['user']['username'];
    $warn=get_user_warning($id);
    $notifictions="";
    foreach ($warn as $row){
        $notifictions=$notifictions."<tr>
<td style='font-size: x-small'>
<hr/><br/>
".$row[2]."
</td>
</tr>
<tr>
<td>
".$row[1]."
</td>
</tr>";
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

            <table width="50%" align="center" >


            <tr>
                <td colspan="3">
                
                    <h3>Your Warnings</h3>
                
                </td>

            </tr>
                <?= $notifictions; ?>
            
            
            
            </table>  









    </body>









</html>