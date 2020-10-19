<!DOCTYPE html>
<html lang="en">
<?php include_once('./inc/head.php');
  if(!isset($_GET['vet'])) {
      echo '<script> alert("Please choose a vet to request appointment with"); window.location.href="./vets.php";</script>';
  }
?>



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

                    <input type="number" name="vet_id" value="<?php echo($_GET['vet'])?>" id="vet_id" hidden>

                    <div class="form-group col-12">
                        <label>Problem Category</label>
                        <div class="div">
                            <input type="text" name="category" id="category" required class="myinput">
                            <p id="categoryhelp" class="text-danger"></p>
                        </div>
                    </div>

                    <div class="form-group col-12">
                        <label>Problem Description</label>
                        <div class="div">
                            <textarea name="description" id="description" cols="30" rows="10" class="myinput">

                            </textarea>
                            <p id="descriptionhelp" class="text-danger"></p>
                        </div>
                    </div>

                   

                   

                    <div class="form-group col-12">
                        <label>Date</label>
                        <div class="div">
                            <input type="date" name="date" id="date" required class="myinput">
                            <p id="datehelp" class="text-danger"></p>
                        </div>
                    </div>

                    </div><!-- row -->

                   
                  
                       

                    <input type="submit" id="additembtn" name="additem" onclick="bookAppointment()" value="Submit Request" class="authbtn">
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
  <script src="./assets/js/FarmerAppointments.js"></script>
 
</body>

</html>
