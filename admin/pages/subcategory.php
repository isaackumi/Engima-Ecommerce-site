   <!-- Sidebar -->
   <?php
    include('../includes/header.php'); 
    include('../includes/navbar.php'); 
    $x = dirname(__FILE__).'/../../controller/processing.php';
    include($x);
    ?>

<?php

$obj = new Processing();

?>


  <!-- Page Wrapper -->
  <div id="wrapper">

 
<!-- begininnig of adding new product -->
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Sub Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="subcat_form" autocomplete="off" onsubmit="return false">

        <div class="modal-body">
            <div class="form-group">
                <label>Sub Category</label>
                <input type="text" id="subcat_name" name="subcat_name" class="form-control" placeholder="eg. Raffia prints">
                <small id="scs_error" class="form-text text-muted"></small>
              </div>

              <p class="errors" style="text-align:center; color:red;"></p> 
        </div>
        <div class="modal-footer">
            <!-- onclick, clear item in the form and return to the main page -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!-- onclick save in database and display in the table -->
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- end of adding new product -->


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> Sub Category Management 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add +
            </button>
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="table-dark">
          <tr>
            <th> Subcategory ID</th>
            <th>Subcategory Name</th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>

    <!-- Sub category Insertion  -->
          <tr>
          <?php echo($obj->subcategoryTable()); ?>
          </tr>

        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="../js/amain.js"></script>

  <?php
include('../includes/scripts.php');
// include('../includes/footer.php');
?>
