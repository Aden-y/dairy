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

        <fieldset>  
                  <legend>Personal details</legend>  
            <div class="row">
                  <div class="form-group col-lg-4 col-md-4">
                <label>First name</label>
                <div class="div">
                    <input id="firstname" type="text" name="firstname" required class="myinput">
                    <p id="firstnamehelp"  class="text-danger"></p>
                </div>
            </div>


            <div class="form-group col-lg-4 col-md-4">
                <label>Last name</label>
                <div>
                <input id="lastname"  type="text" name="lastname" required class="myinput">
                    <p id="lastnamehelp"  class="text-danger"></p>
                </div>
            </div>


            <div class="form-group col-lg-4 col-md-4">
                <label>National Id</label>
                <div>
                <input id="id"  type="number" name="id" required class="myinput">
                    <p id="idhelp"  class="text-danger"></p>
            </div>
            </div>

        </div>
        </fieldset>
          

            <fieldset>
                <legend>Contact information</legend>
                <div class="row">

                    <div class="form-group col-lg-6 col-md-6">
                    <label> Email</label>
                    <div>
                    <input id="email" type="email" name="email" required class="myinput">
                        <p id="emailhelp" class="text-danger"></p>
                    </div>
                    </div>


                    <div class="form-group col-lg-6 col-md-6">
                        <label>Phone</label>
                        <div>
                        <input id="phone"  type="text" name="phone" required class="myinput">
                            <p id="phonehelp"  class="text-danger"></p>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Address Information</legend>
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

                    <div class="form-group col-12">
                        <label>Exact place name or nearest landmark</label>
                        <div>
                        <input id="place"  type="text" name="place" required class="myinput">
                            <p id="placehelp" class="text-danger"></p>
                        </div>
                    </div>


                </div>
            </fieldset>

            



            <fieldset>
            <legend>Role</legend>
                <div class="form-group">
                
                <div>
                <select id="type"  name="type" class="myinput">
                    <option value="">---</option>
                    <option value="Farmer">I am a farmer</option>
                    <option value="Vet">I am a vet</option>
                    <option value="Agrovet">I own an agrovet</option>
                </select>
                    <p id="typehelp" class="text-danger"></p>
                </div>
            </div> 
            </fieldset> 


            <div style="display:none;" id="agrovetname">
          <fieldset>
                <legend>Name of your agrovet</legend>
                <div class="form-group">
                        <div>
                        <input id="agrovet"  type="text" name="agrovet"  class="myinput">
                            <p id="agrovethelp" class="text-danger"></p>
                        </div>
                    </div>
            </fieldset> 
          </div>


          <div style="display:none;" id="vetspecialization">
          <fieldset>
                <legend>Your area of specialization</legend>
                <div class="form-group">
                        <div>
                        <input id="specialization"  type="text" name="specialization"  class="myinput">
                            <p id="specializationhelp" class="text-danger"></p>
                        </div>
                    </div>
            </fieldset> 
          </div>

          
            <fieldset>
                <legend>Password</legend>
                <div class="row">
                    
                    <div class="form-group col-lg-6 col-md-6">
                        <label>Password</label>
                        <div>
                            <input id="password"  type="password" name="password" required class="myinput">
                            <p id="passwordhelp"  class="text-danger"></p>
                        </div>
                    </div>

                    <div class="form-group col-lg-6 col-md-6">
                        <label>Confirm Password</label>
                        <div>
                            <input id="conpassword"  type="password" name="conpassword" required class="myinput">
                            <p id="conpasswordhelp" class="text-danger"></p>
                        </div>
                    </div>
                </div>
            </fieldset>

          



          

          


            <input type="submit" id="registerbtn"  name="register" value="Register" class="authbtn">
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
  <script src="./assets/js/RegisterController.js"></script>
 
</body>

</html>
