
<?php 
 include('db.php');
                        if (isset($_POST['submit'])) {
                            $cart_id = $_SESSION['cart_id'];

                           
                                
                            $update = "UPDATE  cart set status ='CONFIRMED' WHERE id='$cart_id' ";
                            $results = mysqli_query($con, $update);
                             
                                   
                                    if ($results) {

                              
                                            header("Location: ../confirmed.php");
                                            $_SESSION['status'] ='CONFIRMED';
                                            $_SESSION['confirm'] = 'success';
                                       

                                       
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".msqli_error($con);
                                    }
                                //exit();
                                }
 ?>