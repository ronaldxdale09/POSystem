<?php  
 include('db.php');
 $output = '';  
 
$cart_id = $_SESSION['cart_id'];
$sql  = "SELECT * from cart_listing where cart='$cart_id'"; 



 $result = mysqli_query($con, $sql);  
 $output .= '  
    <table class="table  table-shopping-cart"  id="table-to-refresh">
    <thead class="text-muted">
        <tr class="small text-uppercase">
        <th scope="col">Product</th>
        <th scope="col" width="180">Quantity</th>
        <th scope="col" width="180">Price</th>
        <th scope="col" width="130"></th>
        </tr>
        </thead>';  
 if(mysqli_num_rows($result) > 0)  
 {  
      while($arr = mysqli_fetch_array($result))  
      {  
        $prod = $arr['product'];
        $getProdInfo = mysqli_query($con, "SELECT * FROM product WHERE id='$prod'");
        $rowProd = mysqli_fetch_array($getProdInfo);
        
        // get info in inventory listing
        $getPrice = mysqli_query($con, "SELECT * FROM inventory_listing WHERE product='$prod'");
        $rowInventory = mysqli_fetch_array($getPrice);


           $output .= '  
                <tr>  
                <td scope="row" hidden>'.$arr["id"].'</td>
                <td scope="row" hidden>'.$arr["product"].'</td>
                <td scope="row">'.$rowProd['name'].'</td>
                <td>
                   <div class="input-counter"  >
                      <span class="minus-btn"><i class="fa fa-minus"></i></span>
                      <input type="text"  value="'.$arr['quantity'].'" readonly>
                      <span class="plus-btn"><i class="fa fa-plus"></i></span>
                   </div>
                </td>
                <td>
                   <div class="price-wrap"> <var class="price">₱ '.$arr['total_amount'].'</var> <small class="text-muted">₱ '.$rowInventory['price'].' each </small> </div>
                </td>
                <td> <button type="button" class="btn btn-danger text-white"><span class="fa fa-trash "></span></button></td>
            
                </tr>  
           ';  
      } 
      
}
 else  
 {  
      $output .= '<tr>  
                          <td colspan="4">Nothings in the cart</td>  
                     </tr>';  
 }  
 $output .= '</table>  


      </div>';  
 echo $output;  
 ?> 

 
<script>
$('.input-counter').each(function() {
  var spinner = jQuery(this),
  input = spinner.find('input[type="text"]'),
  btnUp = spinner.find('.plus-btn'),
  btnDown = spinner.find('.minus-btn'),
  min = input.attr('min'),
  max = input.attr('max');
  btnUp.on('click', function() {
    var oldValue = parseFloat(input.val());
    if (oldValue >= max) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue + 1;
     }
     spinner.find("input").val(newVal);
     spinner.find("input").trigger("change");
    
   //   get data
     $tr = $(this).closest('tr');
      var data =$tr.children("td").map(function(){
      return $(this).text();
      }).get();
      var list_id = (data[0]);
      var product = (data[1]);
      var quantity = (newVal);
     
      $.ajax({
                    type: "POST",
                    url: "function/quantityControl.php",
                    data: {
                        id: list_id,
                        product: product,
                        quantity: quantity,
                    },
                    cache: false,
                    success: function(data) {
                      fetch_data();
                      $( "#cart_card_table" ).load( "cart.php #cart_card_table" );
                      $( "#confirm_total_price" ).load( "cart.php #confirm_total_price" );
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });




   
    });

    btnDown.on('click', function() {
      var oldValue = parseFloat(input.val());
      if (oldValue <= min) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue - 1;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");

      
   //   get data
     $tr = $(this).closest('tr');
      var data =$tr.children("td").map(function(){
      return $(this).text();
      }).get();
      var list_id = (data[0]);
      var product = (data[1]);
      var quantity = (newVal);

      if (quantity == 0) {

        $.ajax({
                    type: "POST",
                    url: "function/remove_product.php",
                    data: {
                        id: list_id,
                    },
                    cache: false,
                    success: function(data) {
                      fetch_data();
                      $( "#cart_card_table" ).load( "cart.php #cart_card_table" );
                      $( "#confirm_total_price" ).load( "cart.php #confirm_total_price" );
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });

      }
      else {

        $.ajax({
                    type: "POST",
                    url: "function/quantityControl.php",
                    data: {
                        id: list_id,
                        product: product,
                        quantity: quantity,
                    },
                    cache: false,
                    success: function(data) {
                      fetch_data();
                      $( "#cart_card_table" ).load( "cart.php #cart_card_table" );
                      $( "#confirm_total_price" ).load( "cart.php #confirm_total_price" );
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });
      }
     
      
      
      

   });
});
</script>
