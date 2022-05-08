<!-- BARCODE -->
<div class="modal fade" id="input-barcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">INPUT BARCODE</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/newSeller.php" method="POST">
                    <!-- ... START -->
                    <center>
                        <div class="card">
                            <div class="card-body">
                                <dl class="dlist-align">
                                    <dt>Product Name:</dt>
                                    <dd class="text-right ml-3">Test</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Price:</dt>
                                    <dd class="text-right text-danger ml-3">-Test</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Category:</dt>
                                    <dd class="text-right text-dark b ml-3"><strong>Test</strong></dd>
                                </dl>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">CODE</label>
                            <div class="col-md-8">
                                <input type="text" value="" id='barcode_manually'
                                    class="form-control form-control-line">
                            </div>
                            <br>
                    </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name='add' class="btn btn-success text-white">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- END -->




<!-- SETTINGS -->
<div class="modal fade" id="setting-mobile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">INPUT BARCODE</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/newSeller.php" method="POST">
                    <!-- ... START -->
                    <center>
                        <div class="card">
                            <div class="card-body">
                                <dl class="dlist-align">
                                    <dt>CART ID:</dt>
                                    <dd class="text-right ml-3"><?php echo $_SESSION['cart_id'] ?></dd>
                                </dl>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">CODE</label>
                            <div class="col-md-8">
                                <input type="text" value="" name='code' class="form-control form-control-line">
                            </div>
                            <br>
                    </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name='add' class="btn btn-success text-white">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- END -->

<?php 
   $cart_id = $_SESSION['cart_id'];
   
   $total_price_cart = mysqli_query($con, "SELECT SUM(total_amount) as total
   FROM cart_listing WHERE cart='$cart_id'"); 
   $total= mysqli_fetch_array($total_price_cart);
   
   ?>
<!-- CONFIRM TRANSACTION -->
<div class="modal fade" id="confirm_table">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CONFIRM TRANSACTION</h5>
            </div>
            <div class="modal-body">
                <form action="function/confirm_cart.php" method="POST">
                    <!-- ... START -->
                    <div class="card">
                        <div class="card-body">
                            <div id='confirm_total_price'>
                                <dl class="dlist-align">
                                    <dt>Total price:</dt>
                                    <dd class="text-right ml-3">₱ <?php echo  round($total['total'], 2); ?></dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Discount:</dt>
                                    <dd class="text-right text-danger ml-3">- ₱ 0.00</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Total:</dt>
                                    <dd class="text-right text-dark b ml-3"><strong>₱
                                            <?php echo  round($total['total'], 2); ?></strong></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name='submit' class="btn btn-success text-white">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- CANCEL TRANSACTION -->
<div class="modal fade" id="cancel_cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mobile Scanner</h5>
            </div>
            <div class="modal-body">
                <form action="function/cancel_cart.php" method="POST">
                    <!-- ... START -->
                    <h5 class="modal-title text-center" id="exampleModalLabel"
                        style='font-size:23px; font-weight:bold;'>CANCEL TRANSACTION</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Return</button>
                <button type="submit" name='submit' class="btn btn-danger text-white">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- EDIT TRANSACTION -->
<div class="modal fade" id="edit_cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mobile Scanner</h5>
            </div>
            <div class="modal-body">
                <form action="function/edit_cart.php" method="POST">
                    <!-- ... START -->
                    <h5 class="modal-title" id="exampleModalLabel" style='font-size:23px; font-weight:bold;'>EDIT
                        TRANSACTION</h5>
            </div>
            <div class="modal-footer">
                <button type="submit" name='submit' class="btn btn-success text-white">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </form>
            </div>
        </div>
    </div>
</div>





<!-- QUALITY CONTROL -->
<div class="modal fade" id="quantity_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/quantityControl.php" id='quantity-form' method="POST">
                    <!-- ... START -->
                    <center>
                        <input type="text" id='list_id' name='list_id' hidden>
                        <input type="text" id='product' name='product' hidden>
                        <div class="card">
                            <div class="card-body">
                                <dl class="dlist-align">
                                    <dt>Product Name:</dt>
                                    <dd class="text-right ml-3">
                                        <br>
                                        <input type="text" id='prod_name' name='prod_name'
                                            style='border: none;border-color: transparent;'>
                                    </dd>
                                </dl>
                            </div>
                        </div>

                        <!-- COUNTER -->
                        <div class="input-counter">
                            <span class="minus-btn"><i class="fa fa-minus"></i></span>
                            <input type="text" name='quanity_no' id='quanity_no'>
                            <span class="plus-btn"><i class="fa fa-plus"></i></span>

                        </div>
                        <br>
                        <hr>


            </div>

            <button type="submit" name='confirmQuantity' id='confirmQuantity'
                class="btn btn-success text-white">Confirm</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Return</button>

            </form>
            </center>

        </div>
    </div>
</div>







<!-- SUCCESS TRANSACTED MODAL -->

<div class="modal fade" id="transacted_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            </div>

            <div class="modal-body">

                <div class="thank-you-pop">
                    <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
                    <h1>TRANSACTED!</h1>
                    <p>Thank you !</p>
                    <!-- <h3 class="cupon-pop">Your Id: <span>12345</span></h3> -->

                </div>

            </div>
            <form action="function/send_receipt.php" method="POST">
                <button type="submit" name='submit' class="btn btn-success text-white">Confirm</button>
            </form>
        </div>
    </div>
</div>


<form action="cart.php">
    <div class="modal fade" id="cashier_cancel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                </div>

                <div class="modal-body">

                    <div class="thank-you-pop">
                        <img src="https://www.freeiconspng.com/thumbs/information-icon/-20-mb-format-psd-color-theme-blue-white-keywords-information-icon-2.jpg"
                            alt="">
                        <h1>ENABLED SHOPPING MODE !</h1>
                        <p>Cashier cancelled your confirmation and allow you to continue shopping!</p>
                        <!-- <h3 class="cupon-pop">Your Id: <span>12345</span></h3> -->

                    </div>

                </div>

                <button type="submit" class="btn btn-success text-white">Confirm</button>
</form>
</div>
</div>
</div>





<form action="../store.php">
    <div class="modal fade" id="cashier_close" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                </div>

                <div class="modal-body">

                    <div class="thank-you-pop">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUAYZJrcqUI_tDqjWc9LzExDnbRlexXFAhIQ&usqp=CAU"
                            alt="">
                        <h1>CASHIER HAS CLOSED YOUR CART!</h1>
                        <!-- <p>Please inform the cashier if this has</p> -->
                        <!-- <h3 class="cupon-pop">Your Id: <span>12345</span></h3> -->

                    </div>

                </div>

                <button type="submit" class="btn btn-success text-white">Confirm</button>
</form>
</div>
</div>
</div>