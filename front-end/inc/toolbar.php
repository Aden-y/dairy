<?php session_start()?>
<nav class="navbar navbar-expand   topbar mb-4 static-top shadow">
<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
  <i class="fa fa-bars"></i>
</button>
<span class="title d-none d-lg-inline">Dairy Management</span>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">
<?php if(isset($_SESSION['token'])) { 
  ?>
<li class="nav-item mr-2">
  <a class="nav-link" href="dashboard.php"><i class="fa fa-home"></i><span class="ml-2 d-none d-lg-inline">Home</span> </a>
</li>
  <?php
  if($_SESSION['role'] == 'Farmer') {?>
  <li class="nav-item mr-2">
   <a class="nav-link" href="agrovets.php"><i class="fa fa-shopping-cart"></i><span class="ml-2 d-none d-lg-inline">Agrovet Stores</span> </a>
  </li>

  <li class="nav-item mr-2">
  <a class="nav-link" href="vets.php"><i class="fas fa-syringe"></i><span class="ml-2 d-none d-lg-inline">Vets</span> </a>
  </li>

  <li class="nav-item mr-2">
  <a class="nav-link" href="stations.php"><i class="fas fa-thumbtack"></i><span class="ml-2 d-none d-lg-inline">Collection Stations</span> </a>
  </li>

  <li class="nav-item mr-2">
  <a class="nav-link" href="appointments.php"><i class="far fa-calendar-alt"></i><span class="ml-2 d-none d-lg-inline">Vet Appointments</span> </a>
  </li>
  <?php } else if($_SESSION['role'] == 'Admin'){ ?>
    <li class="nav-item mr-2">
    <a class="nav-link" href="users.php"><i class="fa fa-users"></i><span class="ml-2 d-none d-lg-inline">Users</span> </a>
  </li>

  <li class="nav-item mr-2">
  <a class="nav-link" href="stations.php"><i class="fas fa-thumbtack"></i><span class="ml-2 d-none d-lg-inline">Collection Stations</span> </a>
  </li>
 <?php } else if($_SESSION['role'] == 'Agrovet'){?>
  <li class="nav-item mr-2">
   <a class="nav-link" href="my-store.php"><i class="fa fa-shopping-cart"></i><span class="ml-2 d-none d-lg-inline">My Agro vet</span> </a>
  </li>

  <?php } else if($_SESSION['role'] == 'Employee'){ ?>
  <li class="nav-item mr-2">
   <a class="nav-link" href="receive-milk.php"><i class="fas fa-receipt"></i><span class="ml-2 d-none d-lg-inline">Receive Milk</span> </a>
  </li>

  <?php } else if($_SESSION['role'] == 'Vet'){ ?>
  <li class="nav-item mr-2">
   <a class="nav-link" href="appointments.php"><i class="far fa-calendar-alt"></i><span class="ml-2 d-none d-lg-inline">Appointments</span> </a>
  </li>

 <?php } ?>

  <!-- Nav Item - User Information -->
  <div class="topbar-divider d-none d-sm-block"></div>
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="mr-2 d-none d-lg-inline"><?php echo($_SESSION['name'])?></span>
      <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="#">
        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
        Profile
      </a>
      <a class="dropdown-item" href="#">
        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
        Settings
      </a>
      
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#" id="logoutbtn">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
      </a>
    </div>
  </li>

 <?php } else {?>
  <li class="nav-item mr-2">
  <a class="nav-link" href="index.php"><i class="fa fa-home"></i><span class="ml-2 d-none d-lg-inline">Home</span> </a>
  </li>

<li class="nav-item  mr-2">
  <a class="nav-link" href="login.php"><i class="fa fa-user"></i><span class="ml-2 d-none d-lg-inline">Login</span> </a>
</li>

<li class="nav-item mr-2">
  <a class="nav-link" href="register.php"><i class="fa fa-user-plus"></i><span class="ml-2 d-none d-lg-inline">Register</span> </a>
</li>

<li class="nav-item  mr-2">
  <a class="nav-link" href="about.php"><i class="fa fa-info"></i><span class="ml-2 d-none d-lg-inline">About</span> </a>
</li>

<li class="nav-item  mr-2">
  <a class="nav-link" href="help.php"><i class="fa fa-question"></i><span class="ml-2 d-none d-lg-inline">Help</span> </a>
</li>

  <?php }?>
</ul>
</nav>
<!-- End of Topbar -->
