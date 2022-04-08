
<?php 
 include('db.php');
                       
    $cart_id = $_SESSION['cart_id']; 
    $product_id = $_POST['id'];
    $quantity = 1;
    $item_price = $_POST['price'];

    // check if the product is in cart already

    $check = mysqli_query($con, "SELECT * FROM cart_listing WHERE  product='$product_id' AND cart='$cart_id'");
    $arrCheck = mysqli_fetch_array($check);

    if($check->num_rows == 1) {
        $quantity = $arrCheck['quantity'];
        $amount = $arrCheck['total_amount'];

        $quantity += 1;
        $amount += $item_price;

        $update = "UPDATE  cart_listing set quantity ='$quantity', total_amount = '$amount' WHERE  product='$product_id' AND cart='$cart_id' ";
        $results = mysqli_query($con, $update);



        }

        else{

        $query = "INSERT INTO cart_listing (cart,product,quantity,total_amount) 
                VALUES ('$cart_id','$product_id','$quantity','$item_price')";
        $results = mysqli_query($con, $query);

    }
    exit();
  
 ?>