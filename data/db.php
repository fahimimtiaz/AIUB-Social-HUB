<?php
$servername="localhost";
$uname="root";
$pword="";
$dbname="aiub_social_hub";

function execute_query($query){
    global $servername,$uname,$pword,$dbname;
    $connection=mysqli_connect($servername,$uname,$pword,$dbname);
    if($connection){
        $result=mysqli_query($connection,$query);
        mysqli_close($connection);
        return $result;
    }

}

?>