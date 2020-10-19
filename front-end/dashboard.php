<!DOCTYPE html>
<html lang="en">
<?php include_once('./inc/head.php')?>


<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper" style="background-color: inherited;">

    <!-- Side Nav -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column"style="background: inherited;">

      <!-- Main Content -->
      <div id="content">

      <?php include_once('./inc/toolbar.php')?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
        <?php 
          if($_SESSION['role'] == 'Admin') {
            include_once('./inc/admin-dashboard.php');
          }else if( $_SESSION['role'] == 'Employee') {
            include_once('./inc/employee-dashboard.php');
          }else if( $_SESSION['role'] == 'Vet') {
            include_once('./inc/vet-dashboard.php');
          }else if( $_SESSION['role'] == 'Agrovet') {
            include_once('./inc/agrovet-dashboard.php');
          }else if( $_SESSION['role'] == 'Farmer') {
            include_once('./inc/farmer-dashboard.php');
          }
        ?>
      <div>
           <?php  if($_SESSION['role'] == 'Farmer'){?>       
            <div>
              <h4>My Submissions</h4>
              <table id="my-submissions">
                
              </table>
            </div>

            <!-- Admin  -->
            <?php } else if ($_SESSION['role'] == 'Admin'){?>
              <div>
              <h4>Milk Collections</h4>
              <table id="all-submissions">
                
              </table>
            </div>
           

              <!-- Employee -->
            <?php } else if ($_SESSION['role'] == 'Employee'){?>
              <div>
              <h4> Station Milk Collections</h4>
              <div class="text-right">
                    <a class="btn _btn-primary" href="./receive-milk.php">
                    <i class="fas fa-receipt"></i>&nbsp;
                        Receive Milk
                    </a>
              </div>
              <table id="station-submissions">
                
              </table>
            </div>
            <?php } else if($_SESSION['role'] == 'Vet') {?>
              <h4> Pending Requests</h4>
              <table id="pending-appointments">

              </table>
           <?php } else if($_SESSION['role'] == 'Agrovet') {?>
               <h4>Active Orders</h4>
               <table id="active-orders">

               </table>
           <?php } ?>
            
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



  <?php include_once('./inc/scripts.php');
  if($_SESSION['role'] == 'Farmer') {
  ?>
  <script src="assets/js/dashboards/FarmerDashboard.js"></script>
  <?php }else if($_SESSION['role'] == 'Vet') {?>
    <script src="assets/js/dashboards/VetDashboard.js"></script>
      <div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModal" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Give Feedback</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <input type="number" id="_id" hidden>
                    <textarea id="_d" hidden>

                    </textarea>
                      <div class="form-group">
                        <p>Describe the solution</p>
                          <textarea style="width: 100%; height: 150px; border: 1px solid black; padding: 2px;" id="_f">

                          </textarea>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" id="_dismiss" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" onclick="submitFeedback()" class="btn _btn-primary btn-sm">Submit</button>
                  </div>
              </div>
          </div>
      </div>
  <?php } else if ($_SESSION['role'] == 'Admin'){?>
      <script src="assets/js/dashboards/AdminDashboard.js"></script>
  <?php } else if ($_SESSION['role'] == 'Employee'){?>
      <script src="assets/js/dashboards/EmployeeDashboard.js"></script>
  <?php } else if ($_SESSION['role'] == 'Agrovet'){?>
      <script src="assets/js/dashboards/AgrovetDashboard.js"></script>
  <?php } ?>
 
</body>

</html>
