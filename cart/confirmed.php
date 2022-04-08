<?php 
    include('include/header.php');
  
    ?>
<body>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- ============================================================== -->
    <div class="page-wrapper">
    <div class="container-fluid">
        <!-- ============================================================== -->
    
       
        <?php include('tab/cart_confirmed.php')?>
 <!-- ============================================================== -->

 <a href="#" class="change"   data-toggle="modal" data-target="#edit_cart"  >
      <i class="fa fa-edit my-float"></i>
      </a>
    </div>
    <?php 
      include('include/footer.php');
      include('include/script.php');
      include('modal/modal.php'); ?>



    <script>
     
        
        
        function fetch_data()  
        {  
             $.ajax({  
                  url:"function/customer_cart_confirmed.php",  
                  method:"POST",  
                  success:function(data){  
                       $('#live_data').html(data);  
                  }  
             });  
        } 
        fetch_data();
        
        function checkIfTransacted()  
        {  
             $.ajax({  
                  url:"function/checkForConfirmation.php",  
                  method:"POST",  
                  success:function(data){  
                    var status = data;
                    status = status.replace(/[^a-zA-Z ]/g, "");
                    if ( status == 'TRANSACTED'){
                       $('#transacted_modal').modal('show');
                    }
                   
                    
                  }  
             });  
        } 
        
        
        setInterval(function(){
           checkIfTransacted();
        },2000);
        
    </script>