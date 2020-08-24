
<?php
session_start();

if($_SESSION['adminloggedIn']) {

    include_once "../logic/admin_top_bar.php";
    include_once "../logic/search_logic.php";
    include_once "../logic/user_logic.php";






    $result = get_all_user();
    $username = array();
    $firstname = array();
    $lastname = array();
    $userid = array();
    $ban_stat=array();
    $stat_val=array();
    $btnName=array();

    foreach ($result AS $row) {
        $username[]=$row[3];
        $firstname[]=$row[1];
        $lastname[]=$row[2];
        $userid[]=$row[0];
        if($row[9]==0){
            $ban_stat[]='Valid User';
            $stat_val[]=1;
            $btnName[]="Ban";
        }
        else{
            $ban_stat[]='Banned User';
            $stat_val[]=0;
            $btnName[]="Unban";
        }

    }
}
else{
    header("Location:loginandregistration.php");
}


?>

<html>
<head>

    <script>
        function ban_user(btn) {
            var id=btn.id;
            var statVal=btn.value;
            var ban=[id,statVal]
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    location.reload();
                }
            };
            xhttp.open("GET", "../logic/user_logic.php?ban="+ban, true);
            xhttp.send();

        }



    </script>
    <script src="../logic/post_logic.js"></script>

</head>
<body>


<table align="left">

    <tr>
        <td>
            <img src="../data/images\admin.png" alt="Admin" height="100" width=100>Admin
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

<h3 align=Center>All Users </h3>

<form method="post" action="warning.php">
<table width="40%" align="center" border="1">


    <tr>
        <th>User Name</th>
        <th>Name</th>
        <th>Option</th>
        <th>User Status</th>
        <th></th>
    </tr>


    <?php

    for ($i=0; $i <count($username); $i++) {

        echo ' <tr align="center" valign="center" style="padding: 10px">
            <td>
               '.$username[$i].'
            </td>
            <td>
           <a href="userprofile.php" id=a_'.$username[$i].' onclick="setFriendId(this)">'.$firstname[$i] ." " .$lastname[$i].'</a> 
            </td>
            <td>
            <button id='.$userid[$i].' onClick="ban_user(this)" value='.$stat_val[$i].'>'.$btnName[$i].'</button>
            </td>
            <td>
                '.$ban_stat[$i].'
            </td>
            <td>
                <input type="submit" id="s_'.$username[$i].'" onclick="setFriendId(this)" name="s_'.$username[$i].'" value="Warn User">
            </td>
            </tr>
            ';
    }




    ?>




</table>
</form>


</body>
</html>