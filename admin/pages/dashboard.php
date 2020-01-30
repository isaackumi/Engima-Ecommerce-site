<?php
include('../includes/header.php'); 
include('../includes/navbar.php'); 
$x = dirname(__FILE__).'/../../controller/processing.php';
include($x);

// session_start();
?>

<!-- <?php
// session_start();
// if(!($_SESSION["admin_id"])){
//   header("Location: http://localhost/enigma/admin/pages/dashboard.php");
// }


?> -->


<?php

$obj = new Processing();


?>




<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!--Total Registered Vendors -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Vendors</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

              <!-- insert php to show the number of users logged in-->
               <h4> Total Vendors: </h4>
               <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo($obj->vendorCount()); ?></div>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-black-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
     <!-- End of Total Registered Vendors -->


     <!--Total Shop Vendors -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Shop</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

              <!-- insert php to show the number of users logged in-->
               <h4>Total Shop: </h4>
               <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo($obj->shopCount()); ?></div>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-black-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
     <!-- End of Total  Category -->

     <!--Total Shop Vendors -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">General Category Added:</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

              <!-- insert php to show the number of users logged in-->
               <h4>Total Category</h4>
               <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo($obj->catCount()); ?></div>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-info"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
     <!-- End of Total Category -->


      <!--Total Products Vendors -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">General Products Added:</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

              <!-- insert php to show the number of users logged in-->
               <h4>Total Products</h4>
               <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo($obj->prodCount()); ?></div>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-black-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
     <!-- End of Total Products Vendors -->

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">

            
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Registered Shops</div>
              <!-- insert php to print out items in the cart -->
              <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-danger"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->








  <?php
include('../includes/scripts.php');
include('../includes/footer.php');
?>