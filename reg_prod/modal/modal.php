<!-- BARCODE -->
<div class="modal fade" id="new_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">NEW PRODUCT</h5>
         <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">
         <form action="function/insertProd.php" method="POST">
            <!-- ... START -->
            <center>
           
               <div class="form-group">
                  <label class="col-md-12">CODE</label>
                  <div class="col-md-8">
                     <input type="text" id='inputed_barcode' name='barcode'
                        class="form-control form-control-line" >
                  </div>
                  <br>
            </center>
            <!--  -->
            <div class="form-group">
                           <div class="row no-gutters">
                              <div class="col-12 col-sm-12 col-md-12">
                                 
                                 <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>Product Name</span>
                                    </div>
                                    <input type="text" style='text-align:left' name='name'  class="form-control" >   
                                 </div>
                               
                              </div>
                           </div>
                        </div>
                    <!--  -->

             <!--  -->
             <div class="form-group">
                           <div class="row no-gutters">
                              <div class="col-12 col-sm-12 col-md-12">
                                 
                                 <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>Quantity</span>
                                    </div>
                                    <input type="number" style='text-align:left' name='quantity' class="form-control" >   
                                 </div>
                               
                              </div>
                           </div>
                        </div>
                    <!--  -->

             <!--  -->
             <div class="form-group">
                           <div class="row no-gutters">
                              <div class="col-12 col-sm-12 col-md-12">
                                 
                                 <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>Price</span>
                                    </div>
                                    <input type="number" style='text-align:left' name='price' class="form-control" >   
                                 </div>
                               
                              </div>
                           </div>
                        </div>
                    <!--  -->


            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" name='add' class="btn btn-success text-white">Submit</button>
         </form>
         </div>
      </div>
   </div>
</div>
</div>
<!-- END -->



<!-- logout -->
<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <form action="function/logout.php" method="POST">
      <div class="modal-header"><h4>Logout <i class="fa fa-lock"></i></h4></div>
      <div class="modal-body"><i class="fa fa-question-circle"></i> Are you sure you want to log-off?</div>
      <div class="modal-footer">
      <button type="submit"  class="btn btn-success text-white">Logout</button>
      </div>
</form>
    </div>
  </div>
</div>