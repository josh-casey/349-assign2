<?php
    $db_host = 'assigndb.ctc0cmvle9g8.us-east-1.rds.amazonaws.com';
    $db_name = 'shop';
    $db_user = 'admin';
    $db_password = 'jKDzwTO2YNdfcFvhFRho';
    $db = new mysqli($db_host, $db_user, $db_password, $db_name);

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>