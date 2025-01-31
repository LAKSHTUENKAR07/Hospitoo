<?php 
session_start();
include 'database_con.php';
    if (isset($_POST['reported'])){
        $Hcode = $_POST['Hcode'];
        $Pcode = $_POST['Pcode'];
        $others = $_POST['others'];
        $entry = $_POST['answer0'];
        $question = $_POST['questions'];
        $name = $_SESSION['fullname'];
        $resultCheck = $_POST['resultCheck'];
        for ($j = 1; $j <= $resultCheck; $j++){
            $answer = 'answer'.$j-1;
            $entry .= '|'.$_POST[$answer];
        }
        $entry = $entry.'|'.$others;
        $sql = "UPDATE patientinfo SET report = ? WHERE Pcode = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            $error = "failed to update data";
            header("Location: /hospital/index.html?msg=$error");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $entry,$Pcode);
            mysqli_stmt_execute($stmt);
            $_SESSION['report'] = $entry;
            $_SESSION['mailreport'] = 'true';
            include '../phpcode/emailHandel.php';
        }
    }
    ?>