<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user_management";
        
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    //check connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
        //echo "Connected successfully";

    ?>
