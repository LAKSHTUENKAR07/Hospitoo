<?php
session_start();
if (isset($_POST['uploaded'])){

  // uploading checks
  if (empty($_FILES)) {
    $error = 'Error uploding file. Please check the file size.';
    header("Location: /hospital/template/addHospital.html?msg=$error");
    exit();
  }
  
  ini_set('max_file_uploads', 4);

  $file_count = count($_FILES['files']['name']);

  if ($file_count > 4) {
    $error = 'Maximum 4 files allowed';
    header("Location: /hospital/template/addHospital.html?msg=$error");
    exit();
  }

  $i = 5;
  global $fileUrlData;
  $fileUrlData = "";
  for ($i = 0; $i < $file_count; $i++) {
    if ($_FILES["files"]["error"][$i] !== UPLOAD_ERR_OK) {

      switch ($_FILES["files"]["error"][$i]) {
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

    // Reject uploaded file larger than 10MB
    if ($_FILES["files"]["size"][$i] > 10048576) {
      $error = 'File too large (max 10MB)';
      header("Location: /hospital/template/addHospital.html?msg=$error");
      exit();
    }

    // Use fileinfo to get the mime type
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($_FILES["files"]["tmp_name"][$i]);

    $mime_types = ['image/gif', 'image/png', 'image/jpeg', 'image/jpg', 'video/mp4', 'video/avi', 'video/mov'];

    if (!in_array($_FILES["files"]["type"][$i], $mime_types)) {
      $error = "Invalid file type";
      header("Location: /hospital/template/addHospital.html?msg=$error");
      exit();
    }

    // Replace any characters not \w- in the original filename
    $pathinfo = pathinfo($_FILES["files"]["name"][$i]);

    $base = $pathinfo["filename"];

    $base = preg_replace("/[^\w-]/", "_", $base);

    $filename = $base . "." . $pathinfo["extension"];

    $destination = "../uploads/" . $filename;

    // Add a numeric suffix if the file already exists
    $j = 1;

    while (file_exists($destination)) {

      $filename = $base . "($j)." . $pathinfo["extension"];
      $destination = "../uploads/" . $filename;

      $j++;
    }

    if (!move_uploaded_file($_FILES["files"]["tmp_name"][$i], $destination)) {

      $error = "Can't move uploaded file";
      header("Location: /hospital/template/addHospital.html?msg=$error");
      exit();
    }

    $fileUrlData = $filename.'|'.$fileUrlData;
    // $files = $filename;
    $files = $fileUrlData;
    $_SESSION['files'] = $files;
    header("Location: /hospital/template/addHospital.html?file=$files");
  }
  // for loop ends
  require 'database_con.php';

  if (!isset($fileUrlData)){
    $error = "not abel to get files";
    header("Location: /hospital/index.html?msg=$error");
    exit();
  }
  else{
    $sql = "UPDATE hospitalinfo SET fileLinks = ? WHERE hospName = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)){
      $error = "failed to update data";
      header("Location: /hospital/template/addHospital.html?msg=$error");
      exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "ss",$fileUrlData,$_SESSION['hospName']);
        mysqli_stmt_execute($stmt);
        $_SESSION['filedone'] = "done Uploading";
        header("Location: /hospital/template/addHospital.html");
        exit();
    }
    if ($stmt !== null){
      mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
  }
}
else{
  $error = "something went wrong!Try refreshing and entring data.";
  header("Location: /hospital/template/addHospital.html?msg=$error");
}