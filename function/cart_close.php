<?php
    include "db_connect.php";
    if (isset($_POST['cart_id'])){
        $cart_id = $_POST['cart_id'];
        $sql="UPDATE cart set status ='CANCEL' WHERE id='$cart_id'";
        mysqli_query($link,$sql);
    }
?>