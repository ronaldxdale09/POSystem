

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
                var desc = myObj[1];
                var price = myObj[2];
                var prod_img = myObj[3];

                if ( myObj[0] !='') {

                  var table = document.getElementsByTagName('table')[0];
                  var newRow = table.insertRow(table.rows.length/2+1);
                  // add cells to the row
                  var cel1 = newRow.insertCell(0);
                  var cel2 = newRow.insertCell(1);
                  var cel3 = newRow.insertCell(2);
                  var cel4 = newRow.insertCell(3);
                  
                  // add values to the cells
                 
                  var pruduct_name = 
                              `
                              <figure class="itemside align-items-center">
                                        <div class="aside"><img src="../product/${prod_img}" style="width:50px;height:50px" class="img-sm"></div>
                                        <figcaption class="info"> <a href="#" class="title text-dark" data-abc="true">${prod_name}</div></a>
                                            <p class="text-muted small">${desc} </p>
                                        </figcaption>
                                    </figure>
                                `;


                  var quantity = 
                              `
                              <select class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select> 
                                `; 

                  var priceStyle  = 
                              `
                              <div class="price-wrap"> <var class="price">₱ ${price}</var> <small class="text-muted">₱75.00 each </small> </div>
                                `;       

                  var remove  = 
                              `
                              <button type="button" class="btn btn-danger text-white" ><i class="fas fa-minus-circle"></i></button>
                                `;          


        
                  // ADD INTO TABLE
                  cel1.innerHTML =pruduct_name;
                  cel2.innerHTML = quantity;
                  cel3.innerHTML = priceStyle;
                  cel4.innerHTML = remove;
                } 
                  
                  

              }
          };

          // xhttp.open("GET", "filename", true);
          xmlhttp.open("GET", "function/fetchProduct.php?barcode="+str.replace(/,/g, ''), true);
            
          // Sends the request to the server
          xmlhttp.send();
   
  }
</script>
