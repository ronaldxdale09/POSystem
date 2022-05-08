<!DOCTYPE html>
<?php 
    include "function/db_connect.php"; 
    include "function/authenticate.php";
?>
<html>

<head>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
            include "include/bootstrap.php";
            include "include/jquery.php";
            include "modal_cashier.php";
        ?>
    <link rel='stylesheet' href='css/cashier_list.css'>
    <title>Cashier | Qcut</title>
    <script>
    var barcode = '';
    var interval;
    document.addEventListener('keydown', function(evt) {
        if (interval)
            clearInterval(interval);
        if (evt.code == 'Enter') {
            if (barcode)
                handleBarcode(barcode);
            barcode = '';
            return;
        }
        if (evt.key != 'Shift')
            barcode += evt.key;
        interval = setInterval(() => barcode = '', 100);
    });

    function handleBarcode(scanned_barcode) {

        checkBarcode(scanned_barcode);

    }


    // [dale]RETRIEVE USER CART DATA
    function checkBarcode(barcode) {
        // script for barcode scanning
        var cart = document.getElementById('selected_cart_id').value;
        $.ajax({
            url: "function/checkUserCart.php",
            method: "POST",
            data: {
                cart_id: cart,
                barcode: barcode
            },
            success: function(data) {

                if (data[3] == null) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'This Item is not on the user cart',
                    });

                } else {

                    var cart = data[0];
                    var bar = data[1];
                    var name = data[2];
                    var quantity = data[3];
                    var total = data[4];
                    var cashier_status = data[5];
                    var prod_id = data[6];
                    var price = data[7];

                    $('#cart_id').val(cart);
                    $('#inputed_barcode').val(bar);
                    $('#scanned_name').val(name);
                    $('#scanned_quantity').val(data[3]);
                    $('#scanned_price').val(total);
                    $('#prod_id').val(prod_id);
                    $('#each_price').val(price);
                    $('#verify_cart').modal('show');

                }
            }
        });
    }

    // [DALE] CHANGE VALUE OF TOTAL PRICE BASE ON QUANTITY INSIDE MODAL
    $(function() {
        $("#scanned_quantity").keyup(function() {

            $("#scanned_price").val(((+$("#scanned_quantity").val().replace(/,/g, '')  * +$("#each_price").val()
                .replace(/,/g, ''))).toLocaleString());
 
        });
    });


    </script>


    <script>
    $(document).ready(function() {
        loadCarts();

        //Function to Load Carts Every 5 Seconds
        setInterval(function() {
            loadCarts()
        }, 5000);

        //Load Cart when Clicking cart from the list
        $(document).on('click', '.cart', function() {
            var cart = $(this).attr('id');
            $(this).addClass('active').siblings().removeClass('active');
            $("#selected-cart").val(cart);
            loadcart_table(cart);
        });
        // [DALE] load cart
        function loadcart_table(cart) {
            $.ajax({
                url: "function/load_cart.php",
                method: "POST",
                data: {
                    cart_id: cart
                },
                dataType: "html",
                success: function(data) {
                    $("#cart-content-container").html(data);
                },
                error: function() {
                    alert("Something went wrong");
                }
            });
        }

        //Adds QTY in the cart. Also Updates cart_listing in DB
        $(document).on('click', '.add_qty', function() {
            var item_listing_id = $(this).attr('id');
            var stock_qty = parseInt($("input[name=inventory_amount_" + item_listing_id + "]").val());
            var amount = parseInt($("input[name=amount_" + item_listing_id + "]").val());
            var price = $("#price_" + item_listing_id).attr('name');
            if (stock_qty > amount) { //Check if cart_listing QTY is below the item stock in DB
                $.ajax({
                    url: "function/cart_add_qty.php",
                    method: "POST",
                    data: {
                        listing_id: item_listing_id,
                        item_amount: amount,
                        item_price: price
                    },
                    dataType: "html",
                    success: function(data) {
                        console.log(data);
                        $("#amount_" + item_listing_id).html(data);
                        $("#input_amount_" + item_listing_id).val(data);
                        var newPrice = data * price;
                        var newTotal = parseFloat($("#price_total").text()) + parseFloat(
                            price);
                        $("#price_total").html(newTotal.toFixed(2));
                        $("#price_total_2").html(newTotal.toFixed(2));
                        $("#price_" + item_listing_id).html(newPrice.toFixed(2));
                    },
                    error: function() {
                        alert("Something went wrong");
                    }
                });
            } else {
                alert('You cannot add more of this item.');
            }
        });

        //Clone of Add QTY, but subtracts from QTY instead
        $(document).on('click', '.sub_qty', function() {
            var item_listing_id = $(this).attr('id');
            var amount = $("input[name=amount_" + item_listing_id + "]").val();
            var price = $("#price_" + item_listing_id).attr('name');
            if (amount == 0) { //Cashiers aren't be able to remove items
                alert("You cannot remove items from this screen");
            } else {
                $.ajax({
                    url: "function/cart_sub_qty.php",
                    method: "POST",
                    data: {
                        listing_id: item_listing_id,
                        item_amount: amount,
                        item_price: price
                    },
                    dataType: "html",
                    success: function(data) {
                        $("#amount_" + item_listing_id).html(data);
                        $("#input_amount_" + item_listing_id).val(data);
                        var newPrice = data * price;
                        var newTotal = parseFloat($("#price_total").text()) - parseFloat(
                            price);
                        $("#price_total").html(newTotal.toFixed(2));
                        $("#price_total_2").html(newTotal.toFixed(2));
                        $("#price_" + item_listing_id).html(newPrice.toFixed(2));
                    },
                    error: function() {
                        alert("Something went wrong");
                    }
                });
            }
        });

        //Completes Transaction for Cart
        $(document).on('click', '.submit_cart', function() {
            // button function
            var cart = document.getElementById('selected_cart_id').value;
            var total_amount = parseFloat($("#price_total").text()); //Total
            var paid_amount = $("input[name=amount_paid]").val(); //Paid
            //!! ADD CART TOTAL AND CHANGE !! [Done]
            $.ajax({
                url: "function/cart_transact.php",
                method: "POST",
                data: {
                    cart_id: cart,
                    total: total_amount,
                    paid: paid_amount
                },
                dataType: "html",
                success: function(data) {
                    $("#cart-form").remove();
                    $("#change-content").removeClass('hidden');
                    $("#cart_change").text(data);
                    $("#cart-modal-content").addClass('hidden');
                    loadCarts();
                },
                error: function() {
                    alert("Something went wrong");
                }
            });
            // end

        });


        //Opens Cancel Cart Confirmation Modal
        $(document).on('click', '.cancel_cart', function() {
            var cart = document.getElementById('selected_cart_id').value;
            $(".cancel_cart").attr('id', cart);
            $("#cancel-modal").removeClass('hidden');
            $("#cancel-content").removeClass('hidden');
        });

        //Cancels Cart Confirmation
        $(document).on('click', '.confirm_cancel_cart', function() {
            var cart = document.getElementById('selected_cart_id').value;
            $.ajax({
                url: "function/cart_cancel.php",
                method: "POST",
                data: {
                    cart_id: cart,
                },
                dataType: "html",
                success: function() {
                    $("#cart-form").remove();
                    closeCancelModal();
                    loadCarts();

                    Swal.fire({
                        icon: 'success',
                        title: 'CART',
                        text: 'Cart cancelled sucessfully',

                    });

                },
                error: function() {
                    alert("Something went wrong");
                }
            });
        });

        //Opens Close Cart Confirmation Modal
        $(document).on('click', '.close_cart', function() {
            var cart = document.getElementById('selected_cart_id').value;
            $(".close_cart").attr('id', cart);
            $("#cancel-modal").removeClass('hidden');
            $("#close-content").removeClass('hidden');
        });

        //Cancels Cart Confirmation
        $(document).on('click', '.confirm_cancel_cart', function() {
            var cart = document.getElementById('selected_cart_id').value;
            $.ajax({
                url: "function/cart_cancel.php",
                method: "POST",
                data: {
                    cart_id: cart,
                },
                dataType: "html",
                success: function() {
                    $("#cart-form").remove();
                    closeCancelModal();
                    loadCarts();
                },
                error: function() {
                    alert("Something went wrong");
                }
            });
        });

        //Closes Cart
        $(document).on('click', '.confirm_close_cart', function() {
            var cart = document.getElementById('selected_cart_id').value;
            $.ajax({
                url: "function/cart_close.php",
                method: "POST",
                data: {
                    cart_id: cart,
                },
                dataType: "html",
                success: function() {
                    $("#cart-form").remove();
                    closeCancelModal();
                    loadCarts();
                },
                error: function() {
                    alert("Something went wrong");
                }
            });
        });


        //Opens Close Cart Confirmation Modal
        $(document).on('click', '.close_cart', function() {
            var cart = document.getElementById('selected_cart_id').value;
            $(".cancel_cart").attr('id', cart);
            $("#cancel-modal").removeClass('hidden');
            $("#close-content").removeClass('hidden');
        });

        $(document).on('click', '.finalize_cart', function() {
            // [DALE] check if all item on cart has been verified
            var cart = document.getElementById('selected_cart_id').value;
            $.ajax({
                url: "function/checkAllConfirmedButton.php",
                method: "POST",
                data: {
                    cart_id: cart,
                },
                success: function(data) {

                    var result = data;

                    if (result == 1) {

                        var cart = $(this).attr('id');
                        var amount = parseFloat($("#price_total").text());
                        openModal(cart, amount);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Make Sure to Verify all product',

                        });

                    }


                }
            });
        });

        $(document).on('click', '.submit_cancel', function() {
            closeModal();
        });

        $(document).on('click', '.cancel_cancel', function() {
            closeCancelModal();
        });

        $('.modal-container').on('click', function(e) {
            if (e.target !== this)
                return;
            if (e.id == 'price-modal')
                closeModal();
            else
                closeCancelModal();
        });



        // [DALE] SUBMIT FORM WITHOUT RELOADING THE PAGE
        $('#myForm').submit(function() {
            return false;
        });

        $('#confirmCashier').click(function() {
            $("#verify_cart").modal("hide");
            $.post(
                $('#myForm').attr('action'),

                $('#myForm :input').serializeArray(),
                function(result) {
                    $('#result').html(result);
                    var cart = document.getElementById('selected_cart_id').value;
                    loadcart_table(cart)
                    Swal.fire(
                        'Good job!',
                        'Transaction Was Successful',
                        'success'
                    );
                }
            );
        });
        //    end

        //Adding Selected Class to Cashier Tabs
        $('.selectable').click(function() {
            alert('Hello World');
            $(this).addClass('active').siblings().removeClass('active');
            console.log('Selected!');
        });
    });

    function closeModal() {
        $("#cart-modal-content").removeClass('hidden');
        $("#change-content").addClass('hidden');
        $("#price-modal").addClass('hidden');
        $("#change-content").addClass('hidden');
        openModal(cart, amount);
    };

    //Function to Load "CONFIRMED" Carts from DB
    function loadCarts() {
        var selected_id = document.getElementById('selected-cart').value;
        var data = {
            selected: selected_id,
        };
        $("#cart-list-container").load("function/load_cart_list.php", data);
    };

    //Function for Modal
    function openModal(cart, amount) {
        $("#price-modal").removeClass('hidden');
        $("#cart_due").text(amount);
        $(".submit_cart").attr('id', cart);
    };

    function openCancelModal(cart) {
        $(".cancel_cart").attr('id', cart);
        $("#cancel-modal").removeClass('hidden');
        alert(cart);
    };


    function closeCancelModal(cart) {
        $(".cancel_cart").attr('id', cart);
        $("#cancel-modal").addClass('hidden');
        $("#cancel-content").addClass('hidden');
        $("#close-content").addClass('hidden');
    };
    </script>



</head>

<body>
    <?php include "include/navbar.php"; ?>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="col-12 pt-1 pb-2 h-100">
                <div class="row container-fluid bg-light p-2 h-100">
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
        <div id="cart-modal-content" class="modal-box cart-modal-content" style='width:500px; height:330px;'>
            <div style="flex:80%; padding-top:30px;">
                <h3>Complete Transaction</h3>
                <hr>
                <div class='enlarge-txt'>
                    <span>Balance Due:</span>
                    <span class='num-info'>PHP <span id='cart_due'></span></span>
                </div>
                <div class='enlarge-txt'>
                    <span>Amount Paid:</span>
                    <span class='num-info'><input type='number' name='amount_paid' class='text-end'
                            id='amount-number-input'></span>
                </div>
            </div>
            <div style="flex:20%; display:flex; flex-direction:column;">
                <span style="margin:auto; height:100%;">
                    <button type='button' class='submit_cancel btn btn-danger' value='Cancel'
                        style='font-size:30px; padding:20px 40px;'><i
                            class='fa-regular fa-rectangle-xmark'></i></button>
                    <button type='button' class='submit_cart btn btn-success' id='' value='Confirm Transaction'
                        style='font-size:30px; padding:20px 40px;'><i class='fa-solid fa-cart-shopping'
                            title='Complete Transaction'></i> <i class='fa-regular fa-circle-check'></i></button>
                </span>
            </div>
        </div>
        <div id="change-content" class="modal-box cart-modal-content hidden" style='width:400px; height:200px;'>
            <div style="flex:80%; padding-top:30px;">
                <h3 style='margin:auto;'>Transaction Completed!</h3>
                <hr>
                <span>Change Due:</span>
                <span class='num-info'>PHP <span id='cart_change'></span></span>
            </div>
            <div style="flex:20%; display:flex; flex-direction:column;">
                <span style="margin:auto; height:100%;">
                    <button type='button' class='submit_cancel btn btn-success' value='Close'
                        style='width:50px; padding:10px 20px;'><i class="fa-solid fa-check-double"></i> Return</button>
                </span>
            </div>
        </div>
    </div>
    <div id="cancel-modal" class='modal-container hidden'>
        <div id="cancel-content" class="modal-box cart-modal-content hidden" style='width:400px; height:300px;'>
            <div style="flex:80%; padding-top:30px;">
                <h3 class='text-center' style='margin:auto;'>Are you sure you want to CANCEL this cart?</h3>
                <h4 class='text-center' style='margin:auto;'>The Customer will be able to continue shopping</h4>
                <hr>
            </div>
            <div style="flex:20%; display:flex; flex-direction:column;">
                <span style="margin:auto; height:100%;">
                    <button type='button' class='cancel_cancel btn btn-secondary'
                        style='padding:10px 20px;'>Return</button>
                    <button type='button' class='confirm_cancel_cart btn btn-primary' id=''
                        style='padding:10px 20px;'><i class="fa-regular fa-rectangle-xmark"></i> Cancel</button>
                </span>
            </div>
        </div>
        <div id="close-content" class="modal-box cart-modal-content hidden" style='width:400px; height:300px;'>
            <div style="flex:80%; padding-top:30px;">
                <h3 class='text-center' style='margin:auto;'>Are you sure you want to CLOSE this cart?</h3>
                <h4 class='text-center text-danger' style='margin:auto;'>The Customer will NOT be able to continue
                    shopping</h4>
                <hr>
            </div>
            <div style="flex:20%; display:flex; flex-direction:column;">
                <span style="margin:auto; height:100%;">
                    <button type='button' class='cancel_cancel btn btn-secondary'
                        style='padding:10px 20px;'>Return</button>
                    <button type='button' class='confirm_close_cart btn btn-danger' id='' style='padding:10px 20px;'><i
                            class="fa-regular fa-trash-can"></i> Close</button>
                </span>
            </div>
        </div>
    </div>
</body>

</html>