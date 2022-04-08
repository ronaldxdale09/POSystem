
<?php 
 include('db.php');
                       
    $id = $_POST['id'];
  

        $delete = "DELETE  FROM cart_listing WHERE  id='$id' ";
        $results = mysqli_query($con, $delete);


    
    exit();
  
 ?>


