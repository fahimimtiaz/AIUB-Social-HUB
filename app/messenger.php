<?php
session_start();

if($_SESSION['userloggedIn']==true){

    include_once "../logic/search_logic.php";
    include_once "../logic/user_top_bar.php";
    include_once "../logic/user_logic.php";

    $chats=$friendUN=$profileHolderName=$friendName="";

    $allUsers=get_all_user();
    $userChatStatusOn="";
    $propic="";
    $userChatStatusOff="";
    $uName=$_SESSION['user']['username'];
    $profileHolderName=$_SESSION['user']['firstname']." ".$_SESSION['user']['lastname'];

    for($i=0;$i<count($allUsers);$i++){

        if($allUsers[$i][3]!=$uName){
            if($friendUN==""){
                //$_SESSION['fnd']
                $friendUN=$allUsers[$i][3];
                $friendName=$allUsers[$i][1]." ".$allUsers[$i][2];

                $profileInfo=get_user_profile($friendUN);
                if($profileInfo['pro_pic']!=""){
                    $propic=$profileInfo['pro_pic'];
                }
                else{
                    $propic="../data/images/user_propic_dummy.png";
                }
            }
            $chats=$chats."<tr><td colspan='2' style='color: white; background-color: darkslategrey; font-weight: bold; padding:7px;padding-left: 20px;padding-right: 20px; border-radius: 5px; '><label style=' width: 100%; height: 100%' id='".$allUsers[$i][3]."' onclick='getUserMsg(this)'>".$allUsers[$i][1]." ".$allUsers[$i][2]."</label>";
            if($allUsers[$i][8]==1){
                $chats=$chats."<img align='right' src=\"../data/images/circle%20(1).png\" alt=\"Active\" height=\"20px\" width=\"20px\">";
            }
            else{
                $chats=$chats."<img align='right' src=\"../data/images/circle.png\" alt=\"Inactive\" height=\"20px\" width=\"20px\">";
            }
            $chats=$chats."</td></tr><tr><td colspan='2'><hr style=\"border-style: solid; border-color: darkslategrey\"/></td></tr>";
        }
        else{
            if($allUsers[$i][8]=='1'){
                $userChatStatusOn="checked";
            }
            else{
                $userChatStatusOff="checked";
            }

        }
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){


        if(isset($_POST['searchBtn'])){
            search($_POST['searchText']);

        }
        if(isset($_POST['send'])){
            $friendUN=$_POST['friendUn'];
            if(!(empty($_POST['text_msg']) && $_FILES['files']['size'][0]==0)){
                if(!empty($_POST['text_msg'])){
                    $fileType='text_msg';
                    $FileName='text_msg';
                    $msg=addslashes($_POST['text_msg']);
                    insert_msg($uName,$friendUN,$msg,$fileType,$FileName);
                }
                //var_dump($_FILES);
                if($_FILES['files']['size'][0]!=0){

                    $files=reArrayFiles($_FILES['files']);
                    foreach ($files as $file){
                        $FileName=basename($file['name']);
                        $tmp_name=$file['tmp_name'];
                        $fileType=$file['type'];
                        //echo filetype($name);
                        $dir="../data/messenger_media_data/";
                        $targetFilePath=$dir.$FileName;
                        //$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                        if($tmp_name!="") {

                            if (insert_msg($uName, $friendUN, $targetFilePath, $fileType, $FileName)) {
                                move_uploaded_file($tmp_name, $targetFilePath);
                            }
                        }

                    }
                }
            }
        }
        if(isset($_POST['save'])){
            $stat=$_POST['active'];
            change_status($uName,$stat);
            header("Location:messenger.php");
        }
    }


    $chat_msg=get_messages($uName,$friendUN);
    $messages="";
    for($i=0;$i<count($chat_msg);$i++){
        if($chat_msg[$i][1]==$uName){
            if($chat_msg[$i][4]=="text_msg"){
                $messages=$messages."<tr><td width='50%'></td><td  style='background-color: darkslategrey; width=50%; color: white; border-radius: 8px; word-wrap: break-spaces' align='right' valign='middle'>
".$chat_msg[$i][3]."
</td></tr><tr><td colspan='2' align='right' style='font-size: x-small'>
".$chat_msg[$i][6]."</td></tr>";
            }
            else{

                $messages=$messages."<tr><td width='50%'></td><td  style='background-color: darkslategrey; width=50%; color: white; border-radius: 4px; word-wrap: break-spaces' align='right' valign='middle'>";
                    if(startsWith($chat_msg[$i][4],"image")){
                        $messages=$messages."<img src='".$chat_msg[$i][3]."' style='width: 100% ; height: auto'>";
                    }
                    else if(startsWith($chat_msg[$i][4],"video")){
                        $messages=$messages."<video width='100%' style='height: auto' controls><source src='".$chat_msg[$i][3]."' type='".$chat_msg[$i][4]."'></video>";
                    }
                    else if(startsWith($chat_msg[$i][4],"audio")){
                        $messages=$messages."<audio controls='controls'><source src='".$chat_msg[$i][3]."' type='".$chat_msg[$i][4]."'></audio>";
                    }
                    else{
                        $messages=$messages."<a href='".$chat_msg[$i][3]."' style='color: white;' download>".$chat_msg[$i][5]."</a>";
                    }
                $messages=$messages."</td></tr><tr><td colspan='2' align='right' style='font-size: x-small'>".$chat_msg[$i][6]."</td></tr>";
            }

        }
        else{
            if($chat_msg[$i][4]=="text_msg"){
                $messages=$messages."<tr><td style='background-color: beige; color: darkslategrey; width=50%; border-radius: 8px; word-wrap: break-spaces' align='left' valign='middle'>
".$chat_msg[$i][3]."
</td></tr><tr><td  align='left' style='font-size: x-small'>
".$chat_msg[$i][6]."</td><td width='50%'></td></tr>";
            }
            else{$messages=$messages."<tr><td  style='background-color: beige; width=50%; color: darkslategrey; border-radius: 4px; word-wrap: break-spaces' align='left' valign='middle'>";
                if(startsWith($chat_msg[$i][4],"image")){
                    $messages=$messages."<img src='".$chat_msg[$i][3]."' style='width: 100% ; height: auto'>";
                }
                else if(startsWith($chat_msg[$i][4],"video")){
                    $messages=$messages."<video width='100%' style=' height: auto' controls><source src='".$chat_msg[$i][3]."' type='".$chat_msg[$i][4]."'></video>";
                }
                else if(startsWith($chat_msg[$i][4],"audio")){
                    $messages=$messages."<audio controls='controls'><source src='".$chat_msg[$i][3]."' type='".$chat_msg[$i][4]."'></audio>";
                }
                else{
                    $messages=$messages."<a style='color:darkslategrey' href='".$chat_msg[$i][3]."' download>".$chat_msg[$i][5]."</a>";
                }
                $messages=$messages."</td><td width='50%'></td></tr><tr><td colspan='2' align='left' style='font-size: x-small'>".$chat_msg[$i][6]."</td></tr>";
            }
        }
    }



}
else{
    header("Location:loginandregistration.php");
}


?>

<html>
    <head>
        <title>
            ASH-Massanger
        </title>
        <script src="../logic/massenger_logic.js"></script>
        <script src="../logic/post_logic.js"></script>
    </head>
    <body>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <table align="left" width="25%" cellpadding="4px" valign="top"  >
            <tr>
                <th align="left" valign="middle" height="30px">
                    <font size="5"><b>Chats</b></font>

                </th>
                <td width="20%" align="center" valign="middle">
                    <img src="../data/images/chats.png" height="30px" width="30px" align="center">
                </td>
            </tr>
            <tr>
                <td colspan="2" valign="top">
                    <hr style="border-style: solid; border-color: darkslategrey"/>
                </td>
            </tr>
           <?= $chats ?>
            <tr>
                <td align="left" valign="middle" height="30px">
                    <font size="5"><b>Chat Settings</b></font>

                </td>
                <td width="20%" align="center" valign="middle">
                    <img src="../data/images/chat_settings.png" height="30px" width="30px" align="center">
                </td>

            </tr>
            <tr>
                <td colspan="2" valign="top">
                    <hr style="border-style: solid; border-color: darkslategrey"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="profile.php"  style="color: darkslategrey" ><?= $profileHolderName ?></a>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Active Status: <input type="radio" name="active" <?= $userChatStatusOn; ?> value="1"> On <input type="radio" name="active" <?= $userChatStatusOff; ?> value="0"> Off
                </td>

            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="save" value="save">
                </td>

            </tr>


        </table>

    </form>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div align="right">
    <table align="right"  cellpadding="4px" style="width: 75%" class="chat_body">
        <tr>
            <td colspan="2" align="center" valign="bottom">
                <a href="friends_profile.php" id="a_<?= $friendUN ?>" onclick="setFriendId(this)" ><div id="proPic"><img src="<?= $propic; ?>" align="left" height="40px" width="40px" ></div><font size="5"><b >  <p id="friendName" style="color: darkslategrey"><?= $friendName ?></p> </b></font></a>
            </td>

        </tr>
        <tr>
            <td colspan="2" valign="top">
                <hr style="border-style: solid; border-color: darkslategrey"/>
            </td>
        </tr>
    </table>
        <table id="messages" align="right"  cellpadding="4px" style="width: 75%; " class="chat_body">

        <?= $messages ?>

        </table>
        <table align="right"  cellpadding="4px" style="width: 75%" class="chat_body">
        <tr>
            <td  valign="top" colspan="2">
                <hr style="border-style: solid; border-color: darkslategrey"/>
            </td>

        </tr>
        </table>
        </div>
    </form>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" onsubmit="validFileSize()">
        <input type="hidden" id="username" value="<?= $uName ?>">
        <input type="hidden" id="friendUN"  name="friendUn" value="<?= $friendUN ?>">
        <table align="right" width="75%%" cellpadding="2px" valign="bottom" style="color: darkslategrey" >
            <tr>
                <td  valign="middle" align="center"  colspan="2" >
                    <textarea rows="2" name="text_msg" style="width: 60%; resize: vertical"></textarea>
                </td>


            </tr>
            <tr>
                <td  valign="top" align="right" width="75%" >
                    <input type="file" accept="*/*" name="files[]" id="files" multiple="multiple" onchange="validFileSize()" style="border-style: solid; width: 72.2%">
                </td>


                <td  valign="middle" align="left" >
                    <input type="submit" id="send" name="send" value="send" width="72px">
                </td>

            </tr>
        </table>
    </form>
    </body>
</html>
