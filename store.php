<?php include ('function/db.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>STORE</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-12">
          <!-- <a class="hero-brand" href="index.html" title="Home"><img alt="Bell Logo" src="assets/img/logo.png"></a> -->
        </div>
      </div>

      <div class="col-md-12">
      <h3>
        WELCOME !
        <h3>
        <h1>
          <?php echo $_SESSION['store'];?>
        </h1>
        <p class="tagline">
        <?php echo $_SESSION['store_address'];?>
        </p>
 
        <button type='submit' class="btn btn-full scrollto" data-toggle="modal" data-target="#login" >Log-in</button>
        <button type='button'  class="btn btn-danger "  data-toggle="modal" data-target="#register" >Register</button>
 
      </div>
    </div>

  </section><!-- End Hero -->

<!-- MODAL -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
      <form action="function/new_cart.php" method="POST">

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" id="defaultForm-pass" name='password' class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type='submit' name='login' class="btn btn-default">Login</button>
</form>
      </div>
    </div>
  </div>
</div>

<!-- end modal -->





<!-- MODAL -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="function/registration.php" method="POST">
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
        <label data-error="wrong" data-success="right" for="defaultForm-email">Name</label>
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="text" id="name" name='name' class="form-control validate" require>
          
        </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Email</label>
          <input type="email" id="email" name='email' class="form-control validate" require>
         
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type='submit' name='reg' class="btn btn-default">Sign-up</button>
</form>
      </div>
    </div>
  </div>
</div>

<!-- end modal -->



  <!-- Vendor JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="assets/js/sweetalert2@11.js"></script>
  
</body>

</html>

<script>
   $('#myform').submit(function(){
    return false;
   });
    
   $('#confirmPurchase').click(function(){
   $("#confirmModal").modal("hide");
    $.post( 
    $('#myform').attr('action'),
   
    $('#myform :input').serializeArray(),
    function(result){
    $('#result').html(result);
    
    Swal.fire(
     'Good job!',
     'Transaction Was Successful',
     'success'
   )
   
    }
    );
   });
   
   // INPUT BOX VALIDATION
   
</script>