<?php
    include "db_connect.php";
    $carts = mysqli_query($link,"SELECT * FROM cart WHERE status='CONFIRMED'");
    if($_POST['selected'] != '')
        $selected = $_POST['selected'];
    else
        $selected = '';
    while($cart=mysqli_fetch_array($carts)):
        $cart_id = $cart['id'];
        $date_created = $cart['date_created'];
        $status = $cart['status'];
        echo "
        <div id='$cart_id' class='cart selectable ";
        if($cart_id == $selected)
            echo 'active';
        echo "'>
            <div class='cart-date'>
                $date_created
            </div>
            <div style='padding:0px; margin:0px;'>
                Cart ID: $cart_id
            </div>
            <div>
              
            </div>
            <div>
                Status: $status
            </div>
        </div>
        ";
    endwhile;
?>