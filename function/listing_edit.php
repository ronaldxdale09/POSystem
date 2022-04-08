<?php
    include "db_connect.php";
    $listing_id = $_REQUEST['listing_id'];
    $quantity = $_REQUEST['quantity'];
    $price = $_REQUEST['price'];
    mysqli_query($link,"UPDATE inventory_listing SET price=$price,quantity=$quantity WHERE id=$listing_id");
?>