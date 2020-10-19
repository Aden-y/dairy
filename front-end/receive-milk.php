<!DOCTYPE html>
<html lang="en">
<?php include_once('./inc/head.php')?>


<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Side Nav -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      <?php include_once('./inc/toolbar.php')?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
                  <div class="container">
                  <div id="servermessage">
                  </div>
                  <form  onsubmit="return false"
                        method="post" id="form">
                    <div class="row">

                      <div class="form-group col-md-6 col-lg-6">
                        <label>Farmer National ID</label>
                        <div class="div">
                            <input type="number" name="farmer_id" id="farmer_id" required class="myinput">
                            <p id="farmer_idhelp" class="text-danger"></p>
                        </div>
                    </div>

                    <div class="form-group col-md-6 col-lg-6">
                        <label>Quantity of milk</label>
                        <div class="div">
                            <input type="number" name="quantity" id="quantity" required class="myinput">
                            <p id="quantityhelp" class="text-danger"></p>
                        </div>
                    </div>

                 

                    </div><!-- row -->

                   
                  
                       

                    <input type="submit" id="additembtn" name="additem" onclick="receiveMilk()" value="Submit Collection" class="authbtn">
                </form>
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



  <?php include_once('./inc/scripts.php')?>
  <script src="./assets/js/ReceiveMilk.js"></script>
 
</body>

</html>
