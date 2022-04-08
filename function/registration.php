
<?php 

require "PHPMailer/PHPMailerAutoload.php";

 include('db.php');
                        if (isset($_POST['reg'])) {
                            $date = date("Y-m-d H:i:s"); 
                            $name = $_POST['name'];
                            $email = $_POST['email'];

                            $bytes = random_bytes(2);
                            $password = strtoupper(bin2hex($bytes));

                                $query = "INSERT INTO customer (name,email,password,reg_date) 
                                        VALUES ('$name','$email','$password','$date')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                 

                                        // PHP MAILER START
                                        $phpmailer = new PHPMailer();

                                        try {
                                            //Server settings
                                         
                                            $phpmailer->isSMTP();
                                            $phpmailer->Host = 'smtp.gmail.com';
                                            $phpmailer->SMTPAuth = true;
                                            $phpmailer->Port = 587;
                                            $phpmailer->Username = 'testemailrandomidk@gmail.com';
                                            $phpmailer->Password = 'justrandompassword';
                              
                              
                                            $phpmailer->setFrom('testemailrandomidk@gmail.com', 'Store Management');
                                            $phpmailer->addAddress($email);
                              
                                  
                                            //Content
                                            $phpmailer->isHTML(true);                                  //Set email format to HTML
                                            $phpmailer->Subject = 'REGISTRATION SUCCESSFULLY'; 
                                            $phpmailer->Body    = "
                                       <center>
                                       <img src='' alt='header' border='0'>
                                            <h1>YOUR ACCOUNT HAS BEEN CREATED SUCCESSFULLY</h2>
                                      </center>
                               
                                
                                                <h2> YOUR PASSWORD: $password </h2>
                                           </p>
                                            
                                             
                                           ";
                                        
                              
                              
                              
                              
                                            $phpmailer->send();
                                           

                                        $status = 'OPEN';
                                        $date = date("Y-m-d H:i:s"); 
                                    
                        
                                        $new = "INSERT INTO cart (date_created,status) 
                                                VALUES ('$date','$status')";
                                        $cart = mysqli_query($con, $new);
                        
                        
                                        $last_id = $con->insert_id;
                                        $_SESSION['cart_id'] = $last_id;
                                        $_SESSION['status'] = $status;

                                        $_SESSION['reg_success']= "successful";
                                        $_SESSION['your_pass']= $password;
                                        $_SESSION['name']= $name;
                                        $_SESSION['customer_email']= $email;
                                        header("Location: ../cart/cart.php");
                                       

                                            
                                      
                                            
                                            
                                        } catch (Exception $e) {
                                            echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
                                        }
                              
                              
                                    
                                        //PHPMAILER END

                                       




                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".msqli_error($con);
                                    }
                                //exit();
                                }
 ?>