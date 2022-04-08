<!DOCTYPE html>
<?php include "function/db_connect.php"; ?>
<html>
    <head>
        <?php
            include "include/bootstrap.php";
            include "include/jquery.php";
        ?>
        <link rel='stylesheet' href='css/cashier_list.css'>
        <script>
            $(document).ready(function(){
                loadCarts();

                //Function to Load Carts Every 5 Seconds
                setInterval(function(){
                    loadCarts()
                }, 5000);

                //Load Cart when Clicking cart from the list
                $(document).on('click', '.cart', function() {
                    var cart = $(this).attr('id');
                        $.ajax({
                            url:"function/load_cart.php",
                            method:"POST",
                            data:{cart_id:cart},
                            dataType:"html",
                            success:function(data) {
                                $("#cart-content-container").html(data);
                            },
                            error:function(){
                                alert("Something went wrong");
                            }
                        });
                });

                //Adds QTY in the cart. Also Updates cart_listing in DB
                $(document).on('click', '.add_qty', function(){
                    var item_listing_id = $(this).attr('id');
                    var stock_qty = parseInt($("input[name=inventory_amount_"+item_listing_id+"]").val());
                    var amount = parseInt($("input[name=amount_"+item_listing_id+"]").val());
                    var price = $("#price_"+item_listing_id).attr('name');
                    if(stock_qty > amount){ //Check if cart_listing QTY is below the item stock in DB
                        $.ajax({
                            url:"function/cart_add_qty.php",
                            method:"POST",
                            data:{listing_id:item_listing_id,item_amount:amount,item_price:price},
                            dataType:"html",
                            success:function(data) {
                                $("#amount_"+item_listing_id).html(data);
                                $("#input_amount_"+item_listing_id).val(data);
                                var newPrice = data * price;
                                var newTotal = parseFloat($("#price_total").text()) + parseFloat(price);
                                $("#price_total").html(newTotal.toFixed(2));
                                $("#price_total_2").html(newTotal.toFixed(2));
                                $("#price_"+item_listing_id).html(newPrice.toFixed(2));
                            },
                            error:function(){
                                alert("Something went wrong");
                            }
                        });
                    }
                    else{
                        alert('You cannot add more of this item.');
                    }
                });

                //Clone of Add QTY, but subtracts from QTY instead
                $(document).on('click', '.sub_qty', function(){
                    var item_listing_id = $(this).attr('id');
                    var amount = $("input[name=amount_"+item_listing_id+"]").val();
                    var price = $("#price_"+item_listing_id).attr('name');
                    if(amount == 0){ //Cashiers aren't be able to remove items
                        alert("You cannot remove items from this screen");
                    }
                    else{
                        $.ajax({
                            url:"function/cart_sub_qty.php",
                            method:"POST",
                            data:{listing_id:item_listing_id,item_amount:amount,item_price:price},
                            dataType:"html",
                            success:function(data) {
                                $("#amount_"+item_listing_id).html(data);
                                $("#input_amount_"+item_listing_id).val(data);
                                var newPrice = data * price;
                                var newTotal = parseFloat($("#price_total").text()) - parseFloat(price);
                                $("#price_total").html(newTotal.toFixed(2));
                                $("#price_total_2").html(newTotal.toFixed(2));
                                $("#price_"+item_listing_id).html(newPrice.toFixed(2));
                            },
                            error:function(){
                                alert("Something went wrong");
                            }
                        });
                    }
                });

                //Completes Transaction for Cart
                $(document).on('click', '.submit_cart', function() {
                    var cart = $(this).attr('id');
                    var total_amount = parseFloat($("#price_total").text()); //Total
                    var paid_amount = $("input[name=amount_paid]").val(); //Paid
                    //!! ADD CART TOTAL AND CHANGE !!
                    $.ajax({
                        url:"function/cart_transact.php",
                        method:"POST",
                        data:{cart_id:cart, total:total_amount, paid:paid_amount},
                        dataType:"html",
                        success:function(data) {
                            $("#cart-form").remove();
                            $("#change-content").removeClass('hidden');
                            $("#cart_change").text(data);
                            $("#cart-modal-content").addClass('hidden');
                            loadCarts();
                        },
                        error:function(){
                            alert("Something went wrong");
                        }
                    });
                });

                $(document).on('click','.finalize_cart', function() {
                    var cart = $(this).attr('id');
                    var amount = parseFloat($("#price_total").text());
                    openModal(cart,amount);
                });

                $(document).on('click','.submit_cancel', function() {
                    closeModal();
                });

                $('.modal-container').on('click', function(e) {
                    if (e.target !== this)
                        return;
                    closeModal();
                });
            });

            function closeModal() {
                $("#cart-modal-content").removeClass('hidden');
                $("#change-content").addClass('hidden');
                $("#price-modal").addClass('hidden');
                $("#change-content").addClass('hidden');
                openModal(cart,amount);
            };

            //Function to Load "CONFIRMED" Carts from DB
            function loadCarts(){
                $("#cart-list-container").load("function/load_cart_list.php");
            };

            //Function for Modal
            function openModal(cart,amount){
                $("#price-modal").removeClass('hidden');
                $("#cart_due").text(amount);
                $(".submit_cart").attr('id', cart);
            };

        </script>
    </head>
    <body>
        <?php include "include/navbar.php"; ?>
        <div style="height:100%; width:100%; position:absolute;">
            <div class="container home-section h-100" style="max-width:95%;">
                <div class="col-12 pt-5 pb-2 h-100">
                    <div class="row container-fluid bg-light p-2 mb-5 h-100">
                        <div id="cart-list" class="cart-list col-md-3 h-100">
                            <div id="cart-list-container" class="cart-list-container">
                                <!-- Cart List Outputted Here -->
                            </div>
                        </div>
                        <div id="cart-content" class="cart-content col-md-9">
                            <div id="cart-content-container" class="cart-content-container">
                                <!-- Cart Contents Put Here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="price-modal" class="modal-container hidden">
            <div id="cart-modal-content" class="modal-box cart-modal-content">
                <div style="flex:80%; padding-top:20%;">
                    <div>
                        <span>Balance Due:</span>
                        <span class='num-info'>PHP <span id='cart_due'></span></span>
                    </div>
                    <div>
                        <span>Enter Amount Paid:</span>
                        <span class='num-info'><input type='number' name='amount_paid'></span>
                    </div>
                </div>
                <div style="flex:20%; display:flex; flex-direction:column;">
                    <span style="margin:auto; height:100%;">
                        <input type='button' class='submit_cancel' value='Cancel'>
                        <input type='button' class='submit_cart' id='' value='Confirm Transaction'>
                    </span>
                </div>
            </div>
            <div id="change-content" class="modal-box cart-modal-content hidden">
                <div style="flex:80%; padding-top:20%;">
                    <span>Change Due:</span>
                    <span class='num-info'>PHP <span id='cart_change'></span></span>
                </div>
                <div style="flex:20%; display:flex; flex-direction:column;">
                    <span style="margin:auto; height:100%;">
                        <input type='button' class='submit_cancel' value='Close'>
                    </span>
                </div>
            </div>
        </div>
    </body>
</html>