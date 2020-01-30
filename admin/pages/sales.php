<?php
include('../includes/header.php'); 
include('../includes/navbar.php'); 
?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Sales Overview</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">

            
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (November)</div>
              <!-- insert php to print out items in the cart -->
              <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

        <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">

            
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (11-24<sup>th</sup> November)</div>
              <!-- insert php to print out items in the cart -->
              <div class="h5 mb-0 font-weight-bold text-gray-800">$2500</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Sales Breakdown 
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Product Name </th>
            <th> Vendor Name </th>
            <th>Quantity (unit) </th>
            <th>Price/unit ($)</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>

     <!-- insert php here to ensure data is being printed from the database -->
          <tr>
            <td> Dashiki Skirt</td>
            <td> Fash Forward</td>
            <td> 40</td>
            <td> 29</td>
            <td> 1160</td>
    <!-- end of inserting php here to ensure data is being printed from the database  --> 
          </tr>

               <!-- insert php here to ensure data is being printed from the database -->
        <tr>
                <td> Bentua</td>
                <td> Soreno Couture</td>
                <td> 29</td>
                <td> 14</td>
                <td> 78</td>            
        <!-- end of inserting php here to ensure data is being printed from the database  -->
        </tr>
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>

<!-- extra cards -->

<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">

            
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Sales(qty)</div>
              <!-- insert php to print out items in the cart -->
              <div class="h5 mb-0 font-weight-bold text-gray-800">69units</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

        <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">

            
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Best Selling</div>
              <!-- insert php to print out items in the cart -->
              <div class="h5 mb-0 font-weight-bold text-gray-800">Dashiki Skirt</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
</div>





  <?php
include('../includes/scripts.php');
include('../includes/footer.php');
?>