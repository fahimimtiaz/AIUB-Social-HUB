
<?php


session_start();
include_once "../logic/admin_top_bar.php";
include_once "../logic/search_logic.php";
include_once "../logic/user_logic.php";
include_once "../logic/post_logic.php";
if($_SESSION['adminloggedIn']) {
    $uName=$_SESSION['friendId'];
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


            $post_id=$_POST['postIdHolder'];
            if(isset($_POST['submit_'.$post_id])){
                if($_POST['comment_'.$post_id]!=""){
                    $comment=addslashes($_POST['comment_'.$post_id]);
                    insert_comment("admin",$post_id,$comment);
                }
            }

    }
    $posts = "";
    $allPosts = get_user_post($uName);
    //var_dump($allPosts);
    $person = "";
    for ($i = 0; $i < count($allPosts); $i++) {
        $res = getUserName($allPosts[$i][1]);
        //var_dump($res);
        //echo "<br>";
        $person = $res['firstname'] . " " . $res['lastname'] ;

        $posts = $posts . "<tr><td colspan='2'><hr style=\"border-style: solid; border-color: white\"/></td></tr><tr>
<td colspan='2' style='font-size: x-large; font-weight: bold'>" . $person . " shared a post</td>
</tr>
<tr><td colspan='2' style='font-size: x-small'>
" . $allPosts[$i][3] . "
</td></tr><tr>
<td colspan='2'><p style='word-wrap: break-spaces'>" . $allPosts[$i][2] . "</p></td>
</tr>";
        $postFiles = get_post_files($allPosts[$i][0]);

        for ($j = 0; $j < count($postFiles); $j++) {
            $posts = $posts . "<tr><td align='center' valign='middle' colspan='2'>";
            if (startsWith($postFiles[$j][3], "image")) {
                $posts = $posts . "<img style='height: auto; width: 70%' src='" . $postFiles[$j][4] . "'>";
            } elseif (startsWith($postFiles[$j][3], "video")) {
                $posts = $posts . "<video style='height: auto; width: 70%'controls>
<source src='" . $postFiles[$j][4] . "' type='" . $postFiles[$j][3] . "'>
</video>";
            } elseif (startsWith($postFiles[$j][3], "audio")) {
                $posts = $posts . "<audio controls='controls'>
<source src='" . $postFiles[$j][4] . "' type='" . $postFiles[$j][3] . "'>
</audio>";
            } else {
                $posts = $posts . "<a style='color: white' href='" . $postFiles[$j][4] . "' download>" . $postFiles[$j][2] . "</a>";
            }
            $posts = $posts . "</td></tr>";

        }
        $posts = $posts . "<tr><td colspan='2'><hr style=\"border-style: solid; border-color: white\"/></td></tr>";
        $allComments = get_All_Comments($allPosts[$i][0]);
        $commentator = "";
        for ($k = 0; $k < count($allComments); $k++) {
            if ($allComments[$k][1] != "admin") {
                $commentator = getUserName($allComments[$k][1]);
                $commentator =  $commentator['firstname'] . " " . $commentator['lastname'];
            } else {
                $commentator = "Admin";
            }
            $posts = $posts . "<tr><td  style='font-size: medium; font-weight: bold'>
" . $commentator . " </td><td style='font-size: x-small' align='right'>" . $allComments[$k][4] . "
</td></tr>
<tr><td colspan='2'>
" . $allComments[$k][3] . "
</td></tr>";
        }
        $posts=$posts."<tr><td valign='middle' align='center' width='90%'>
<textarea name='comment_".$allPosts[$i][0]."' id='comment_".$allPosts[$i][0]."' rows='2' style='width: 100%'></textarea></td>
<td align='left' valign='middle'><input type='submit' style='width: 100%' name='submit_".$allPosts[$i][0]."' id='submit_".$allPosts[$i][0]."' onclick='changePostId(this)' value='comment'>
</td></tr>
<tr><td colspan='2'><hr style=\"border-style: solid; border-color: white\"/></td></tr>";
    }
    //var_dump($posts);
    $profile=get_user_profile($uName);
    $user=getUserName($uName);
    $fullname=$user['firstname']." ".$user['lastname'];
    $department = $profile['department'];
    $place = $profile['place'];
    $hometown = $profile['hometown'];
    $propic = $profile['pro_pic'];
    $coverpic = $profile['cover_pic'];
    $birthdate = $user['birthday'];
}


?>
<html>
    <head>
        <script src="../logic/post_logic.js"></script>
    </head>

    <body>


    <table width="100%">
        <tr>
            <td width="100%" align="center" colspan = "3">
                <img src = "<?php echo $coverpic; ?>"  style="height: 300px; width: 100%">

            </td>
        </tr>
    </table>


    <table width ="20% "  align="left">
        <tr>
            <td >
                &nbsp; <img src = "<?php echo $propic; ?>" align="left" style="height: auto; width: 170px" >
            </td>
        </tr>

                <td >
                    &nbsp; <h3> About </h3> <hr style="border-style: solid; border-color: darkslategrey"/>
                    &nbsp; Full Name :  <font color="aqua" size 4><?php echo $fullname; ?></font>

                    <br><br>
                    &nbsp; Studies At : <font color="aqua" size 4>American International University-Bangladesh</font>

                    <br><br>
                    &nbsp; Department : <font color="aqua" size 4><?php echo $department; ?></font>

                    <br><br>
                    &nbsp; Lives in :   <font color="aqua" size 4><?php echo $place; ?></font>

                    <br><br>
                    &nbsp; Gender :   <font color="aqua" size 4>Male</font>

                    <br><br>
                    &nbsp; Birth Date :   <font color="aqua" size 4><?php echo $birthdate; ?></font>

                    <br><br>
                    &nbsp; Hometown :   <font color="aqua" size 4><?php echo $hometown; ?></font>

                </td>
            </table>



            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <input type="hidden" name="postIdHolder" id="postIdHolder" value="0">
                <table align="center" width="75%" id="all_post"  valign="middle" style="background-color: darkslategrey; color: white; border-radius: 5px; padding: 10px">
                    <tr>
                        <td><h3>All Post</h3></td>
                    </tr>
                    <?= $posts ?>

                </table>

            </form>


            
        
        
    <body>
</html>