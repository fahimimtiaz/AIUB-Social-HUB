<?php
session_start();
if($_SESSION['userloggedIn']) {
    include_once "../logic/search_logic.php";
    include_once "../logic/user_top_bar.php";
    include_once "../logic/user_logic.php";
    include_once "../logic/post_logic.php";

    $uName=$_SESSION['user']['username'];
    $profileHolderName=$_SESSION['user']['firstname']." ".$_SESSION['user']['lastname'];
    $posts="";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $post_id=0;

        if (isset($_POST['searchBtn'])) {
            search($_POST['searchText']);

        }

        if(isset($_POST['postBtn'])){
            $post_txt=$_POST['content'];
            if($post_txt!="" || $_FILES['files']['size'][0]!=0){
                $post_txt=addslashes($post_txt);

            insert_post($uName,$post_txt);
            }

            if($_FILES['files']['size'][0]!=0){
                $post_id=get_post_id($uName);
                $files=reArrayFiles($_FILES['files']);
                foreach ($files as $file){
                    $FileName=basename($file['name']);
                    $tmp_name=$file['tmp_name'];
                    $fileType=$file['type'];
                    //echo filetype($name);
                    $dir="../data/post_media_data/";
                    $targetFilePath=$dir.$FileName;
                    //$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                    if($tmp_name!="") {

                        if (insert_File_Post($post_id['post_id'], $FileName, $fileType, $targetFilePath)) {
                            move_uploaded_file($tmp_name, $targetFilePath);
                        }
                    }

                }
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


    $allPosts=get_All_Post();

    $person="";
    for($i=0;$i<count($allPosts);$i++){
        if($allPosts[$i][1]!=$uName){
            $res=getUserName($allPosts[$i][1]);
            $person="<a href='#' style='color: white' >". $res['firstname']." ".$res['lastname']."</a>";
        }
        else{
            $person="<a style='color: white' href='profile.php'>You</a>";
        }

        $posts=$posts."<tr><td colspan='2'><hr style=\"border-style: solid; border-color: white\"/></td></tr><tr>
<td colspan='2' style='font-size: x-large; font-weight: bold'>".$person." shared a post</td>
</tr>
<tr><td colspan='2' style='font-size: x-small'>
".$allPosts[$i][3]."
</td></tr><tr>
<td colspan='2'><p style='word-wrap: break-spaces'>".$allPosts[$i][2]."</p></td>
</tr>";
       $postFiles=get_post_files($allPosts[$i][0]);

       for($j=0;$j<count($postFiles);$j++){
           $posts=$posts."<tr><td align='center' valign='middle' colspan='2'>";
           if(startsWith($postFiles[$j][3],"image")){
               $posts=$posts."<img style='height: auto; width: 70%' src='".$postFiles[$j][4]."'>";
           }
           elseif (startsWith($postFiles[$j][3],"video")){
                $posts=$posts."<video style='height: auto; width: 70%'controls>
<source src='".$postFiles[$j][4]."' type='".$postFiles[$j][3]."'>
</video>";
           }
           elseif (startsWith($postFiles[$j][3],"audio")){
               $posts=$posts."<audio controls='controls'>
<source src='".$postFiles[$j][4]."' type='".$postFiles[$j][3]."'>
</audio>";
           }
           else{
               $posts=$posts."<a style='color: white' href='".$postFiles[$j][4]."' download>".$postFiles[$j][2]."</a>";
           }
           $posts=$posts."</td></tr>";

       }
       $posts=$posts."<tr><td colspan='2'><hr style=\"border-style: solid; border-color: white\"/></td></tr>";
       $allComments=get_All_Comments($allPosts[$i][0]);
       $commentator="";
       for($k=0;$k<count($allComments);$k++){
           if($allComments[$k][1]!="admin"){
                $commentator=getUserName($allComments[$k][1]);
                $commentator="<a style='color: white' href='#'>".$commentator['firstname']." ".$commentator['lastname']."</a>";
           }
           else{
               $commentator="Admin";
           }
           $posts=$posts."<tr><td  style='font-size: medium; font-weight: bold'>
".$commentator. " </td><td style='font-size: x-small' align='right'>".$allComments[$k][4]."
</td></tr>
<tr><td colspan='2'>
".$allComments[$k][3]."
</td></tr>";


       }

        $posts=$posts."<tr><td valign='middle' align='center' width='90%'>
<textarea name='comment_".$allPosts[$i][0]."' id='comment_".$allPosts[$i][0]."' rows='2' style='width: 100%; resize: none'></textarea></td>
<td align='left' valign='middle'><input type='submit' style='width: 100%' name='submit_".$allPosts[$i][0]."' id='submit_".$allPosts[$i][0]."' onclick='changePostId(this)' value='comment'>
</td></tr>
<tr><td colspan='2'><hr style=\"border-style: solid; border-color: white\"/></td></tr>";

       $allUser=getAllUser();
       $activeChats="";
       for($l=0;$l<count($allUser);$l++){
           $statCircle="";
           if($allUser[$l][8]==1){
               $statCircle="<img src=\"../data/images/circle%20(1).png\" alt=\"active\" height=\"20\" width=\"20\"> ";
           }
           else{
               $statCircle="<img src=\"../data/images/circle.png\" alt=\"Inactive\" height=\"20\" width=\"20\"> ";
           }
           if($allUser[$l][3]!=$uName){
               $activeChats=$activeChats."<tr><td width='90%' style=\"background-color: darkslategrey;padding: 3px; border-radius: 3px \"><label >
<a style='color: beige' href=\"friends_profile.php\" id=\"a_".$allUser[$l][3]."\" onclick='setFriendId(this)'>
".$allUser[$l][1]. " ".$allUser[$l][2]."</a></label>
</td><td>
".$statCircle."
</td></tr>";
           }
       }
    }
    $propic="";
    $profileInfo=get_user_profile($uName);
    if($profileInfo['pro_pic']!=""){
        $propic=$profileInfo['pro_pic'];
    }
    else{
        $propic="../data/images/user_propic_dummy.png";
    }
}
else{
    header("Location:loginandregistration.php");
}


?>

<html>
    <head>
        <title>ASH|Home</title>
        <script src="../logic/post_logic.js"></script>
    </head>

    <body >


        <table width="20%" align="left" style="border-radius: 5px; color: darkslategrey; background-color: beige; padding: 10px" >

        <tr>
            <td>
                <img src="<?= $propic ?>" alt="Profile" style="width: 170px; height: 170px">
            </td>
            
        </tr>

        <tr>
        <td style="background-color: darkslategrey; padding: 3px; border-radius: 3px ">
            <a style="color: beige" href="profile.php"> <?= $profileHolderName; ?> </a>
            </td>
        </tr>

        <tr> 
            <td style="background-color: darkslategrey;padding: 3px; border-radius: 3px ">
                <a style="color: beige" href="messenger.php">Messenger</a>
                </td>

        </tr>     



        </table>    
      
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" method="post">
        <table align="left" width="60%" style="border-radius: 5px; color: darkslategrey; background-color: beige; padding: 10px" >
        <tr>
            <td colspan="2">
			<h1>Update Status</h1><hr style="border-style: solid; border-color: darkslategrey"/>
            </td> 
        </tr>      
		<tr>
            <td colspan="2" align="center">
				<textarea style="width: 90%; resize: none" placeholder="Whats on your mind?" rows="5" id="content" name="content"></textarea>
            </td>
        </tr>    
        <tr>        
			<td width="90%" valign="middle" align="right">
            <input type="file" accept="*/*" name="files[]" multiple style="width: 94.5%; border-style: solid" onchange="validFileSize()">
            </td>
                <td align="left" valign="middle">
                    <input type="submit" name="postBtn" id="postBtn" value="Post">
                </td>
            </tr>
            <tr>
                <td colspan="2" height="20px"></td>
            </tr>
        </table>
    </form>

            <table align="right" width="20%" style="border-radius: 5px; color: darkslategrey; background-color: beige; padding: 10px" >

                <tr>
                    <td colspan="2">
                        <h3>Active Friends</h3><hr style="border-style: solid; border-color: darkslategrey"/>
                    </td>
                </tr>
                <?= $activeChats ?>


            </table>

        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <input type="hidden" name="postIdHolder" id="postIdHolder" value="0">
		<table align="center" width="54%" id="all_post"  valign="middle" style="background-color: darkslategrey; color: white; padding: 10px; border-radius: 5px" >
            <?= $posts ?>

        </table>

        </form>

		



        
        
    <body>
</html>












 
