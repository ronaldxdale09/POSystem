<?php

include "db_connect.php";
$cart_id = $_POST['cart_id'];
$carts = mysqli_query($link,"SELECT * FROM cart WHERE id=$cart_id");
$cart=mysqli_fetch_array($carts);
$cart_id = $cart['id'];
$device_id = $cart['device_id'];
$date_created = $cart['date_created'];
$date_transacted = $cart['date_transacted'];
$status = $cart['status'];
$total = $cart['final_total'];
$paid = $cart['amount_paid'];

echo "   
        <div class='container sale-info-container'>
            <div class='row'>
                <div class='col-md-2'>
                    <p class='info-label'>ID</p>
                    <p class='info-value'>$cart_id</p>
                </div>
                <div class='col-md-2'>
                    <p class='info-label'>User ID</p>
                    <p class='info-value'>$device_id</p>
                </div>
                <div class='col-md-4'>
                    <p class='info-label'>Date Created</p>
                    <p class='info-value'>$date_created</p>
                </div>
                <div class='col-md-4'>
                    <p class='info-label'>Total Sale</p>
                    <p class='info-value'>$total</p>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-4'>
                    <p class='info-label'>Status</p>
                    <p class='info-value'>$status</p>
                </div>
                <div class='col-md-4'>
                    <p class='info-label'>Date Transacted</p>
                    <p class='info-value'>$date_transacted</p>
                </div>
                <div class='col-md-4'>
                    <p class='info-label'>Amount Paid</p>
                    <p class='info-value'>$paid</p>
                </div>
            </div>
        </div>
        <div class='sale-listings-container'>
            <table class='sale-listings sale-listings-header table table-dark'>
                <tr>
                    <td style='width:40%;'>
                        Product Name
                    </td>
                    <td style='text-align:center;width:20%;'>
                        Quantity
                    </td>
                    <td style='text-align:right;width:20%;'>
                        Item Price
                    </td>
                    <td style='text-align:right;width:240%;'>
                        Total Price
                    </td>
                </tr>
            </table>
            <div class='table-container' style='height:290px;'>
                <table class='sale-listings table table-striped' id='sale-listings' style='width:100%;'>";
$cart_listing = mysqli_query($link,"SELECT * FROM cart_listing WHERE cart = $cart_id");
while($item_listing=mysqli_fetch_array($cart_listing)):
    $item_id = $item_listing['product'];
    $item_record = mysqli_query($link,"SELECT * FROM product WHERE id=$item_id");
    $item = mysqli_fetch_array($item_record);
    $inventory_record = mysqli_query($link,"SELECT * FROM inventory_listing WHERE product=$item_id");
    $inventory = mysqli_fetch_array($inventory_record);
    if(isset($item)){
        $item_name = $item['name'];
        $item_listing_id = $item_listing['id'];
        $item_listing_quantity = $item_listing['quantity'];
        $inventory_price = $inventory['price'];
        $price = $item_listing['total_amount'];
            echo "
                    <tr>
                        <td style='width:40%;'>
                            $item_name
                        </td>
                        <td style='text-align:center;width:20%;'>
                            $item_listing_quantity
                        </td>
                        <td style='text-align:right;width:20%;'>
                            $inventory_price
                        </td>
                        <td style='text-align:right;width:20%;'>
                            $price
                        </td>
                    </tr>
                    ";
    }
endwhile;

echo "
                </table>
            </div>
        </div>
";

?>