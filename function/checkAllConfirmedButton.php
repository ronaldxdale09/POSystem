
<?php 
 include('db.php');
                       
    $cart_id = $_POST['cart_id'];

    $countItemCart = mysqli_query($con, "SELECT COUNT(*) FROM cart_listing WHERE cart = '$cart_id'  ");
    $arr = mysqli_fetch_array($countItemCart);

    $checkForConfirmed = mysqli_query($con, "SELECT COUNT(*) FROM cart_listing WHERE cart = '$cart_id' AND  cashier_scan ='1' ");
    $row = mysqli_fetch_array($checkForConfirmed);


    if ($arr[0] == $row[0]){
        $data = 1;

    }
    else{
        $data = 0;
    }
    

   echo $data;
   exit();
  
 ?>

