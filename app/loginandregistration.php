<?php
session_start();
include_once "../logic/login_registration_logic.php";
include_once "../logic/user_logic.php";


    $_SESSION['userloggedIn'] = false;
    $_SESSION['adminloggedIn'] = false;
    $_SESSION['friendId']="";
    setcookie("loggedIn","none");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (isset($_POST['login'])) {
            $loginUsername = $_POST['loginUsername'];
            $loginPassword = $_POST['loginPassword'];
            if (empty($loginUsername)) {
                $loginUsernameErrMssge = "Username can not be empty !!!!";
            } else if (empty($loginPassword)) {
                $loginPasswordErrMssge = "Password can not be empty !!!!";
            } else {
                if (!isUsername($loginUsername) && !isAdmin($loginUsername)) {
                    $loginUsernameErrMssge = "Invalid Username format!!!";
                } else {
                    if ($user == true) {
                        //header("Location:home.php?username=$loginUsername");
                        $result = getUser($loginUsername, $loginPassword);

                        if (mysqli_num_rows($result) == 1) {
                            $_SESSION['userloggedIn'] = true;
                            $_SESSION['user'] = mysqli_fetch_assoc($result);
                            $status=$_SESSION['user']['ban_status'];
                            if($status==0){
                            change_status($_SESSION['user']['username'], 1);
                            header("Location:home.php?username=$loginUsername");
                            }
                            else{
                                header("Location:banned.php");
                            }
                        } else {
                            $loginUsernameErrMssge = "Invalid Credentials!!!";
                        }
                    } elseif ($admin == true) {
                        //header("Location:admin.php?username=$loginUsername");
                        $result = getAdmin($loginUsername, $loginPassword);
                        if (mysqli_num_rows($result) == 1) {
                            $_SESSION['adminloggedIn'] = true;
                            $_SESSION['user'] = mysqli_fetch_assoc($result);
                            header("Location:admin.php?username=$loginUsername");
                        } else {
                            $loginUsernameErrMssge = "Invalid Credentials!!!";
                        }
                    }
                }
            }
        }

        if (isset($_POST['submit'])) {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPass = $_POST['confirmPass'];
            $birthday = $_POST['dateOfBirth'];
            $gender = $terms = "";
            if (empty($firstName)) {
                $errMsg = "First Name cannot be empty!!!";
            } elseif (empty($lastName)) {
                $errMsg = "Last Name cannot be empty!!!";
            } elseif (empty($username)) {
                $errMsg = "Username cannot be empty!!!";
            } elseif (empty($email)) {
                $errMsg = "Email cannot be empty!!!";
            } elseif (empty($password)) {
                $errMsg = "Password cannot be empty!!!";
            } elseif ($confirmPass != $password) {
                $errMsg = "Password doesn't match!!!";
            } elseif (empty($birthday)) {
                $errMsg = "Birthday is not selected!!!";
            } elseif (isset($_POST['gender']) == false) {
                $errMsg = "Gender is not selected!!!";
            } elseif (isset($_POST['terms']) == false) {
                $errMsg = "Do you agree or disagree with the terms and conditions!!!";
            } elseif ($_POST['terms'] == "disagree") {
                $errMsg = "You have to agree with the terms and conditions to create an account!!!";
            } else {
                if (!isName($firstName)) {
                    $errMsg = "Invalid Name!!!";
                } elseif (!isName($lastName)) {
                    $errMsg = "Invalid Name!!!";
                } elseif (!isUsername($username)) {
                    $errMsg = "Invalid username format. Username format is 'XX-XXXXX-X'!!!";
                } elseif (!isPassword($password)) {
                    $errMsg = "Password should be 8 characters long and should have at least 1 alphabet and 1 digit.";
                } else {
                    $gender = $_POST['gender'];
                    //header("Location:home.php?username=$loginUsername");
                    try {
                        insert_user($firstName, $lastName, $username, $email, $password, $birthday, $gender);
                        $errMsg = "Registration successful!!! Please login to continue.";
                    } catch (Exception $e) {
                        $errMsg = $e->getMessage();
                    }
                }


            }

        }
    }
?>




<html>
    <head>
        <title>AIUB Social Hub|login or sign up</title>
        <link rel="stylesheet" type="text/css" href="../logic/style.css">
        <script src="../logic/user_validation.js"></script>
    </head>
    <body>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="header-control" >
                <table class="table-control" bgcolor="#2f4f4f" width="100%" height="70px" border="0" >
                    <tr>
                        <td width="10%" align="right" valign="center" rowspan="2">
                            <img src="../data/images/logo_notext_white.png" height="34.2px" whidht="108.2px">
                        </td>
                        <td width="35%" align="left" valign="center" rowspan="2">
                            <img src="../data/images/logo.png" width="100%">
                        </td>
                        <td width="15%" rowspan="2">

                        </td>
                        <td width="16%" align="left" valign="bottom">
                            <p><b><font color="white"> Username: </font></b><br><input class="textBox" type="text" name="loginUsername"></p>
                        </td>
                        <td width="16%" align="left" valign="bottom">
                            <p><b><font color="white"> Password: </font></b><br><input class="textBox" type="password" name="loginPassword"></p>
                        </td>
                        <td width="8%" align="left" valign="bottom">
                           <input class="loginBtn" type="submit" name="login" value="Login" >
                        </td>
                    </tr>
                    <tr>
                        <td height="32%">
                            <label name="usernameErrMssge"><font color="#f8f8ff"><?= $loginUsernameErrMssge; ?></font></label>
                        </td>
                        <td>
                            <label name="usernameErrMssge"><font color="#f8f8ff"><?= $loginPasswordErrMssge; ?></font></label>
                        </td>
                        <td>

                        </td>
                    </tr>
                </table>
            </div>
        </form>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="validateReg()" >
            <br/>
            <table width="100%" align="center" border="0">
                <tr>
                    <td width="65%" rowspan="2" align=" center">
                       <h2>AIUB Social Hub helps you to <br>connect with all AIUBians</h2>
                    </td>
                    <td colspan="2">
                        <p><font size="6" ><b>Create an account</b></font>
                        <br><font size="5">It's only for AIUBians</font></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" height="40px">
                        <label name="ErrMssge" ><font color="red"><p id="errMsg" style="word-wrap: break-word"><?= $errMsg; ?></p></font></label>
                    </td>
                </tr>
                <tr>
                    <td  rowspan="7" align="center" valign="center">
                        <img src="../data/images/social_hub_img.png" width="50%" >
                    </td>
                    <td>
                        <p class="input-name-control"><font class="star" color="red">*</font>First Name: <br><input class="textBox" type="text" name="firstName" id="firstName" onchange="validFirstName()"></p>
                    </td>
                    <td>
                        <p class="input-name-control"><font class="star" color="red">*</font>Last Name: <br><input class="textBox" type="text" name="lastName" id="lastName" onchange="validLastName()"></p>
                    </td>
                </tr>
                <tr>
                    <td >
                        <p class="input-name-control"><font class="star" color="red">*</font>Username: <br><input class="textBox" type="text" id="reg_username" name="username" onchange="userExists()"></p>
                    </td>
                    <td >
                        <p class="input-name-control"><font class="star" color="red">*</font>Birthday: <br><input class="textBox" type="date" id="date" name="dateOfBirth"></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p class="input-name-control"><font class="star" color="red">*</font>Email: <br><input class="textBoxLong" type="email" id="email" name="email"></p>
                    </td>
                </tr>
                <tr>

                    <td>
                        <p class="input-name-control"><font class="star" color="red">*</font>Password: <br><input class="textBox" type="password" id="password" name="password" onchange="isPassword()"></p>
                    </td>
                    <td>
                        <p class="input-name-control"><font class="star" color="red">*</font>Confirm Password: <br><input class="textBox" type="password" id="confirmPass" name="confirmPass" onchange="confirm()"></p>
                    </td>
                </tr>

                <tr>
                    <td >
                        <p class="input-name-control"><font class="star" color="red">*</font>Gender: <input class="radioBtn" type="radio" id="male" name="gender" value="male" checked> Male
                            <input class="radioBtn" type="radio" id="female" name="gender" value="female"> Female </p>
                    </td>
                    <td>
                        <p class="input-name-control">'*' marked fields are required.</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <fieldset class="field-control">
                            <legend ><font color="red">*</font>Terms & Conditions</legend>
                            <p class="input-name-control">You cannot share any inappropriate post.<br>
                                You cannot Harass other users.<br>
                                Admin keeps the rights to access your profile.<br>
                                Admin keeps the rights to ban your profile.
                                <br><input type="radio" name="terms" id="agree" value="agree" checked> I Agree
                                <input type="radio" name="terms" id="disagree" value="disagree" onclick="emptyField()"> I Disagree
                            </p>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan=" 2">
                        <input class="submitBtn" type="submit" name="submit" value="Submit">
                    </td>
                </tr>

            </table>
        </form>
    </body>
</html>