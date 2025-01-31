<?php 

require 'database_con.php';

if ($_POST['relation'] == "patient"){
    $relation = $_POST['relation'];
    $username = $_POST['username'];
    $email = $_POST['EmailId'];
    $pwd = $_POST['password'];
    $repwd = $_POST['repassword'];
    $fullname = $_POST['fullName'];
    $contactno = $_POST['contactno'];
    $gender = $_POST['gender'] ;
    $Pcode = $_POST['Pcode'];
    $age = $_POST['age'];
}
else if ($_POST['relation'] == "admin"){
    $relation = $_POST['relation'];
    $email = $_POST['EmailId'];
    $pwd = $_POST['password'];
    $repwd = $_POST['repassword'];
    $fullname = $_POST['fullName'];
    $contactno = $_POST['contactno'];
    $Hcode = $_POST['Hcode'];

    $sql = "SELECT Hcode FROM hospitalinfo WHERE Hcode=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $error = "Error occured at database";
        header("Location: /hospital/index.html?msg=$error");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $Hcode);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($resultCheck > 0){
            $error = "Sorry this unique code is already used. Try creating another one.";
            header("Location: /hospital/template/signup.html?msg=$error");
            exit();
        }
    }
}
else{
    $error = "Something went wrong";
    header("Location: /hospital/template/signup.html?msg=$error");
    exit();
}

if ((!preg_match("/^[a-zA-Z0-9]*$/", $username)) && (!filter_var($email, FILTER_VALIDATE_EMAIL))){
    $error = "Email and username not correct";
    header("Location: /hospital/template/signup.html?msg=$error");
}
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error = "invalid email";
    header("Location: /hospital/template/signup.html?msg=$error");
}
else if(strlen($contactno)<=10){
    $error = "Enter mobile number with country code";
    header("Location: /hospital/template/signup.html?msg=$error");
}
else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)){
    $error = 'special symbols and period(.) not allowed';
    header("Location: /hospital/template/signup.html?msg=$error");
}
else if ($age > 150){
    $error = "invalid Age";
    header("Location: /hospital/template/signup.html?msg=$error");
}
else if ($pwd !== $repwd){
    $error = "password did not match";
    header("Location: /hospital/template/signup.html?msg=$error");
}
else{
    if ($relation == 'patient'){
        $sql = "SELECT username,emailID FROM patientinfo WHERE username=? OR emailID=?";
        $stmt = mysqli_stmt_init($conn);
    }
    else{
        $sql = "SELECT fullname,emailID FROM admininfo WHERE fullname=? AND emailID=?";
        $stmt = mysqli_stmt_init($conn);
    }
    if (!mysqli_stmt_prepare($stmt,$sql)){
        $error = 'could not connect to database';
        header("Location: /hospital/template/signup.html?msg=$error");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "ss", $username,$email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck>0){
            $error = "username or email already taken";
            header("Location: /hospital/template/signup.html?msg=$error");
        }
        else{
            if ($relation == 'patient'){
                $sql = "INSERT INTO patientinfo (username,emailID,pwd,contactno,gender,fullname,Pcode,age) VALUES (?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt,$sql)){
                    $error = "failed to update data";
                    header("Location: /hospital/template/signup.html?msg=$error");
                    exit();
                }
                else{
                    $pwdhash = password_hash($pwd, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ssssssss", $username, $email, $pwdhash,$contactno,$gender,$fullname,$Pcode,$age);
                    mysqli_stmt_execute($stmt);
                    session_start();
                    header("Location: /hospital/template/login.html");
                    exit();
                }
            }
            else{
                $sql = "INSERT INTO admininfo (emailID,pwd,contactno,fullname,Hcode) VALUES (?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt,$sql)){
                    $error = "failed to update data";
                    header("Location: /hospital/template/signup.html?msg=$error");
                    exit();
                }
                else{
                    $pwdhash = password_hash($pwd, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssss",$email, $pwdhash,$contactno,$fullname,$Hcode);
                    mysqli_stmt_execute($stmt);
                    session_start();
                    header("Location: /hospital/template/login.html");
                    exit();
                }
            }
        }
    }
}
if ($stmt !== null){
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);