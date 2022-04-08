
<?php 
 include('db.php');
                        if (isset($_POST['submit'])) {
                            $cart_id = $_SESSION['cart_id'];

                           
                                
                            $update = "UPDATE  cart set status ='CANCEL' WHERE id='$cart_id' ";
                            $results = mysqli_query($con, $update);
                             
                                   
                                    if ($results) {

                              
                                            header("Location: ../../store.php");
                                            $_SESSION['status'] ='';
                                            $_SESSION['cart_id']='';
                                       

                                       
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".msqli_error($con);
                                    }
                                //exit();
                                }
 ?>