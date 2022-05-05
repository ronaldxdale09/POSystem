
<?php 
 include('db.php');
                       
    $barcode = $_POST['barcode'];
    $cart_id = $_POST['cart_id'];
    $myJSON='';

   //  $getProdID = mysqli_query($con, "SELECT * FROM product WHERE barcode='$barcode'");
   //  $prod = mysqli_fetch_array($getProdID);
   //  $prod_id = $prod['id'];
    
    $checkCartList = mysqli_query($con, "SELECT * FROM cart_listing 
    LEFT JOIN product ON cart_listing.product = product.id 
    WHERE product.barcode='$barcode' AND cart_listing.cart = '$cart_id' ");
    $arr = mysqli_fetch_array($checkCartList);



  // Store it in a array
   $data[0] = $cart_id;
   $data[1] = $barcode;
   $data[2] = $arr['name'];
   $data[3] = $arr['quantity'];
   $data[4] = $arr['total_amount'];
   $data[5] = $arr['cashier_scan'];
   $data[6] = $arr['product'];



   header("Content-Type: application/json");

   $myJSON = json_encode($data);
   echo $myJSON;
   exit();
  
 ?>

