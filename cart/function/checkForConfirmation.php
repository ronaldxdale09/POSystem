
<?php 
 include('db.php');
                       
    $cart_id = $_SESSION['cart_id']; 

    $check = mysqli_query($con, "SELECT * FROM cart WHERE id='$cart_id'");
    $arrCheck = mysqli_fetch_array($check);

    if ($arrCheck['status'] == 'TRANSACTED'){
         $_SESSION['status'] = 'TRANSACTED';
        
    }
    elseif ($arrCheck['status'] == 'OPEN'){
   $_SESSION['status'] = 'OPEN';  
   }

   elseif ($arrCheck['status'] == 'CANCEL'){
      $_SESSION['status'] = 'CANCEL';  
      }
    echo $_SESSION['status'];
   
  
 ?>

