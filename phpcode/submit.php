<?php
session_start();
// Get the data from the form submission
$fields = $_POST['fields'];

// Connect to the MySQL database
include 'database_con.php';

$age = $_SESSION['catselected'];
$Hcode = $_SESSION['Hcode'];
// Insert the data into the database
foreach ($fields as $field) {
	$sql = "INSERT INTO healthf (age,question,Hcode) VALUES ('$age','$field','$Hcode')";
	mysqli_query($conn, $sql);
}

// Close the MySQL database connection
mysqli_close($conn);

// Redirect to the index page
$error = "added successfully";
header("Location: /hospital/index.html?msg=$error");
exit();
?>
