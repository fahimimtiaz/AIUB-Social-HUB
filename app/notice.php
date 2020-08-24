
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
                    <a href="admin.php"><img src = "images\logo_color1.png" height="25" width="40"></a>
                </td>
                <td width="20%" colspan = "2"  align="left">
                    <input type="text" name="searchText" size="60">
                </td>

                <td width="35%" align="left">
                    <!-- <img src = "images\search_button.png" height="20" width="20">-->
                    <input type="submit" name="searchBtn" value="Search" height="20px">
                </td>
                <td width="5%"  align="right"> </td>

               
                <td width="5%" align="left">
                    <p><a href="admin.php"><font color="white" size ="4">Admin</font></a></p>
                </td>
                <td width="5%"  align="right"> </td>

                <td width="5%" align="left">
                    <p><a href="loginandregistration.php"><font color="white" size ="4">Log Out</font></a></p>
                </td>
            </tr>
        </table>
    </form>
             

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
            <tr>
                <td>
                <a href="notice.php"> Notice</a> 
                </td>
            
            
            </tr>

          
    
    </table> 

    <table width="50%" align="center">

        <tr>
        <td>
            <h3>Post Notice For Everyone</h3>
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

            <button name="noticebtn">Post</button>

            </td>
        </tr>

     </table>   


    </body>






</html>