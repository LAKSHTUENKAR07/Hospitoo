<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] !=="POST"){
    $error = 'POST request required';
    header("Location: /hospital/template/addHospital.html?msg=$error");
    exit();
}
// uploading checks
  if (empty($_FILES)) {
    $error = 'Error uploding file. Please check the file size.';
    header("Location: /hospital/template/addHospital.html?msg=$error");
    exit();
  }

  if ($_FILES["pricefile"]["error"] !== UPLOAD_ERR_OK) {

    switch ($_FILES["pricefile"]["error"]) {
      case UPLOAD_ERR_PARTIAL:
        $error = 'File only partially uploaded';
        header("Location: /hospital/template/addHospital.html?msg=$error");
        exit();
        break;
      case UPLOAD_ERR_NO_FILE:
        $error = 'No file was uploaded';
        header("Location: /hospital/template/addHospital.html?msg=$error");
        exit();
        break;
      case UPLOAD_ERR_EXTENSION:
        $error = 'File upload stopped by a PHP extension';
        header("Location: /hospital/template/addHospital.html?msg=$error");
        exit();
        break;
      case UPLOAD_ERR_FORM_SIZE:
        $error = 'File exceeds MAX_FILE_SIZE in the HTML form';
        header("Location: /hospital/template/addHospital.html?msg=$error");
        exit();
        break;
      case UPLOAD_ERR_INI_SIZE:
        $error = 'File exceeds upload_max_filesize in php.ini';
        header("Location: /hospital/template/addHospital.html?msg=$error");
        exit();
        break;
      case UPLOAD_ERR_NO_TMP_DIR:
        $error = 'Temporary folder not found';
        header("Location: /hospital/template/addHospital.html?msg=$error");
        exit();
        break;
      case UPLOAD_ERR_CANT_WRITE:
        $error = 'Failed to write file';
        header("Location: /hospital/template/addHospital.html?msg=$error");
        exit();
        break;
      default:
        $error = 'Unknown upload error';
        header("Location: /hospital/template/addHospital.html?msg=$error");
        exit();
        break;
    }
  }

  // Reject uploaded file larger than 1MB
  if ($_FILES["pricefile"]["size"] > 1048576) {
    $error = 'File too large (max 1MB)';
    header("Location: /hospital/template/addHospital.html?msg=$error");
    exit();
  }

  // Use fileinfo to get the mime type
  $finfo = new finfo(FILEINFO_MIME_TYPE);
  $mime_type = $finfo->file($_FILES["pricefile"]["tmp_name"]);

  $mime_types = ['application/pdf'];

  if (!in_array($_FILES["pricefile"]["type"], $mime_types)) {
    $error = "Invalid file type";
    header("Location: /hospital/template/addHospital.html?msg=$error");
    exit();
  }

  // Replace any characters not \w- in the original filename
  $pathinfo = pathinfo($_FILES["pricefile"]["name"]);

  $base = $pathinfo["filename"];

  $base = preg_replace("/[^\w-]/", "_", $base);

  $filename = $base . "." . $pathinfo["extension"];

  $destination = "../pricing/" . $filename;

  // Add a numeric suffix if the file already exists
  $j = 1;

  while (file_exists($destination)) {

    $filename = $base . "($j)." . $pathinfo["extension"];
    $destination = "../pricing/" . $filename;

    $j++;
  }

  if (!move_uploaded_file($_FILES["pricefile"]["tmp_name"], $destination)) {

    $error = "Can't move uploaded file";
    header("Location: /hospital/template/addHospital.html?msg=$error");
    exit();
  }

  $pricefileUrlData = $filename;
  $files = $pricefileUrlData;
  $_SESSION['files'] = $files;
  header("Location: /hospital/template/addHospital.html?file=$files");


  // for loop ends
  require 'database_con.php';

  if (!isset($pricefileUrlData)){
    $error = "not abel to get files";
    header("Location: /hospital/index.html?msg=$error");
    exit();
  }
  else{
    $sql = "UPDATE hospitalinfo SET pricelist = ? WHERE hospName = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)){
      $error = "failed to update data";
      header("Location: /hospital/template/addHospital.html?msg=$error"."status="."success");
      exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "ss",$pricefileUrlData,$_SESSION['hospName']);
        mysqli_stmt_execute($stmt);
        $success = "updated new entry succesfully!!";
        // $success = $fileUrlData;
        header("Location: /hospital/index.html?msg=$success");
        exit();
    }
    if ($stmt !== null){
      mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
  }
