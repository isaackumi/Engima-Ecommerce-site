<?php
include('../includes/header.php'); 
include('../includes/navbar.php'); 
$x = dirname(__FILE__).'/../../controller/processing.php';
include($x);

?>


<?php

$obj = new Processing();


?>

<!-- ADD SHOP MODAL -->
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Shop</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="shop_form" autocomplete="off" onsubmit="return false" >
        <div class="modal-body">

          <!-- Vendor Name -->
            <div class="form-group">
                <label for="vendorid"> Vendor Name</label>
               <select class="form-control" name="vendor_id" id="vendor_id">
                 <option value="0">-- Vendor Name --</option>
                <?php echo($obj->vendorDropdown()); ?>
               </select>
              </div>

              
            <!-- Shop Name -->
            <div class="form-group">
                <label> Shop Name </label>
                <input type="text" name="shop_name" id="shop_name" class="form-control" placeholder="Enter Shop Name">
              </div>

              <!-- Shop Description -->
            <div class="form-group">
                <label>Shop Description</label>
                <input type="tetext" name="shop_desc" id="shop_desc" class="form-control" placeholder="Enter Shop">
              </div>


              <!-- Shop Address -->
            <div class="form-group">
                <label>Shop Address</label>
                <input type="textarea" name="shop_add" id="shop_add" class="form-control" placeholder="Enter Shop Address">
              </div> 


              <!-- Shop Image -->
              <div class="form-group">
                <label>Shop Image</label>
                <input type="text" name="shop_image" id="shop_image" class="form-control" placeholder="Enter Shop Image">
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
<!-- End of shop modal -->

<!-- End of Edit Modal -->






<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Shop Management 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Shop + 
            </button>
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="table-dark">
          <tr>
            <th> Shop Id</th>
            <th> Shop Name </th>
            <th>Shop Description </th>
            <th>Shop Address</th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody id="shopT">

     <!-- Shop Insertion  -->
          <tr>
          <?php echo($obj->shopTable()); ?>
          </tr>
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="../js/amain.js"></script>

 <!-- Datatables Js CDN -->
 <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 

<?php
include('../includes/scripts.php');
include('../includes/footer.php');
?>