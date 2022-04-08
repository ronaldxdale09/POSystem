
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

  <!-- jQuery 3 -->
    <script src="dist/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
    <script src="dist/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>



<?php if (isset($_SESSION['login'])): ?>
	<div class="msg">

  <script>

  Swal.fire(
    'Welcome!',
    'Login Successfully',
)
  </script>

  
		<?php 
			unset($_SESSION['login']);
		?>
	</div>
	<?php endif ?>




</html>


<?php if (isset($_SESSION['reg_success'])): ?>
	<div class="msg">

  <script>

Swal.fire(
  'Welcome, ' +'<?php echo $_SESSION['name']; ?>'+' !!',
  'Make sure you save your password :   '+'<?php echo $_SESSION['your_pass']; ?>',
  'success',
)
  </script>

  
		<?php 
			unset($_SESSION['reg_success']);
		?>
	</div>
	<?php endif ?>



  <!-- CONFIRM -->
<?php if (isset($_SESSION['confirm'])): ?>
	<div class="msg">

  <script>

Swal.fire(
  'Thank you : Cart ID : ' +'<?php echo $_SESSION['cart_id']; ?>'+'',
  'Please wait until the cashier confirm your cart! ',
  'success',
)
  </script>

  
		<?php 
			unset($_SESSION['confirm']);
		?>
	</div>
	<?php endif ?>


  <script>

$('#confirm_button').click(function()
{
  const isEmpty = document.querySelectorAll("#table-to-refresh tr").length <= 1;
      if( isEmpty == true) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Please scan a product first ',
        })
                
      }
      else{
        $('#confirm_table').modal('show'); 

      }
   
});
</script>


<!-- EDIT -->

<?php if (isset($_SESSION['edit_cart'])): ?>
	<div class="msg">

  <script>

  Swal.fire(
    'You can edit your cart Again!',
    ' Your Cart ID : ' +'<?php echo $_SESSION['cart_id']; ?>'+'',
)
  </script>

  
		<?php 
			unset($_SESSION['edit_cart']);
		?>
	</div>
	<?php endif ?>