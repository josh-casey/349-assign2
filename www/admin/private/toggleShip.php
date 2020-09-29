<?php

include('sql.php');

$shipped = $_POST['shipped'];
$order_id = $_POST['order-id'];

if ($shipped == "Shipped") {
    $sql = "UPDATE orders SET shipped = '0' WHERE order_id = $order_id";
} else {
    $sql = "UPDATE orders SET shipped = '1' WHERE order_id = $order_id";
}

$result = $db->query($sql);

?>
