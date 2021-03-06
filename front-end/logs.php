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
          <h4>Transaction Logs</h4>
        
              <div id="logs">
                  
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



  <?php include_once('./inc/scripts.php');?>

  <?php if($_SESSION['role'] == 'Farmer') {?>
     <script src="assets/js/FarmerLogs.js"></script>

  <?php } else if($_SESSION['role'] == 'Admin') {?>
     <script src="assets/js/AdminLogs.js"></script>

  <?php  } ?>
 
 

 
</body>

</html>
