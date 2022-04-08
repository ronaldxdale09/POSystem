<?php
    include "db_connect.php";
    $cart_id = $_REQUEST['cart_id'];
    $total = $_REQUEST['total'];
    $paid = $_REQUEST['paid'];
    $cart_listing = mysqli_query($link,"SELECT * FROM cart_listing WHERE cart = $cart_id");
    while($item_listing=mysqli_fetch_array($cart_listing)):
        $item_id = $item_listing['product'];
        $item_amount = $item_listing['quantity'];
        $inventory_record = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM inventory_listing WHERE product=$item_id"));
        $inventory_qty = $inventory_record['quantity'];
        $new_inventory_qty = $inventory_qty - $item_amount;
        mysqli_query($link,"UPDATE inventory_listing SET quantity=$new_inventory_qty WHERE product=$item_id");
    endwhile;

    mysqli_query($link,"UPDATE cart SET status='TRANSACTED',date_transacted=NOW(),final_total=$total,amount_paid=$paid WHERE id=$cart_id");
    echo $paid - $total;
?>