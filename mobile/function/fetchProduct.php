<?php
include('db.php');
// Get the user id 
$barcode = $_REQUEST['barcode'];
  

if ($barcode !== "") {
      
    // Get the first name
    $query = mysqli_query($con, "SELECT * FROM product WHERE product_code='$barcode'");
  
    $row = mysqli_fetch_array($query);

    // Get the first name
    $product_img = $row["product_img"];
    $product_id = $row["product_id"];
    $name = $row["product_name"];
    $description = $row["description"];
    $price = $row["price"];
}
  
// Store it in a array
$result = ["$name","$description","$price","$product_img"];
  
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>

