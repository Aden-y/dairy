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
                    <div class="row">

                      <div class="form-group col-md-6 col-lg-6">
                        <label>Item name</label>
                        <div class="div">
                            <input type="text" name="name" id="name" required class="myinput">
                            <p id="namehelp" class="text-danger"></p>
                        </div>
                    </div>

                    <div class="form-group col-md-6 col-lg-6">
                        <label>Category</label>
                        <div class="div">
                            <input type="text" name="category" id="category" required class="myinput">
                            <p id="categoryhelp" class="text-danger"></p>
                        </div>
                    </div>

                    <div class="form-group col-12">
                        <label>Description</label>
                        <div class="div">
                            <textarea name="description" id="description" cols="30" rows="10" class="myinput">

                            </textarea>
                            <p id="descriptionhelp" class="text-danger"></p>
                        </div>
                    </div>

                    <div class="form-group col-md-4 col-lg-4">
                        <label>Display Picture</label>
                        <div class="div">
                            <input type="file" name="pic" id="pic" required class="myinput">
                            <p id="pichelp" class="text-danger"></p>
                        </div>
                    </div>

                    <div class="form-group col-md-4 col-lg-4">
                        <label>Unit Price (Ksh)</label>
                        <div class="div">
                            <input type="number" name="price" id="price" required class="myinput">
                            <p id="pricehelp" class="text-danger"></p>
                        </div>
                    </div>

                    <div class="form-group col-md-4 col-lg-4">
                        <label>Quantity</label>
                        <div class="div">
                            <input type="number" name="quantity" id="quantity" required class="myinput">
                            <p id="quantityhelp" class="text-danger"></p>
                        </div>
                    </div>

                    </div><!-- row -->

                   
                  
                       

                    <input type="submit" id="additembtn" name="additem" onclick="createItem()" value="Create Item" class="authbtn">
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
  <script src="./assets/js/CreateItem.js"></script>
 
</body>

</html>
