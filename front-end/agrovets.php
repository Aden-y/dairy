<!DOCTYPE html>
<html lang="en">
<?php include_once('./inc/head.php')?>


<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper" style="background: inherited;">

    <!-- Side Nav -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column"style="background: inherited;">

      <!-- Main Content -->
      <div id="content">

      <?php include_once('./inc/toolbar.php')?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
        
      <div>
            <div>
            <h4>Find Agrovet Products</h4>
                <div class="text-right mb-2">
                    <button class="btn _btn-primary" onclick="showCart()" data-toggle="modal" data-target="#cartDetails"  >
                        <i class="fa fa-cart"></i>
                        Cart
                    </button>
                </div>

                  <div>
                      <div  class="row">
                          <table>
                              <tr>
                                  <th>Name</th>
                                  <th>Description</th>
                                  <th>Price</th>
                                  <th>Add To Cart</th>
                              </tr>
                              <tbody id="agrovets" >

                              </tbody>
                          </table>

                     </div>
              </div>
              
            </div>
      </div>
      <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>



      <div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="addToCartLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Add item to cart</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div>
                          <input type="number" id="_p" hidden>
                          <input type="text" id="_n" hidden>
                          <input type="number" id="_id" hidden>
                          <label>Quantity</label>
                          <div>
                              <input id="_q" type="number" min="1" style="border: 1px solid black; width: 100%; padding: 5px 10px;" value="1">
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" id="_dismiss" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-sm _btn-primary" onclick="_addToCart()">Add</button>
                  </div>
              </div>
          </div>
      </div>




      <div class="modal fade" id="cartDetails" tabindex="-1" role="dialog" aria-labelledby="cartDetails" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Cart Details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body" id="_cart">

                  </div>
                  <div class="modal-footer">
                      <button type="button" id="__dismiss" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-sm _btn-primary" onclick="submitOrder()">Place Order</button>
                  </div>
              </div>
          </div>
      </div>



  <?php include_once('./inc/scripts.php');?>
  <script src="assets/js/Agrovets.js"></script>
 

 
</body>

</html>
