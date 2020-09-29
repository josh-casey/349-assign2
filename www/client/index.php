<?php
$scriptList = array('js/jquery-3.5.1.min.js', 'js/shop.js', 'js/cart.js');
include('private/header.php');
include('private/sql.php');
?>

<main>
<section id="products">
    <?php
        $sql = "SELECT * FROM items";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            while ($product = $result->fetch_assoc()) {
                $name = $product['item_name'];
                $price = $product['item_price'];
                $description = $product['item_description'];
                $image = $product['item_image'];
                $id = $product['item_id'];
                ?>
                <div class="product-section">
                    <p class="product-id"><?php echo $id;?></p>
                    <h2 class="product-name"><?php echo $name; ?></h2>
                    <img src=<?php echo $image;?> width="125" height="125">
                    <h3 class="product-price"><?php echo $price; ?></h3>
                    <p><?php echo $description?></p>
                    <input type="submit" class="addToCart" value="Add to Cart">
                </div>
                <?php
            }
        } else {
            echo "fail";
        }
        ?>
</section>
<section id="cartTable"></section>
<section class="customer-form">
    <form>
        <h1>Shipping Information</h1>
        <input type="text" name="name" value="Name" id="name" required>
        <input type="text" name="email" value="E-mail" id="email" required>
        <input type="text" name="address" value="Address" id="address" required>
        <input type="button" id="order" value ="Place Order"> 
    </form>
</section>
</main>
