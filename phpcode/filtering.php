<?php
require 'database_con.php';
session_start();

if (isset($_SESSION['user']) && ($_SESSION['user'] == 'family')){
    $sql = "SELECT * FROM hospitalinfo WHERE hospName =?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $error = "Error occured at database";
        header("Location: /hospital/index.html?msg=$error");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['savedhospitals']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
}
else if (isset($_SESSION['user']) && $_SESSION['user'] == 'admin'){
    $sql = "SELECT * FROM hospitalinfo WHERE Hcode =?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $error = "Error occured at database";
        header("Location: /hospital/index.html?msg=$error");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['Hcode']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
}
else if (isset($_POST['filterAll'])){
    $sql = "SELECT * FROM hospitalinfo";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $error = "Error occured at database";
        header("Location: /hospital/index.html?msg=$error");
        exit();
    } else {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
}
else if (isset($_POST['filterAs'])){
    $filterAsValue = $_POST['filterAs'];
    $sql = "SELECT * FROM hospitalinfo WHERE hosptype=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $error = "Error occured at database";
        header("Location: /hospital/index.html?msg=$error");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $filterAsValue);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
} 
else {
    $sql = "SELECT * FROM hospitalinfo";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $error = "Error occured at database";
        header("Location: /hospital/index.html?msg=$error");
        exit();
    } else {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
}


