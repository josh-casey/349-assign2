<?php
$scriptList = array('js/jquery-3.5.1.min.js', 'js/ship.js');
include('private/header.php');
include('private/sql.php');
?>
<main>
  <div class = "table">
    <table class = "order-table">
      <tr>
        <th>Order ID</th>
        <th>Customer Name</th>
        <th>Customer Email</th>
        <th>Customer Address</th>
        <th>Items</th>
        <th>Order Status</th>
        <th>Status Toggle</th>
      </tr>

     
<?php
$sql = "SELECT * FROM orders";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    while ($purchases = $result->fetch_assoc()) {

      $name = $purchases['cust_name'];
      $email = $purchases['cust_email'];
      $address = $purchases['cust_address'];
      $orderId = $purchases['order_id'];
      $itemId = $purchases['item_id'];
      $status = $purchases['shipped'];

      if ($status == '0') {
        $status = "Not Shipped";
      } else {
        $status = "Shipped";
      }
?>
      
      <tr id="order">
        <td><?php echo $orderId; ?></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $email; ?></td>
        <td><?php echo $address; ?></td>
        <td><?php echo $itemId; ?></td>
        <td id="status"><?php echo $status ?></td>
        <td><input type="button" value="Toggle Status" name="refresh" id="toggleShip"/></td>
         
      <!-- <td><?php echo $status; ?></td> -->
      </tr><?php
    }
}
?>
    </table>
  </div>

</main>