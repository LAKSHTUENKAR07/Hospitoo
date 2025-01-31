<?php
require "database_con.php";
ob_start();
session_start();

if ($_POST['relation'] == 'patient'){
    $relation = $_POST['relation'];
    $email = $_POST['EmailID'];
    $password = $_POST['password'];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "SELECT * FROM patientinfo WHERE emailID=?";
    $_SESSION['user'] = $relation;
}
else if ($_POST['relation'] == 'admin'){
    $relation = $_POST['relation'];
    $email = $_POST['EmailID'];
    $password = $_POST['password'];
    $Hcode = $_POST['Hcode'];
    $sql = "SELECT * FROM admininfo WHERE emailID=?";
    $_SESSION['user'] = $relation;
}
else if($_POST['relation'] == 'family'){
    $relation = $_POST['relation'];
    $email = $_POST['EmailID'];
    $Pcode = $_POST['Pcode'];
    $sql = "SELECT * FROM patientinfo WHERE emailID=?";
    $_SESSION['user'] = $relation;
}
else{
    $error = "No user found";
    header("Location: /hospital/template/login.html?msg=$error");
    exit();
}

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$sql)){
    $error = "Error occured at database";
    header("Location: /hospital/template/login.html?msg=$error");
    exit();
}
else{
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $pwdcheck = password_verify($password, $row['pwd']);
        if ($relation !== 'family' && $pwdcheck == false){
            $error = "Incorrect password";
            header("Location: /hospital/template/login.html?msg=$error");
            exit();
        }
        else if ($relation == 'family' && $Pcode == false){
            $error = "Unique Code is incorrect";
            header("Location: /hospital/template/login.html?msg=$error");
            exit();
        }
        else if ($relation == 'admin' && $Hcode == false){
            $error = "Unique Code is incorrect";
            header("Location: /hospital/template/login.html?msg=$error");
            exit();
        }
        else if ($pwdcheck == true || $Pcode == $row['Pcode'] || $Hcode == $row['Hcode']){
            if ($relation == 'patient' || $relation == 'family'){
                $_SESSION['userID'] = $row['userID'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['emailID'] = $row['emailID'];
                $_SESSION['contactno'] = $row['contactno'];
                $_SESSION['gender'] = $row['gender'];
                $_SESSION['Areport'] = $row['Areport'];
                $_SESSION['report'] = $row['report'];
                $_SESSION['savedhospitals'] = $row['savedhospitals'];
                $_SESSION['fees'] = $row['fees'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['Pcode'] = $row['Pcode'];
                $_SESSION['age'] = $row['age'];
            }
            else if ($relation == "admin"){
                // $_SESSION['hospID'] = $row['hospID'];
                // $_SESSION['hospName'] = $row['hospName'];
                // $_SESSION['stabYR'] = $row['stabYR'];
                // $_SESSION['hospaddress'] = $row['hospaddress'];
                // $_SESSION['hospemailID'] = $row['hospemailID'];
                // $_SESSION['hosptype'] = $row['hosptype'];
                // $_SESSION['adderName'] = $row['adderName'];
                // $_SESSION['aderemailID'] = $row['aderemailID'];
                // $_SESSION['adderNO'] = $row['adderNO'];
                // $_SESSION['fileLinks'] = $row['fileLinks'];
                // $_SESSION['pricelist'] = $row['pricelist'];
                $_SESSION['adminID'] = $row['adminID'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['contactno'] = $row['contactno'];
                $_SESSION['pwd'] = $row['pwd'];
                $_SESSION['emailID'] = $row['emailID'];
                $_SESSION['Hcode'] = $row['Hcode'];
                $_SESSION['hospPASS'] = $row['pwd'];
            }
            else{
                $error = "no user";
                header("Location: /hospital/template/login.html?msg=$error");
                exit();
            }

            $error = 'Welcome '.$_SESSION["fullname"].' We are glad to help you';
            header("Location: /hospital/index.html?msg=$error");
            exit();
        }
        else {
            $error= "email and password do not match";
            header("Location: /hospital/template/login.html?msg=$error");
            exit();
        }
    }
    else {
        $error = "Please sign Up";
        header("Location: /hospital/template/login.html?msg=$error");
        exit();
    }
}