<?php
        $db_host = '192.168.2.12';
        $db_name = 'fvision';
        $db_user = 'webuser';
        $db_password = 'insecure_db_pw';
        $db = new mysqli($db_host, $db_user, $db_password, $db_name);

        if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
        }
?>