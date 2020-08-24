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
    $searchRes="";
    foreach ($_SESSION['searchRes'] as $row){
        $searchRes=$searchRes."<tr>
            <td colspan=\"2\">
                <hr style=\"border-style: solid; border-color: darkslategrey\"/>
            </td>
        </tr><tr align=\"left\" style='background-color: darkslategrey; color: white; border-radius: 10px; padding: 15px'>
            <td style='width: 10%; height: auto ;padding: 10px; border-radius: 5px' >
                <a id='p_".$row[3]."' href=\"friends_profile.php\" onclick='setFriendId(this)'><img src=\"".$row[14]."\" style='height: auto; border-radius: 10px' width=\"100%\" align='center' > </a>
            </td>
            <td style='padding: 10px; border-radius: 5px'>
                <a id='a_".$row[3]."' href=\"friends_profile.php\" onclick='setFriendId(this)' style='color: white'><font size=\"5\">".$row[1]." ".$row[2]."</font> </a>
            </td>
            
        </tr>
        <tr>
            <td colspan=\"2\">
                <hr style=\"border-style: solid; border-color: darkslategrey\"/>
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
    <title>ASH-Search Result</title>
    <script src="../logic/post_logic.js"></script>
</head>
<body>

<?php
$searchVal=$_GET['search'];
?>
<p align='center'><font size='10'><b>Search Results for '<?= $searchVal ?>'</b></font> </p>
<form  method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <table align="left" width="10%" border="1">
                <tr>
                    <td>
                        <p><font size="5"><b>Filters:</b></font> </p>
                    </td>
                </tr>
            <tr>
                <td>
                    By Hometown:<br> <input type="text" name="srcByHome">
                </td>
            </tr>
            <tr>
                <td>
                    By School:<br> <input type="text" name="srcBySchool">
                </td>
            </tr>
            <tr>
                <td>
                    By Batch:<br> <input type="text" name="srcByBatch">
                </td>
            </tr>
            <tr>
                <td>
                    By Current City:<br> <input type="text" name="srcByCity">
                </td>
            </tr>
            <tr>
                <td>
                   <hr>
                </td>
            </tr>
        </table>
</form>
<form  method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <table align="center" width="60%" >
       <?= $searchRes; ?>
    </table>
</form>

</body>
</html>