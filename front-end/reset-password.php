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
                    <?php
                    $mysqli = new mysqli("localhost","root","","dairy");
                    if (isset($_POST['email'])) {
                        $email = $_POST['email'];
                        $query =  "select * from users where email = '".$email."'";
                        $result = $mysqli -> query($query);
                        if ($row = $result->fetch_assoc()) {
                            //print_r($row);
                            echo '<p>Code sent to your email</p>
                                        <a href="reset-password.php">Go to reset page </a>';
                            exit();
                        }

                    }
                    ?>
                    <form  method="post"  action="reset-password.php">
                        <fieldset>
                            <legend>Reset Code</legend>
                            <div class="row">
                                <div class="form-group col-12">
                                    <div class="div">
                                        <input type="number" name="code" id="code" required class="myinput">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Password</legend>
                            <div class="row">
                                <div class="form-group col-12">
                                    <div class="div">
                                        <input type="password" name="password" id="password" required class="myinput">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Confirm Password </legend>
                            <div class="row">
                                <div class="form-group col-12">
                                    <div class="div">
                                        <input type="password" name="confirm-password" id="confirm-password" required class="myinput">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <input type="submit" id="loginbtn" name="reset_password" value="Update Your Password" class="authbtn">
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

</body>

</html>
