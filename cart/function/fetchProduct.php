
<?php
include('db.php');
// Get the user id 
$barcode = $_REQUEST['barcode'];
  

if ($barcode !== "") {
      
    // Get the first name
    $getCode = mysqli_query($con, "SELECT * FROM product WHERE barcode='$barcode'");
    $rowProd = mysqli_fetch_array($getCode);
 

  
    // Get the first name
    $name = $rowProd["name"];
    $id = $rowProd['id'];

    $getListing = mysqli_query($con, "SELECT * FROM inventory_listing WHERE product='$id'");
    $rowList = mysqli_fetch_array($getListing);

    $price = $rowList['price'];

    // $product_id = $row["product_id"];
    // $name = $row["product_name"];
    // $description = $row["description"];
    // $price = $row["price"];
   
    
}

// Store it in a array
$result = ["$name","$id","$price"];

// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;





?>
