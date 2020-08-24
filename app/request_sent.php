<?php
    $searchValue="";
    if(isset($_POST['searchBtn'])){
        $searchValue=$_POST['searchText'];
        if(empty($searchValue)){

        }
        else if( is_integer(strpos($searchValue,'Rishita'))||is_integer(strpos($searchValue,'rishita'))){
            header("Location:searchResult.php?search=$searchValue");
        }
        else{
            header("Location:searchNotFound.php?search=$searchValue");

        }
    }


?>

<html>
    <head>
    </head>

    <body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <table bgcolor="#2f4f4f" width="100%" cellspacing="0" cellpadding="0" height= "40px" border="0">
            <tr>
                <td width="5%"  align="right"> </td>
                <td width="5%" align="center">
                    <a href="home.php"><img src = "images\logo_color1.png" height="25" width="40"></a>
                </td>
                <td width="30%" colspan = "2"  align="right">
                    <input type="text" name="searchText" size="60">
                </td>

                <td width="50px" align="center" valign="middle">
                    <!--                    <img src = "images\search_button.png" height="20" width="20">-->
                    <input type="submit" name="searchBtn" value="Search" height="20px">
                </td>
                <td width="5%"  align="right"> </td>

                <td width="5%" align="left">
                    <p><a href="profile.php"><font color="white" size ="4">Profile</font></a></p>
                </td>
                <td width="5%"  align="right"> </td>

                <td width="5%" align="left">
                    <p><a href="home.php"><font color="white" size ="4">Home</font></a></p>
                </td>

                <td width="5%"  align="right"> </td>

                <td width="5%" align="left">
                    <p><a href="notification.php"><font color="white" size ="4">Notification</font></a></p>
                </td>

                <td width="5%"  align="right"> </td>

                <td width="5%" align="left">
                    <p><a href="setting_general.php"><font color="white" size ="4">Setting</font></a></p>
                </td>
                <td width="5%"  align="right"> </td>

                <td width="5%" align="left">
                    <p><a href="loginandregistration.php"><font color="white" size ="4">Log Out</font></a></p>
                </td>
            </tr>
        </table>
    </form>
            <table width="100%">
                <tr>
                    <td width="100%" align="center" colspan = "3">
                        <img src = "../data/images/c_photo.jpg" height="300" width="1348">
                            
                    </td>
                </tr>
            </table>

            
            <table width ="20% "  align="left">
                <tr> 
                    <td >
                        &nbsp; <img src = "images\propicrishita.jpg" allign ="left" height="170" width="170" >
                    </td>
                </tr>

                <td >
                    <br>
                     &nbsp; User Name :  <font color="aqua" size 5>Rishita</font>

                     <br><br>
                     &nbsp; Studies At : <font color="aqua" size 4>American International University Bangladesh</font>

                    <br><br>
                    &nbsp; Department : <font color="aqua" size 4>CS(Computer Science)</font>

                    <br><br>
                     &nbsp; Lives in :   <font color="aqua" size 4>Banani,Dhaka</font>
                            
                </td>
            </table>

            <table width ="40%" align="left" colspane="2">

                

                <tr>
                    <td>
                        <br>
                        <br>
                        <font color="aqua" size="4">Request Sent</font>
                        <input type="button" name = "message" value="Message">

                        <br>
                        <br>
                        <br>
                        <br>


                    </td>
                    <td>
                        <a href="friends.php"><font color="aqua" size="4">Friends</font></a>
                    </td>
                </tr>


                <tr>
                    <td>
                        <br>
                        <br>
                        <img src="../data/images/IMG_6189.JPG" alt="Pro" height="20" width="20"><a href="profile.php">Kutub Uddin Faisal</a> shared a post
                    </td>
            
                </tr>
                <tr>
                    <td>
                        <p><font size="5">Hello Friends.How are you all</font></p>
                        comments : 
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="../data/images/propic.jpg" alt="Pro" height="20" width="20">
                        <a href="profile.php">Imtiaz Ahmed Fahim</a> I am fine.How about you?

                    </td>
                   
                
                </tr>   

                <tr>
                    <td>
                        <textarea name="comment" cols="30" placeholder="Enter your comment"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>
                        <button name="comment" value="submir">Comment</button>
                    </td>
                </tr>
            </table>

            <table width ="40%" align="right" colspane="2">

                <tr>
                    <td align="center">
                        <font color="black" size ="5">Photos</font>
                    </td>
                </tr>

                <tr>
                    <td align="center">
                        <img src = "images\photos2.jpg" allign ="left" height="250" width="250" >
                    </td>
                </tr>

            </table>

            
        
        
    <body>
</html>