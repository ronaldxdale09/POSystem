<?php 
   include('include/header.php');
   

   
   ?>
<body>
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <!-- ============================================================== -->
   <!-- Preloader - style you can find in spinners.css -->
   <!-- ============================================================== -->
 
   <div class="page-wrapper">
   <div class="container-fluid">
      <!-- ============================================================== -->
      <!-- Sales chart -->
      <!-- ============================================================== -->
      <?php include('tab/tab.php')?>
     
   </div>
   
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
                interval = setInterval(() => barcode = '', 20);
            });
      
            function handleBarcode(scanned_barcode) {

               $('#new_product').modal('show');
               $('#inputed_barcode').val(scanned_barcode);
            }
   </script>
   <?php 
      include('include/navbar.php');
      include('include/footer.php');
      include('include/script.php');
      include('modal/modal.php'); ?>

      
<script>

function fetch_data()  
      {  
           $.ajax({  
                url:"function/prod_list.php",  
                method:"POST",  
                success:function(data){  
                     $('#live_data').html(data);  
                }  
           });  
      } 

      fetch_data()  
</script>

<script>
$(document).ready( function () {
    $('#table_prod').DataTable();
} );
</script>
