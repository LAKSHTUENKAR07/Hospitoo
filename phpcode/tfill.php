<?php
    session_start();
    // Get the number of input fields to create from the form submission
    $num_fields = $_POST['num_fields'];
    $category = $_POST['age'];
    $HcodeA = $_POST['Hcode'];
    $_SESSION['catselected'] = $category;
    
    // Connect to the MySQL database
    // $host = 'localhost';
    // $user = 'username';
    // $password = 'password';
    // $database = 'database';
    // $conn = mysqli_connect($host, $user, $password, $database);
    
    include 'database_con.php';
    
    // Create a table to store the data
    
    // Create the input fields dynamically
    if ($HcodeA !== $_SESSION['Hcode']){
        $error = "Unique code did not match";
        header("Location: /hospital/template/formCreate.html?msg=$error");
        exit();
    }
    else{
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../styles/formmake.css">
            <title>health Form making</title>
        </head>
        <body>
        <h2>Add questions for patient</h2>';
        echo '<form action="./submit.php" method="POST" id="Qbank">';
        for ($i=1; $i <= $num_fields; $i++){
            echo "<label for='field_$i'>Question $i:</label>";
            echo "<input type='text' id='field_$i' name='fields[]'>";
        }
        echo '<button type="submit">ADD</button>';
        echo '</form>';
        echo '
        </body>
        </html>';
    }
    
    // Close the MySQL database connection
    mysqli_close($conn);
    
    ?>
