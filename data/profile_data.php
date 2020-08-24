<?php
    session_start();
    include_once "../data/db.php";
    $user_name=$_SESSION['user']['username'];
    //$query="select * from profile where username='$info[username]' ";
    $query="select * from profile where username='$user_name' ";
    $result= execute_query($query);
    $username=$department=$place=$hometown=$propic=$coverpic=$fullname=$birthdate=$email=$password="";
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            
            $username = $row['username'];
            $department = $row['department']; 
            $place = $row['place'];
            $hometown = $row['hometown']; 
            $propic = $row['pro_pic']; 
            $coverpic = $row['cover_pic']; 

            
            
        }
    }

    $query="select * from users where username='$user_name' ";
    $res= execute_query($query);

    if(mysqli_num_rows($res)>0){
        while($row=mysqli_fetch_assoc($res)){
            
            $fullname =  $row['firstname']." ".$row['lastname'];
            $birthdate = $row['birthday'];
            $email = $row['email'];
            $password = $row['password'];

            
            
        }
    }

    


?>