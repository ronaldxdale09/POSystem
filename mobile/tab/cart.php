
    <?php 
    
    $temp  = mysqli_query($con, "SELECT * from mobile_temp_cart"); 
    
    ?>
    <div class="row">
        <aside class="col-lg-9">
            <div class="cart-card">
                <div class="table-responsive">
                    <table class="table  table-shopping-cart">
                        <thead class="text-muted">
                            <tr class="small text-uppercase">
                                <th scope="col">Product</th>
                                <th scope="col" width="120">Quantity</th>
                                <th scope="col" width="120">Price</th>
                                <th scope="col"  width="200"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </aside>
        <aside class="col-lg-3">
         
            <div class="card">
                <div class="card-body">
                    <dl class="dlist-align">
                        <dt>Total price:</dt>
                        <dd class="text-right ml-3">₱ 132.00</dd>
                    </dl>
                    <dl class="dlist-align">
                        <dt>Discount:</dt>
                        <dd class="text-right text-danger ml-3">- ₱ 0.00</dd>
                    </dl>
                    <dl class="dlist-align">
                        <dt>Total:</dt>
                        <dd class="text-right text-dark b ml-3"><strong>₱ 132.00</strong></dd>
                    </dl>
                    
                </div>
            </div>
        </aside>
    </div>


