<?php
echo "<form method='post' action='".htmlspecialchars($_SERVER['PHP_SELF'])."'>
<table bgcolor=\"#2f4f4f\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" height= \"40px\" border='0' style='border-radius: 5px; color: white'>
<tr>
        <td width=\"5%\" align=\"right\"> </td>
        <td width=\"5%\" align=\"center\">
            <a href=\"../logic/logout_logic.php.php\"><img src = \"..\data\images\logo_color1.png\" height=\"25\" width=\"40\"></a>
        </td>
        <td width=\"30%\" colspan = \"2\"  align=\"right\">
        </td>

        <td width=\"5%\" align=\"left\" valign='middle'>
        </td>
        <td width=\"25%\" > </td>
        <td width=\"15%\" > </td>

        <td width=\"10%\" align=\"center\">
            <p><a href=\"../logic/logout_logic.php\"><font color=\"white\" size =\"4\">Login | Signup</font></a> 
            </p>
        </td>
        <td width=\"5%\" align=\"right\"> </td>
    </tr>
</table>
</form>";
?>