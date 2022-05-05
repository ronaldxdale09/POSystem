<?php
include('db.php');

    $cart_id  = $_POST['cart_id'];
    $prod_id  = $_POST['prod_id'];
    $quantity = $_POST['scanned_quantity'];
    $price    = $_POST['scanned_price'];
    
    
    
    
    $checkCartList = mysqli_query($con, "SELECT * FROM cart_listing 
    WHERE cart = '$cart_id' ");
    $arr = mysqli_fetch_array($checkCartList);
    
    if ($quantity >= $arr['quantity']) {
        $status = 1;
    } else {
        $status = 2;
    }
    
    
    
    
    $update  = "UPDATE  cart_listing set cashier_scan ='$status', quantity='$quantity' WHERE cart='$cart_id' and product ='$prod_id' ";
  
    if(mysqli_query($con, $update)){
                                   
        echo 'success';

        }
?>