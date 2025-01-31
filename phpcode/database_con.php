<?php

$host = "localhost";  // hostname or IP address of the database server
$username = "root";  // database username
$password = "";  // database password
$dbname = "hospitodata";  // name of the database

// create a new connection to the database
$conn = mysqli_connect($host, $username, $password, $dbname);

// check if the connection was successful
if (!$conn) {
    die("Connection failed: " .mysqli_connect_error());
}
$success = "ok";
$success;
?>