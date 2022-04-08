
<?php 
 include('db.php');
                       
    $quantity = $_POST['quantity']; 
    $id = $_POST['id'];
    $prod = $_POST['product'];
  


        $getListing = mysqli_query($con, "SELECT * FROM inventory_listing WHERE product='$prod'");
        $rowList = mysqli_fetch_array($getListing);
        $price = $rowList['price'];

        $total = $price * $quantity;



        $update = "UPDATE  cart_listing set quantity ='$quantity', total_amount = '$total' WHERE  id='$id' ";
        $results = mysqli_query($con, $update);


    
    exit();
  
 ?>


