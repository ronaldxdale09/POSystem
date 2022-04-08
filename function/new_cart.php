

<?php
    require('db.php');
    // When form submitted, check and create user session.
    if (isset($_POST['login'])) {
        $password = stripslashes($_POST['password']);

        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `customer` WHERE password='$password'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        if ($rows == 1) {

            if ($row['type'] == 'staff'){

                header("Location: ../reg_prod/index.php");
                $_SESSION['login']= "successful";
                $_SESSION['staff_name']= $row['name'];

            }
            else{
            $status = 'OPEN';
            $date = date("Y-m-d H:i:s"); 

                $new = "INSERT INTO cart (date_created,status) 
                        VALUES ('$date','$status')";
                $cart = mysqli_query($con, $new);


                $last_id = $con->insert_id;
                $_SESSION['cart_id'] = $last_id;
                $_SESSION['status'] = $status;
                $_SESSION['customer_email'] = $row['email'];
                
                header("Location: ../cart/cart.php");
                $_SESSION['login']= "successful";
            }


        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='../index.php'>Login</a> again.</p>
                  </div>";
        }
    }
?>