<?php

include('sql.php');

$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$items = $_POST['items'];
$price = $_POST['price'];

$sql = "INSERT INTO orders VALUES ('0', '$items', '$name', '$email', '$address', '0')";

$result = $db->query($sql);
?>
