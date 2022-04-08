<?php  
 include('db.php');
 $output = '';  


$sql  = "SELECT * from product "; 



 $result = mysqli_query($con, $sql);  
 $output .= '  
    <table id="table_prod" class="display">
    <thead class="text-muted">
        <tr class="small text-uppercase">
        <th scope="col" width="2000">Name</th>
        <th scope="col" width="180">Quantity</th>
        <th scope="col" width="180">Price</th>
        <th scope="col" width="300">Barcode</th>
        <th scope="col" width="180"></th>
        </tr>
        </thead>';  
 if(mysqli_num_rows($result) > 0)  
 {  
      while($arr = mysqli_fetch_array($result))  
      {  
       
        
        // get info in inventory listing
        $getProd = mysqli_query($con, "SELECT * FROM inventory_listing WHERE product='$arr[id]'");
        $rowInventory = mysqli_fetch_array($getProd);
        $quantity = $rowInventory["quantity"] ?? '';
        $price = $rowInventory["price"] ?? '';


           $output .= '  
                <tr>  
                <td scope="row" >'.$arr["name"].'</td>
                <td scope="row">'.$quantity.'</td>
                <td scope="row">₱ '.$price.'</td>
                <td> '.$arr["barcode"].'</td>
               
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

 
