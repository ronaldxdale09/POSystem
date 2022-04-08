
<?php 
 include('db.php');
                        if (isset($_POST['add'])) {
                            $barcode = $_POST['barcode'];
                            $name = $_POST['name'];
                            $quantity = $_POST['quantity'];
                            $price = $_POST['price'];
                            $store = $_SESSION['store_id'];

                                $query = "INSERT INTO product (name,barcode) 
                                        VALUES ('$name','$barcode')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        $product_id = $con->insert_id;
                                        $query = mysqli_query($con,"INSERT INTO inventory_listing (store,product,price,quantity)
                                        VALUES ('$store','$product_id','$price','$quantity')");



                                        header("Location: ../index.php");
                                        $_SESSION['new_prod']= "successful";
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".msqli_error($con);
                                    }
                                //exit();
                                }
 ?>