<?php
include('../includes/header.php'); 
include('../includes/navbar.php'); 
$x = dirname(__FILE__).'/../../controller/processing.php';
include($x);
?>
<?php

$obj = new Processing();


?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Vendor Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="vendor_form" autocomplete="off" onsubmit="return false">
        <div class="modal-body">

            <!-- Vendor Fullname -->
            <div class="form-group">
                <label> Vendor Fullname </label>
                <input type="text" name="vendor_name" id="vendor_name" class="form-control" placeholder="Enter Vendor Name">
                <small id="vn_error" class="form-text text-muted"></small>
              </div>

            <!-- Vendor Email -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="vendor_email" id="vendor_email" class="form-control" placeholder="Enter Email">
                <small id="ve_error" class="form-text text-muted"></small>
              </div>

              <!-- Vendor Phone  -->
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="vendor_phone" id="vendor_phone" class="form-control" placeholder="Enter phone">
                <small id="vp_error" class="form-text text-muted"></small>
              </div>

              <!-- Vendor Location  -->
            <div class="form-group">
                <label>Country</label>
                <input type="text" name="vendor_location" id="vendor_location" class="form-control" placeholder="Enter country">
                <small id="vl_error" class="form-text text-muted"></small>
              </div>

              <!-- Vendor City -->
            <div class="form-group">
                <label>City</label>
                <input type="text" name="vendor_city" id="vendor_city" class="form-control" placeholder="Enter city">
                <small id="vcy_error" class="form-text text-muted"></small>
              </div>

              
              <p class="errors" style="text-align:center; color:red;"></p>     
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit"  class="btn btn-primary">Save</button>
        </div>
      </form>
     

    </div>
  </div>
</div>


<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Vendor Management 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              New Vendor +
            </button>
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="table-dark">
          <tr>
            <th> ID </th>
            <th> Vendor Name </th>
            <th>Email </th>
            <th>Phone</th>
            <th>Location</th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>

        <!-- Shop Insertion  -->
        <tr>
          <?php echo($obj->vendorTable()); ?>
          </tr>
        
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="../js/amain.js"></script>

<?php
include('../includes/scripts.php');
include('../includes/footer.php');
?>