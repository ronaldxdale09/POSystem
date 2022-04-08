<?php
    #DUMMY CODE TO CREATE CART
    include "db_connect.php";
    $sql="INSERT INTO cart(date_created, status, date_transacted) VALUES (NOW(),'OPEN',NULL)";
	mysqli_query($link,$sql);
    $cart_id = $link->insert_id;
    echo "	<script type='text/javascript'>
                window.location='DUMMY_page_cart.php?cart_id=$cart_id';
			</script>";
?>