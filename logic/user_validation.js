"use strict"



function userExists() {
    var para=document.getElementById('errMsg');
    var username=document.getElementById('reg_username');
    var un=username.value;
    if(un==""){
        alert("Username is empty!!");
        return false;
    }
    else if(un.length!=10){
        alert("Username format is xx-xxxxx-x");
        return false;
    }
    else if(un.length==10){
        var valid=false;
        for(let i=0;i<10;i++){
            if((un[2]=='-') || (un[8]=='-')){
                if(i<2 || (i>2 && i<8) ||i>8 ){
                    if(un[i]>=0 && un[i]<=9){
                        valid=true;
                    }
                    else {
                        valid=false;
                        break;

                    }
                }
            }
            else{
                valid=false;
                break;
            }
        }
        if(valid){
            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == '1') {
                        alert("Username is already taken. Try another one.");
                        return false;
                    } else {

                        return true;
                    }
                }
            };
            ajax.open("POST", "../logic/doesUserExists.php", true);
            ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajax.send("uname=" + username.value);
        }
        else{
            alert("Username format is xx-xxxxx-x");
            return false;
        }

    }

}


function validFirstName() {
    var para=document.getElementById('errMsg');
    var fn=document.getElementById('firstName');
    if(fn.value=="" ){
        alert("First name is empty");
        return false;
    }
    else if(!((fn.value[0]>="a" && fn.value[0]<="z") || (fn.value[0]>="A" && fn.value[0]<="Z") )  ){
        alert("Invalid name!!!");
        return false;
    }
    else
    {
        var valid=false;
        for (let i = 0; i < fn.value.length; i++) {
            if ((fn.value[i] >= "a" && fn.value[i] <= "z") || (fn.value[i] >= "A" && fn.value[i] <= "Z") || fn.value[i] == '.' || fn.value[i] == ' ') {

                valid = true;
            } else {

                valid = false;
                break;
            }
        }
            if(valid){
                return  true;
            }
            else {
                alert("Invalid name!!!");
                return  false;
            }

    }

}
function validLastName() {
    var para=document.getElementById('errMsg');
    var fn=document.getElementById('lastName');
    if(fn.value=="" ){
        alert("Last name is empty");
        return false;
    }
    else if(!((fn.value[0]>="a" && fn.value[0]<="z") || (fn.value[0]>="A" && fn.value[0]<="Z") )  ){
        alert("Invalid name!!!");
        return false;
    }
    else
    {
        var valid=false;
        for (let i = 0; i < fn.value.length; i++) {
            if ((fn.value[i] >= "a" && fn.value[i] <= "z") || (fn.value[i] >= "A" && fn.value[i] <= "Z") || fn.value[i] == '.' || fn.value[i] == ' ') {

                valid= true;
            }
            else{

                valid= false;
                break;
            }
        }

            if(valid){

                return  true;
            }
            else {
                alert("Invalid name!!!");
                return  false;
            }

    }

}
function emptyField() {
    var para=document.getElementById('errMsg');
    var date=document.getElementById('date');
    var email=document.getElementById('email');
    var male=document.getElementById('male');
    var female=document.getElementById('female');
    var agree=document.getElementById('agree');
    var disagree=document.getElementById('disagree');
    if(date.value=="" || email.value==""){
        alert("All required fields should fill up.");
        return false;
    }
    else if(disagree.checked==true){
       alert("You are not welcome till you disagree with our terms and conditions!!!");
        return false;
    }
    else {
        return true;

    }

}
function isPassword() {
    var para=document.getElementById('errMsg');
    var pass=document.getElementById('password');
    if(pass.value.length>=8){
        var alpha=false;
        var num=false;
        for(let i=0;i<pass.value.length;i++){
            if((pass.value[i]>="a" && pass.value[i]<="z") || (pass.value[i]>="A" && pass.value[i]<="Z")  ){
                alpha=true;
            }
            else if(pass.value[i]>="0" && pass.value[i]<="9"){
                num=true;
            }



        }
        if(num && alpha){

            return true;
        }
        else {
            alert("Password should be at least 8 characters long and should contain an alphabet and a digit");
            return false;
        }

    }
    else{
        alert("Password should be at least 8 characters long and should contain an alphabet and a digit");
        return false;
    }

}
function confirm() {
    var para=document.getElementById('errMsg');
    var pass=document.getElementById('password');
    var c_pass=document.getElementById('confirmPass');
    if(pass.value==c_pass.value){

        return true;
    }
    else{
        alert("Password doesn't match.");
        return false;
    }
}
function validateReg() {
    if(!userExists() || !validFirstName() || !validLastName() || !emptyField() || !isPassword() || !confirm()){
        return false;
    }
    return true;
}