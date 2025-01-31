<?php
if (isset($_POST['hospitalDetails'])){
    require 'database_con.php';
    session_start();
    // hospital details
    $hospitalName = $_POST['hospitalName'];
    $stablishyr = $_POST['stablishyr'];
    $state = $_POST['state']; 
    $city=$_POST['city'];
    $hospaddress = $_POST['address'].', '.$city.', '.$state;
    $hospmail = $_POST['hospmail'];
    $hosptype = $_POST['hosptype'];
    $hospcontact = $_POST['hospcontact1'].'|'.$_POST['hospcontact2'];

    // adder datails
    $addercontact = $_SESSION['contactno']; 
    $addermail = $_SESSION['emailID'];
    $AdderName = $_SESSION['fullname'];
    $hospPASS = $_POST['hospPASS'];
    $Hcode = $_SESSION['Hcode'];

    if(strlen(strlen($addercontact)<=10)){
        $error = "Enter mobile number with country code";
        header("Location: /thinkTank/template/addHospital.html?msg=$error");
        exit();
    }
    else if(strlen($hospaddress)<5){
        $error = "enter valid address";
        header("Location: /hospital/template/addHospital.html?msg=$error");
        exit();
    }
    else if (strlen($hospitalName)<2){
        $error = "enter valid Hospital Name";
        header("Location: /hospital/template/addHospital.html?msg=$error");
        exit();
    }else if (!password_verify($hospPASS, $_SESSION['hospPASS'])){
        $error = "Incorrect password";
        header("Location: /hospital/template/addHospital.html?msg=$error");
        exit();
    }
    else{
        $sql = "SELECT hospName,hospaddress FROM hospitalinfo WHERE hospName=? && hospaddress=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)){
            $error = 'could not connect to database';
            header("Location: /hospital/template/addHospital.html?msg=$error");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $hospitalName,$hospaddress);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck>0){
                $error = "This hospital is already avaiable on website";
                header("Location: /hospital/template/addHospital.html?msg=$error");
            }
            else{
                $sql = "INSERT INTO hospitalinfo (hospName,stabYR,hospaddress,hospemailID,hosptype,hospNO,adderName,adderemailID,adderNO,hospPASS,Hcode) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt,$sql)){
                    $error = "failed to update data";
                    header("Location: /hospital/template/addHospital.html?msg=$error");
                    exit();
                }
                else{
                    $pwdhash = password_hash($hospPASS, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssssssssss",$hospitalName,$stablishyr,$hospaddress,$hospmail,$hosptype,$hospcontact,$AdderName,$addermail,$addercontact,$pwdhash,$Hcode);
                    mysqli_stmt_execute($stmt);
                    $success = "success";
                    session_start();
                    $_SESSION['status'] = "success";
                    // hospital data in session
                    $_SESSION['hospName'] = $hospitalName;
                    $_SESSION['hospaddress'] = $hospaddress;
                    $_SESSION['stablishyr'] = $stablishyr;
                    $_SESSION['hospmail'] = $hospmail;
                    $_SESSION['hospmail'] = $hospmail;
                    $_SESSION['hospcontact'] = $hospcontact;
                    $_SESSION['hosptype'] = $hosptype;

                    header("Location: /hospital/template/addHospital.html?status=$success");
                    exit();
                }
            }
        }
    }
    if ($stmt !== null){
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
else{
    $error = "visit website home page to add details";
    header("Location: /hospital/template/addHospital.html?msg=$error");    
}