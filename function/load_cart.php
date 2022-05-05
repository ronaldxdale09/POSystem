<?php
    include "db_connect.php";
    include "../modal_cashier.php";
    $cart_id = $_POST['cart_id'];
    $carts = mysqli_query($link,"SELECT * FROM cart WHERE id=$cart_id");
    $cart=mysqli_fetch_array($carts);
    $cart_id = $cart['id'];

    $date_created = $cart['date_created'];
    $status = $cart['status'];
    //Delete '.cart-items' after transacting/cancelling.
    echo "
    <form method='post' action='#' id='cart-form'>
        <input type='hidden' name='cart_id' id='selected_cart_id' value='$cart_id'>
        <div class='table-container table-fix-head'>
            <table class='list-table'>
                <thead>
                    <tr>
                        <th class='list-label'>
                            Product
                        </th>
                        <th class='list-label'>
                            Quantity
                        </th>
                        <th class='list-label'>
                            Each
                        </th>
                        <th class='list-label'>
                            Total
                        </th>
                    </tr>
                </thead>";
    #Code to Select All item Listings in Cart
    $final_total = 0; #Total Price
    $cart_listing = mysqli_query($link,"SELECT * FROM cart_listing WHERE cart = $cart_id");
    $color='';
    while($item_listing=mysqli_fetch_array($cart_listing)):
        $item_id = $item_listing['product'];
        $item_record = mysqli_query($link,"SELECT * FROM product WHERE id=$item_id");
        $item = mysqli_fetch_array($item_record);
        $inventory_record = mysqli_query($link,"SELECT * FROM inventory_listing WHERE product=$item_id");
        $inventory = mysqli_fetch_array($inventory_record);
        if(isset($item)){
            $item_name = $item['name'];
            $item_listing_id = $item_listing['id'];
            $inventory_quantity = $inventory['quantity'];
            $item_listing_quantity = $item_listing['quantity'];
            $inventory_price = $inventory['price'];
            $price = $item_listing['total_amount'];
            $barcode = $item['barcode'];

            if ($item_listing['cashier_scan'] == 0){
                $color='#D8D8D8';
            }
            elseif ($item_listing['cashier_scan'] == 1){
                $color='#66FF99';
            }
            elseif ($item_listing['cashier_scan'] == 2){
                $color='#fdfd96';
            }

            echo "
            <style>
            td {
                display: table-cell;
                vertical-align: inherit;
                background:$color;
              }
            </style>
                <tr>
                <td hidden id='item_barcode'>
                $barcode
                    </td>
                    <td>
                        $item_name
                        <input type='hidden' name='inventory_amount_$item_listing_id' value='$inventory_quantity'>
                    </td>
                    <td>
                    <div id='amount_$item_listing_id'>
                        $item_listing_quantity
                    </div>
                    <input type='hidden' id='input_amount_$item_listing_id' name='amount_$item_listing_id' value='$item_listing_quantity'>
                    </td>
                    <td>
                        $inventory_price
                    </td>
                    <td id='price_$item_listing_id' name='$inventory_price'>
                        $price
                    </td>
                    <td>
                        <input type='button' value='-' id='$item_listing_id' class='qty_btn sub_qty'>
                    </td>
                    <td>
                        <input type='button' value='+' id='$item_listing_id' class='qty_btn add_qty'>
                    </td>
                </tr>";
            $final_total = $final_total + $price;
        }
    endwhile;
    echo "
            </table>
        </div>

        <div class='cart-btn-container'>
            <div class='cart-info'>
                <div>
                    <span>Subtotal:</span>
                    <span class='num-info'>PHP <span id='price_total' class='price_total'>$final_total</span></span>
                </div>
                <div>
                    <span>Tax:</span>
                    <span id='tax_total' class='num-info'>PHP 0.00</span>
                </div>
                <div class='balance-total'>
                    <span>Balance Due:</span>
                    <span id='balance_total' class='num-info'>PHP <span id='price_total_2' class='price_total'>$final_total</span></span>
                </div>
            </div>
            <div class='minor-btn-container'>
                <input type='button' id='cancel_cart' class='cancel_cart minor-cart-btn' value='Cancel Confirmation'>
                <input type='button' id='close_cart' class='close_cart minor-cart-btn'value='Close Cart' >

            </div>
            <div class='major-btn-container'>
                <input type='button' id='$cart_id' class='finalize_cart cart-btn' value='Confirm Transaction'>
            </div>
        </div>
    </form>



    ";

                
?>
