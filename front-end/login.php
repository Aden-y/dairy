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
                        method="post">

                <fieldset>  
                          <legend>Email Address</legend>  
                    <div class="row">
                          <div class="form-group col-12">
                        <div class="div">
                            <input type="email" name="email" id="email" required class="myinput">
                            <p id="emailhelp" class="text-danger"></p>
                        </div>
                    </div>
                    </div>
                    </fieldset>
                    <fieldset>
                        <legend>Password</legend>
                        <div class="row">
                            <div class="form-group col-12">
                                <div>
                                    <input type="password" id="password" name="password" required class="myinput">
                                    <p id="passwordhelp" class="text-danger"></p>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <input type="submit" id="loginbtn" name="login" value="Login" class="authbtn">
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
  <script src="./assets/js/LoginController.js"></script>
 
</body>

</html>
