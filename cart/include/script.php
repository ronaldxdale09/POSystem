


<script>
  
  // onkeyup event will occur when the user 
  // release the key and calls the function
  // assigned to this event
  function getProd(str) {

          // Creates a new XMLHttpRequest object
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function () {

              // Defines a function to be called when
              // the readyState property changess
              if (this.readyState == 4 && 
                      this.status == 200) {
                    
                  // Typical action to be performed
                  // when the document is ready
                  var myObj = JSON.parse(this.responseText);


                var prod_name = myObj[0];
                var product_id = myObj[1];
                var item_price = myObj[2];
              

                if (myObj[0] !='') {

                  $.ajax({
                    type: "POST",
                    url: "function/insertProd.php",
                    data: {
                        id: product_id,
                        price: item_price,
                    },
                    cache: false,
                    success: function(data) {
                      fetch_data();
                      $( "#cart_card_table" ).load( "cart.php #cart_card_table" );
                      $( "#confirm_total_price" ).load( "cart.php #confirm_total_price" );
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                });


                };
     
                  
                  

              }
          };

          // xhttp.open("GET", "filename", true);
          xmlhttp.open("GET", "function/fetchProduct.php?barcode="+str.replace(/,/g, ''), true);
            
          // Sends the request to the server
          xmlhttp.send();
   
  }
</script>



