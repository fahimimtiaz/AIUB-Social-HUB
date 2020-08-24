<?php
session_start();

if($_SESSION['userloggedIn']){
    include_once "../logic/search_logic.php";
    include_once "../logic/user_top_bar.php";
    if($_SERVER['REQUEST_METHOD']=='POST'){

        if(isset($_POST['searchBtn'])){
            search($_POST['searchText']);

        }
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


        <h2> Changed Successfully </h2>

        <table width="20%" align="left" >

        <tr>
            <td>
                <img src="../data/images/IMG_6203.JPG" alt="Profile" height="200" width="200">
            </td>
            
        </tr>

        <tr>
        <td>
            <font size="4">IMTIAZ AHMED FAHIM </font>
            </td>
        </tr>

        <tr> 
            <td>
            <a href="messenger.php">Messenger</a>
            </td>

        </tr>     



        </table>    
      

        <table align="left" >
        <tr>
            <td>
			<h1>Update Status</h1>
            </td> 
        </tr>      
		<tr>
            <td>	
				<textarea cols="80" placeholder="Whats on your mind?" rows="10" name="content" required></textarea>
            </td>
        </tr>    
        <tr>        
			<td>
            <br>	
            <input type="file" name="image">
            </td>
        </tr>        
		
        <tr>
            <td align="right">	
        	<button name="Submit" value="share">Share</button>
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
            </td>
        </tr>
        <tr>
            <td>
                <img src="../data/images/IMG_6203.JPG" alt="Pro" height="20" width="20">
                <a href="profile.php">Imtiaz Ahmed Fahim</a> I am fine.How about you?

            </td>
           
        
        </tr>	

        <tr>
            <td>
                <br>
                <textarea name="comment" cols="30" placeholder="Enter your comment"></textarea>
            </td>
        </tr>

        <tr>
        <td>
            <button name="comment" value="submit">Comment</button>
        </td>
        </tr>
        <tr>
            <td>
            <br>
                <a href="profile.php">Mohammad Hanif</a> shared a photo
            </td>
        </tr>
        <tr>
            <td>
                <img src="../data/images/rubics.jpg" alt="Picture" height="150" width="150">
            </td>
        </tr>

        
            <td>
                <br>
                <textarea name="comment" cols="30" placeholder="Enter your comment"></textarea>
            </td>
        </tr>

        <tr>
        <td>
            <button name="comment" value="submit">Comment</button>
        </td>
        </tr>

        </table>

        <table align="right" >

        <tr>
            <td colspan="3">
            <h3>Active Friends</h3>
            </td>
        </tr>

        <tr>
            <td>Kutub Uddin Faisal </td>
            <td><img src="../data/images/circle%20(1).png" alt="active" height="20" width="20"></td>
        </tr>
        <tr>
            <td>Mohammad Hanif </td>
            <td><img src="../data/images/circle.png" alt="active" height="20" width="20"></td>
        </tr>
        <tr>
            <td>Anik Chowdhury</td>
            <td><img src="../data/images/circle%20(1).png" alt="active" height="20" width="20"></td>
        </tr>


        </table>
		



        
        
    <body>
</html>












 
