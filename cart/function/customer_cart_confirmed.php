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
                <td scope="row" hidden>'.$arr["quantity"].'</td>
                </td>
                <td>
                   <div class="price-wrap"> <var class="price">₱ '.$arr['total_amount'].'</var> <small class="text-muted">₱ '.$rowInventory['price'].' each </small> </div>
                </td>          
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
