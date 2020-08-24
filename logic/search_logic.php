<?php
include_once "../data/user_data_access.php";
function search($searchValue){
    if(empty($searchValue)){

    }
    else {
        $res=search_user($searchValue);
        if(count($res)>0 ){
        $_SESSION['searchRes']=$res;
        header("Location:searchResult.php?search=$searchValue&res=$res");
        }
        else{
            header("Location:searchNotFound.php?search=$searchValue");

        }
    }
}


?>
