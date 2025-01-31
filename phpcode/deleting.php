<?php
// session_start();
if (isset($_POST['Pdelete'])) {
    require 'database_con.php';

    $pwd = $_POST['pwd'];
    $sql = "SELECT pwd FROM patientinfo WHERE fullname=? AND emailID=? AND Pcode=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $error = "Error occured at database";
        header("Location: /hospital/template/profile.html?msg=$error");
        exit();
    } 
    else {
        mysqli_stmt_bind_param($stmt, "sss", $_POST['fullname'], $_POST['emailID'], $_POST['Pcode']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $pwdcheck = password_verify($pwd, $row['pwd']);
            if ($pwdcheck == false) {
                $error = "Incorrect password";
                header("Location: /hospital/template/profile.html?msg=$error");
                exit();
            } else {
                $sql = "DELETE FROM patientinfo WHERE fullname=? AND emailID=? AND Pcode=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    $error = "Error occured at database1";
                    header("Location: /hospital/template/profile.html?msg=$error");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "sss", $_POST['fullname'], $_POST['emailID'], $_POST['Pcode']);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $resultCheck = mysqli_stmt_num_rows($stmt);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    session_unset();
                    session_destroy();
                    $error = htmlentities('Patient Account DELETED successfully!. See you back soon :)');
                    header("Location: /hospital/index.html?msg=$error");
                    exit();
                }  
            }
        }
        else{
        $error = "Something went wrong. Contact website manager";
        header("Location: /hospital/template/profile.html?msg=$error");
        exit();
        }
    }

} 
else if (isset($_POST['Adelete'])) {
    require 'database_con.php';
    $pwd = $_POST['hospPASS'];
    $sql = "SELECT hospPASS FROM hospitalinfo WHERE hospName=? AND hospemailID=? AND Hcode=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $error = "Error occured at database";
        header("Location: /hospital/template/profile.html?msg=$error");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "sss", $_POST['hospName'], $_POST['hospemailID'], $_SESSION['Hcode']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $pwdcheck = password_verify($pwd, $row['hospPASS']);
            if ($pwdcheck == false) {
                $error = "Incorrect password";
                header("Location: /hospital/template/profile.html?msg=$error");
                exit();
            } else {
                $sql = "DELETE FROM hospitalinfo WHERE hospName=? AND hospemailID=? AND Hcode=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    $error = "Error occured at database1";
                    header("Location: /hospital/template/profile.html?msg=$error");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "sss", $_POST['hospName'], $_POST['hospemailID'], $_POST['Hcode']);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $resultCheck = mysqli_stmt_num_rows($stmt);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                }
                $sql = "DELETE FROM admininfo WHERE Hcode=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    $error = "Error occured at database1";
                    header("Location: /hospital/template/profile.html?msg=$error");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $_POST['Hcode']);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $resultCheck = mysqli_stmt_num_rows($stmt);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                }
                // session_unset();
                session_destroy();
                $error = htmlentities('Admin Account DELETED successfully!. See you back soon :)');
                header("Location: /hospital/index.html?msg=$error");
                exit();
            }
        }
        else{
            $error = "Something went wrong. Contact website manager";
            header("Location: /hospital/template/profile.html?msg=$error");
            exit();
        }
    }
}
else if (isset($_POST['delThis'])){
    require 'database_con.php';
    $sql = "DELETE FROM hospitalinfo WHERE hospName=? AND Hcode=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $error = "Error occured at database1";
        header("Location: /hospital/template/profile.html?msg=$error");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $_POST['hospName'],$_POST['Hcode']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $error = 'DELETED'.$_POST["hospName"].'successfully!. See you back soon :)';
        header("Location: /hospital/index.html?msg=$error");
    }
}