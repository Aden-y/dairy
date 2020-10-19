<!DOCTYPE html>
<html lang="en">
<?php include_once('./inc/head.php')?>


<body id="page-top">

  <!-- Page Wrapper -->
  <?php include_once('./inc/toolbar.php')?>
  <div id="wrapper">

    <!-- Side Nav -->
    <?php include_once('./inc/side.php')?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      

        <!-- Begin Page Content -->
        <div class="container-fluid">
        <div class="container">
            <div id="server-response">

            </div>
                  
        <form id="register-form" method="post" onsubmit="return false">

        
             <div class="form-group ">
                <label>Station Name</label>
                <div>
                <input id="name"  type="text" name="name" required class="myinput">
                    <p id="namehelp"  class="text-danger"></p>
                </div>
            </div>
          

            <fieldset>
                <legend>Location Information</legend>
                <div class="row">

                    <div class="form-group col-lg-4 col-md-4">
                        <label>County</label>
                        <div>

                        <input id="county"  type="text" name="county" required class="myinput">
                            <p  id="countyhelp" class="text-danger"></p>
                        </div>
                    </div>

                    <div class="form-group col-lg-4 col-md-4">
                        <label>Sub county</label>
                        <div>
                        <input id="subcounty"  type="text" name="subconty" required class="myinput">
                            <p  id="subcountyhelp" class="text-danger"></p>
                        </div>
                    </div>

                    <div class="form-group col-lg-4 col-md-4">
                        <label>Ward</label>
                        <div>
                        <input id="ward" type="text" name="ward" required class="myinput">
                            <p id="wardhelp" class="text-danger"></p>
                        </div>
                    </div>

                   


                </div>
            </fieldset>

             <div class="form-group ">
                <label>Unit price for milk collection</label>
                <div>
                <input id="unit_price"  type="text" name="unit_price" required class="myinput">
                    <p id="unit_pricehelp"  class="text-danger"></p>
                </div>
            </div>

            

            <input type="submit" id="registerbtn"  name="register" value="Register Station" class="authbtn">
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
  <script src="./assets/js/RegisterStationController.js"></script>
 
</body>

</html>
