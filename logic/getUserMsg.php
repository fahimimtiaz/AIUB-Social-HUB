<?php
include_once "../logic/user_logic.php";


$users=explode(',',$_POST['users'],2);
$uName=$users[0];
$friendUN=$users[1];
$messages="";
$chat_msg=get_messages($uName,$friendUN);
for($i=0;$i<count($chat_msg);$i++){
    if($chat_msg[$i][1]==$uName){
        if($chat_msg[$i][4]=="text_msg"){
            $messages=$messages."<tr><td width='50%'></td><td  style='background-color: darkslategrey; width=50%; color: white; border-radius: 8px; word-wrap: break-spaces' align='right' valign='middle'>
".$chat_msg[$i][3]."
</td></tr><tr><td colspan='2' align='right' style='font-size: smaller'>
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
            $messages=$messages."</td></tr><tr><td colspan='2' align='right' style='font-size: smaller'>".$chat_msg[$i][6]."</td></tr>";
        }

    }
    else{
        if($chat_msg[$i][4]=="text_msg"){
            $messages=$messages."<tr><td style='background-color: beige; color: black; width=50%; border-radius: 8px; word-wrap: break-spaces' align='left' valign='middle'>
".$chat_msg[$i][3]."
</td></tr><tr><td  align='left' style='font-size: smaller'>
".$chat_msg[$i][6]."</td><td width='50%'></td></tr>";
        }
        else{$messages=$messages."<tr><td  style='background-color: beige; width=50%; color: white; border-radius: 4px; word-wrap: break-spaces' align='left' valign='middle'>";
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
                $messages=$messages."<a href='".$chat_msg[$i][3]."' download>".$chat_msg[$i][5]."</a>";
            }
            $messages=$messages."</td><td width='50%'></td></tr><tr><td colspan='2' align='left' style='font-size: smaller'>".$chat_msg[$i][6]."</td></tr>";
        }
    }
}
echo $messages;
?>