<!DOCTYPE html>
<html lang="en">
<?php include_once('./inc/head.php');
  if(isset($_SESSION['token'])) {
    echo '<script>window.location = "./dashboard.php"</script>';
    exit();
  }
?>


<body id="page-top" class="home-body">

  <!-- Page Wrapper -->
  <?php include_once('./inc/toolbar.php')?>
  <div id="wrapper">

    <!-- Side Nav -->
    
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      <!-- Toolbar origin -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
         

        

    
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

</body>

</html>
