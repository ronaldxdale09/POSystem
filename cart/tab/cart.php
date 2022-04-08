<div class="tabs">
   <input type="radio" name="tabs" id="tabone" checked="checked">
   <label for="tabone"><span class="fa fa-shopping-cart"></span> Cart ID :  <?php echo $_SESSION['cart_id'] ?></label>
   <div class="tab">
      <!-- START CART -->
      <?php 
         $cart_id = $_SESSION['cart_id'];
         $cartQuery  = mysqli_query($con, "SELECT * from cart_listing where cart='$cart_id'"); 
         
         
         $total_price_cart = mysqli_query($con, "SELECT SUM(total_amount) as total
         FROM cart_listing WHERE cart='$cart_id'"); 
         $total= mysqli_fetch_array($total_price_cart);
         
         ?>
      <div class="row">
         <aside class="col-lg-9">
            <div class="cart-card">
               <div class="table-responsive">
                  <div id='table-cart'>
                     <div id="live_data"></div>
                  </div>
               </div>
            </div>
         </aside>
         <aside class="col-lg-3">
            <div class="card">
               <div class="card-body">
                  <div id='cart_card_table'>
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
                        <dd class="text-right text-dark b ml-3"><strong>₱  <?php echo  round($total['total'], 2); ?></strong></dd>
                     </dl>
                  </div>
               </div>
            </div>
         </aside>
      </div>
      <!-- END CART -->
   </div>
   <input type="radio"  id="tabthree">
   <label>
      STATUS : 
      <div id='status_session'><?php echo $_SESSION['status']?> </div>
   </label>
   <!--
      <div class="tab">
        <h1>Third Tab Content</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      </div> -->
</div>