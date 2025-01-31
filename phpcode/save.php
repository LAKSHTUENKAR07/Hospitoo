<?php
// if (isset($_POST['register'])){
include('database_con.php');
// include('add.php');
session_start();
if (isset($_GET['patientSaved'])) {
    $username = $_SESSION['username'];
    $savedhospital = $_GET['hospName'];
    $Hcode = $_GET['Hcode'];

    $sql = "UPDATE patientinfo SET savedhospitals = ?,Hcode = ? WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $error = "failed to update data";
        header("Location: /hospital/index.html?msg=$error");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "sss", $savedhospital,$Hcode,$username);
        mysqli_stmt_execute($stmt);
        $_SESSION['reservations'] = $savedhospital;
        $_SESSION['Hcode'] = $Hcode;
        $success = "Registered succesfully!!";
        header("Location: /hospital/index.html?msg=$success");
        exit();
    }

if ($stmt !== null) {
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}
else{
    $error =  'please sign in to register';
    header("Location: /hospital/index.html?msg=$error");
    exit();
}
