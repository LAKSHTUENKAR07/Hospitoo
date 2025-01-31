<?php
// session_start();
if (isset($_POST['helpline'])){

    $to = "hospito00f@gmail.com";
    $subject = "Email from client for HELP";
    
    // Collecting the data from the email
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $issue = $_POST['issue'];
    
    // Composing the email message
    $message = "Hello HOSPITO myself '$name':\n\nCan you fix this issue : \n$issue\n\nMY Details are : \n\nEmail ID ==> $email\ncontact No. ==> $phone\n\nHope to get response soon.";
    
    // Sending the email
    mail($to, $subject, $message);
    
    // Confirmation message
    $error = "Thank you $name. We will contact you soon.";
    header("Location: /hospital/index.html?msg=$error");
    exit();
}
else if($_SESSION['mailreport'] == "true"){

    $sql = "SELECT hospemailID FROM hospitalinfo WHERE Hcode=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        $error = "Something went wrong in updating";
        header("Location: /hospital/template/Pform.html?msg=$error");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $Hcode);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck > 0){
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $hospemailID = $row['hospemailID'];
        }
        else{
            $error = "Could not send your report to them";
            header("Location: /hospital/index.html?msg=$error");
            exit();
        }

    $to = $hospemailID;
    $subject = "Health report of".$_SESSION['fullname'];
    
    // Collecting the data from the email
    $name = $_SESSION['fullname'];
    $email = $_SESSION['emailID'];
    $phone = $_SESSION['contactno'];
    $Equestion = explode('|', $question);
    $Eanswer = explode('|', $entry);
    $tablehead = "
    <table>
      <tr>
        <th>Question</th>
        <th>Answer</th>
      </tr>";
    for($i = 0; $i < count($Equestion); $i++){
        $tabelbody = "<tr>
        <td>".$Equestion[$i]."</td>
        <td>".$Eanswer[$i]."</td>
      </tr>";
      $tablebody .= $tablebody;
      }
      $tableother = "<tr>
      <td>Patient reply</td>
      <td>".$others."</td>
    </tr></table>";

    $issue = $tablehead.$tabelbody.$tableother;
    // Composing the email message
    $message = "Below is the report of".$_SESSION['fullname']."kindly reply him/her ASAP.\n$issue";
    
    // Sending the email
    mail($to, $subject, $message);
    
    // Confirmation message
    $error = "Thank you $name. Your report is send to your registered hospital.They will soon contact you and update your fees if required.";
    header("Location: /hospital/index.html?msg=$error");
    exit();
}
}
else{
    $error = "something went wrong";
    header("Location: /hospital/index.html?msg=$error");
    exit();
}