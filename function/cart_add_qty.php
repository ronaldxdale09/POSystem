<?php
    include "db_connect.php";
    if (isset($_POST['listing_id'])){
        $listing_id = $_POST['listing_id'];
        $item_amount = $_POST['item_amount'];
        $item_price = $_POST['item_price'];
        $item_amount = $item_amount + 1;
        $new_price = $item_amount * $item_price;
        $sql="UPDATE cart_listing SET quantity='$item_amount',amount='$new_price' WHERE id='$listing_id'";
        mysqli_query($link,$sql);
    }
    echo $item_amount;
?>