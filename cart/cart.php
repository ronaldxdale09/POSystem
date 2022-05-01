<?php 
    include('include/header.php');
    ?>
<body style='background-color:#e9f2f9;'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- ============================================================== -->
    <div class="page-wrapper" style='background-color:#e9f2f9;'>
    <div class="container-fluid" style='width:70%;'>
        <!-- ============================================================== -->
    
       
        <?php include('tab/cart.php')?>
 <!-- ============================================================== -->

      <a href="#" class="confirm"  id='confirm_button' >
      <i class="fa fa-check my-float"></i>
      </a>
      <a href="#" class="cancel"  data-toggle="modal" data-target="#cancel_cart" >
      <i class="fa fa-times my-float"></i>
      </a>
    </div>
    <?php 
      include('include/navbar.php');
      include('include/footer.php');
      include('include/script.php');
      include('modal/modal.php'); ?>



    <script>
        var barcode = '';
              var interval;
              document.addEventListener('keydown', function(evt) {
                  if (interval)
                      clearInterval(interval);
                  if (evt.code == 'Enter') {
                      if (barcode)
                          handleBarcode(barcode);
                      barcode = '';
                      return;
                  }
                  if (evt.key != 'Shift')
                      barcode += evt.key;
                  interval = setInterval(() => barcode = '', 100);
              });
        
              function handleBarcode(scanned_barcode) {
                 getProd(scanned_barcode)
              }
        
        
        function fetch_data()  
        {  
             $.ajax({  
                  url:"function/customer_cart.php",  
                  method:"POST",  
                  success:function(data){  
                       $('#live_data').html(data);  
                  }  
             });  
        } 
        fetch_data();
        
    
    </script>