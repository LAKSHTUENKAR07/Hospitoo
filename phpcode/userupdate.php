<?php

if (isset($_POST['update'])){

    require "database_con.php";
    session_start();
    $username = $_SESSION['username'];
    $usrdesc = $_POST['description'];
    $usraddress = $_POST['address'];
    
    $sql = "UPDATE userinfo SET addressofuser = ?,userdesc = ?  WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $error = "failed to update data";
        header("Location: /hospital/template/userProfile.php?msg=$error");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "sss", $usraddress,$usrdesc,$username);
        mysqli_stmt_execute($stmt);
        $_SESSION['address'] = $usraddress;
        $_SESSION['description'] = $usrdesc;
        $success = "Updated succesfully!!";
        header("Location: /hospital/template/userProfile.php?msg=$success");
        exit();
    }

if ($stmt !== null) {
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

else{
    $error = "something went wrong";
    header("Location: /hospital/template/userProfile.php?msg=$error");
    exit();
}