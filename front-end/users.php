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
          <h4>System Users</h4>
          <div class="text-right">
            <a href="./add-user.php" class="btn _btn-primary"><i class="fa fa-user-plus"></i>&nbsp;Add user</a>
          </div>
              <div class="mb-3">
                <form name="Userstodisplay">
                    <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="Employee" value="Employee">
                <label class="form-check-label" for="Employee">Employees</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="Farmer" value="Farmer">
                <label class="form-check-label" for="Farmer">Farmers</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="Vet" value="Vet">
                <label class="form-check-label" for="Vet">Vets</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="Agrovet" value="Agrovet">
                <label class="form-check-label" for="Agrovet">Agrovets</label>
              </div>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="Admin" value="Admin">
                <label class="form-check-label" for="Admin">Admin</label>
              </div>
                </form>
              </div>
              
              <div id="users">
                  <div class="text-center mt-5">Please choose users role.</div>
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
  <script src="assets/js/Users.js"></script>
 

 
</body>

</html>
