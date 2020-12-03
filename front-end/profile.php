


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

            <?php
                include_once('./inc/toolbar.php');
            $mysqli = new mysqli("localhost","root","","dairy");
                //print_r($_SESSION);
            if (isset($_POST['change_password'])) {
                $query =  "update users set password  = '".$_POST['password']."' where id = ".$_SESSION['id'];
                $result = $mysqli -> query($query);
            }
            $mysqli->close();

            ?>


            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="container">
                    <h3>Update Profile</h3>
                     <br>
                    <h6>Logged in as :</h6>
                    <p class="text-primary"><?php echo $_SESSION['name']?></p>
                    <h6>Logged in as :</h6>
                    <p class="text-primary"><?php echo $_SESSION['role']?></p>

                    <h4>Change Password</h4>

                    <form method="post" action="profile.php" onsubmit="return validate(this)">
                        <div>
                            <label>Enter New Password</label>
                            <br>
                            <input type="password" required  name="password">

                        </div>

                        <div>
                            <label>Confirm New Password</label>
                            <br>
                            <input type="password" required  name="con_password">

                        </div>
                        <br>
                        <input type="submit" name="change_password" value="Change Password" class="btn _btn-primary">
                    </form>
                    <script>
                        const reg = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
                        function validate(form) {
                            var res =  reg.test(form.password.value) && form.password.value == form.con_password.value;
                            if (!res) {
                                alert('Make sure that the password is strong enough and matches')
                            }
                            return res;
                        }

                    </script>
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
