<?php
echo "<form method='post' action='".htmlspecialchars($_SERVER['PHP_SELF'])."'>
<table bgcolor=\"#2f4f4f\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" height= \"40px\" border='0' style='border-radius: 5px; color: white'>
<tr>
        <td width=\"5%\" align=\"right\"> </td>
        <td width=\"5%\" align=\"center\">
            <a href=\"home.php\"><img src = \"..\data\images\logo_color1.png\" height=\"25\" width=\"40\"></a>
        </td>
        <td width=\"30%\" colspan = \"2\"  align=\"right\">
            <input type=\"search\" name=\"searchText\" size=\"60\">
        </td>

        <td width=\"5%\" align=\"left\" valign='middle'>
            <input type='submit' name='searchBtn' value='Search'>
        </td>
        <td width=\"25%\" > </td>

        <td width=\"25%\" align=\"center\">
            <p><a href=\"profile.php\"><font color=\"white\" size =\"4\">Profile</font></a> | 
            <a href=\"home.php\"><font color=\"white\" size =\"4\">Home</font></a> | 
            <a href=\"notification.php\"><font color=\"white\" size =\"4\">Warnings</font></a> | 
            <a href=\"setting_general.php\"><font color=\"white\" size =\"4\">Setting</font></a> | 
            <a href=\"../logic/logout_logic.php\"><font color=\"white\" size =\"4\">Log Out</font></a></p>
        </td>
        <td width=\"5%\" align=\"right\"> </td>
    </tr>
</table>
</form>";


?>

