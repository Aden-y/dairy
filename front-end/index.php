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
        <div style="text-align: center; color: white">
            <br> <br> <br> <br>
            <h1 style="color: white; font-weight: 800; ">Dairy Management System</h1>
            <br> <br>
            <p style="color: white; font-size: 25px">The best in providing farmers with ready market, connecting farmers with vets and the best agrovets</p>
        </div>
  <?php include_once('./inc/scripts.php')?>

</body>

</html>
