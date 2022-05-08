<?php
    include "db_connect.php";
    if (isset($_POST['cart_id'])){
        $cart_id = $_POST['cart_id'];
        $sql="UPDATE cart set status ='OPEN' WHERE id='$cart_id'";
        mysqli_query($link,$sql);
        $sql="UPDATE cart_listing set cashier_scan = '' WHERE cart=$cart_id";
        mysqli_query($link,$sql);
    }
?>