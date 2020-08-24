<?php
include_once "../data/user_data_access.php";
$admin=$user=false; //for recognizing user type admin or normal user
//checks user id format.
$loginUsernameErrMssge = $loginPasswordErrMssge = $errMsg = "";

function isUsername($value)
{
    if ((strlen($value) == 10 && $value[2] == '-' && $value[8] == '-')) {
        global $user;
        for ($i = 0; $i < 10; $i++) {
            if ($i != 2 && $i != 8) {
                if (ctype_digit($value[$i])) {
                    $user=true;
                    return true;
                }
            }
        }
    } else {
        return false;
    }
}
//checks admin id format.
function isAdmin($value)
{
    if ((strlen($value) == 10 && $value[4] == '-' && $value[8] == '-')) {
        global $admin;
        for ($i = 0; $i < 10; $i++) {
            if ($i != 5 && $i != 8) {
                if (ctype_digit($value[$i])) {
                    $admin=true;
                    return true;
                }
            }
        }
    } else {
        return false;
    }
}
function isName($value){

    $valid=false;
    if(($value[0]>="A" && $value[0]<="Z") || ($value[0]>="a" && $value[0]<="z")){
        for($i=0;$i<strlen($value); $i++ ){
            if(($value[$i]>="A" && $value[$i]<="Z") || ($value[$i]>="a" && $value[$i]<="z") || $value[$i]==' ' || $value[$i]=='.'){
                $valid=true;
            }
            else{
                $valid=false;
                break;
            }
        }
    }
    return $valid;
}
function isPassword($value){


    if(strlen($value) == "8"){
        $alpha=false;
        $num=false;
       for($i=0;$i<strlen($value);$i++){
            if(($value[$i]>="A" && $value[$i]<="Z") || ($value[$i]>="a" && $value[$i]<="z")){
                $alpha=true;
            }
            elseif ($value[$i]>='0' && $value[$i]<='9'){
                $num=true;
            }
        }
        if($alpha==true && $num==true){
            return true;
        }
        else{
            return false;
        }
    }
    else{
        return false;
    }
}
function insert_user($firstname,$lastname,$username,$email,$password,$birthday,$gender){
$user=array(
    'firstname'=>$firstname,
    'lastname'=>$lastname,
    'username'=>$username,
    'email'=>$email,
    'password'=>$password,
    'birthday'=>$birthday,
    'gender'=>$gender,
    'status'=>0

);
return insertUser($user);

}
function getUser($username,$password){
    $user=array(
        'username'=>$username,
        'password'=>$password

    );
    return get_User($user);
}
function getAdmin($username,$password){
    $admin=array(
        'username'=>$username,
        'password'=>$password

    );
    return get_admin($admin);
}


?>