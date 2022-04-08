<?php 
   require "PHPMailer/PHPMailerAutoload.php";
   include('db.php');
   
   
   
       if (isset($_POST['submit'])) {
       $email= $_SESSION['customer_email'];
       $cart_id = $_SESSION['cart_id'];
       $output = '';  
       $sql  = "SELECT * from cart_listing where cart='$cart_id'"; 

       $total_price_cart = mysqli_query($con, "SELECT SUM(total_amount) as total
       FROM cart_listing WHERE cart='$cart_id'"); 
       $total= mysqli_fetch_array($total_price_cart);
   
   
       
    $result = mysqli_query($con, $sql);  
    $output .= '  
         <center><h2>Receipt :</h2> <center>
         <hr> <br>
       <table class="table  table-shopping-cart"  id="table-to-refresh">
       <thead class="text-muted">
           <tr class="small text-uppercase">
           <th scope="col">Product</th>
           <th scope="col" width="180">Quantity</th>
           <th scope="col" width="180">Price</th>
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
                   <td scope="row">'.$arr['quantity'].'</td>
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
 
                        <dt>Total price:</dt>
                        <dd class="text-right ml-3">₱  '.round($total['total'], 2).' </dd>
                    <hr>
                     <dl class="dlist-align">
                        <dt>Discount:</dt>
                        <dd class="text-right text-danger ml-3">- ₱ 0.00</dd>
                     </dl>

                     <dl class="dlist-align">
                        <dt>Total:</dt>
                        <dd class="text-right text-dark b ml-3"><strong>₱   '.round($total['total'], 2).'?></strong></dd>
                     </dl>
                  
   
         </div>';  
    echo $output;  
   
   
   
                     
        // PHP MAILER START
           $phpmailer = new PHPMailer();
           try {
           //Server settings
           $phpmailer->isSMTP();
           $phpmailer->Host = 'smtp.gmail.com';
           $phpmailer->SMTPAuth = true;
           $phpmailer->Port = 587;
           $phpmailer->Username = 'testemailrandomidk@gmail.com';
           $phpmailer->Password = 'justrandompassword';
           $phpmailer->setFrom('testemailrandomidk@gmail.com', 'Store Management');
           $phpmailer->addAddress($email);
           //Content
           $phpmailer->isHTML(true);                                  //Set email format to HTML
           $phpmailer->Subject = 'Store Receipt '; 
           $phpmailer->Body    = $output;
   
           $phpmailer->send();                           
              
           header("Location: ../../store.php");
          
   
               
         
               
               
           } catch (Exception $e) {
               echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
           }
                                      
      
                                            
                   
                     
       }
      ?>