<?php
include_once "../data/profile_data.php";
if($_SESSION['userloggedIn']){
    $uName=$_SESSION['user']['username'];

    include_once "../logic/search_logic.php";
    include_once "../logic/user_top_bar.php";
    include_once "../logic/post_logic.php";
    include_once "../logic/user_logic.php";
    $searchValue="";
    $posts="";
if($_SERVER['REQUEST_METHOD']=="POST"){
    if (isset($_POST['searchBtn'])) {
        search($_POST['searchText']);

    }
    else if(isset($_POST['c_submit'])){

        $filename = basename($_FILES['c_image']['name']);

        $imageLoc = "../data/images/".$filename;
        if($_FILES['c_image']['size']!=0){
        $query = "update profile set cover_pic='$imageLoc' WHERE username='$uName'  ; ";
        $result= execute_query($query);
        move_uploaded_file($_FILES["c_image"]["tmp_name"], $imageLoc);
        header("Location:profile.php");}
    }


     else if(isset($_POST['p_submit'])){

        $filename = basename($_FILES['p_image']['name']);

         $p_imageLoc = "../data/images/".$filename;
         if($_FILES['p_image']['size']!=0){

         $query = "update profile set pro_pic='$p_imageLoc' WHERE username='$uName'  ; ";

        execute_query($query);
         move_uploaded_file($_FILES["p_image"]["tmp_name"], $p_imageLoc);

        header("Location:profile.php");
         }
     }
     else{
         $post_id=$_POST['postIdHolder'];
         if(isset($_POST['submit_'.$post_id])){
             if($_POST['comment_'.$post_id]!=""){
                 $comment=addslashes($_POST['comment_'.$post_id]);
                 insert_comment($uName,$post_id,$comment);
             }
         }
     }
}
$allPosts=get_user_post($uName);

    $person="";
    for($i=0;$i<count($allPosts);$i++) {
        if ($allPosts[$i][1] != $uName) {
            $res = getUserName($allPosts[$i][1]);
            $person = "<a style='color: white' href='#'>" . $res['firstname'] . " " . $res['lastname'] . "</a>";
        } else {
            $person = "<a style='color: white' href='profile.php'>You</a>";
        }

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
                $commentator = "<a style='color: white' href='#'>" . $commentator['firstname'] . " " . $commentator['lastname'] . "</a>";
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

        $posts = $posts . "<tr><td valign='middle' align='center' width='90%'>
<textarea name='comment_" . $allPosts[$i][0] . "' id='comment_" . $allPosts[$i][0] . "' rows='2' style='width: 100%; resize: none'></textarea></td>
<td align='left' valign='middle'><input type='submit' style='width: 100%' name='submit_" . $allPosts[$i][0] . "' id='submit_" . $allPosts[$i][0] . "' onclick='changePostId(this)' value='comment'>
</td></tr>
<tr><td colspan='2'><hr style=\"border-style: solid; border-color: white\"/></td></tr>";
    }

}
else{
    header("Location:loginandregistration.php");
}
?>
<html>
    <head>
    </head>
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../logic/profile_bar_style.css">
    <script src="../logic/post_logic.js"></script>

    <body>


    <form method="POST" action="profile.php" enctype="multipart/form-data">
            <table width="100%">
                <tr>
                    <td width="100%" align="center" colspan = "3">
                        <img src = "<?= $coverpic; ?>" style="height: 300px; width: 100%"  >
                            
                    </td>
                </tr>
                 <tr>
                    
                    <td width="100%" align="center" colspan = "3">
                        <input type="file" name="c_image" size="50">  
                        <input type="submit" name="c_submit" value="upload" >      
                    </td>

                   
                </tr>
            </table>
     </form>  

     <form method="POST" action="profile.php" enctype="multipart/form-data">  
            <table width ="20% "  align="left" style="padding: 10px">
                <tr> 
                    <td >
                        &nbsp; <img src = <?php echo $propic; ?> allign ="left" style="height: auto; width: 170px" >
                    </td>
                </tr>

                <tr>
                    
                    <td width="100%" align="center" colspan = "3">
                        <input type="file" name="p_image" size="50">  
                        <input type="submit" name="p_submit" value="upload" >      
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
        </form>

    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <input type="hidden" name="postIdHolder" id="postIdHolder" value="0">
        <table align="center" width="75%" id="all_post"  valign="middle" style="background-color: darkslategrey; color: white; padding: 10px; border-radius: 5px" >
            <?= $posts ?>

        </table>

    </form>



            
        
        
    <body>
</html>