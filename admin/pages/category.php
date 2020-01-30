
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
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <form  id="category_form" autocomplete="off" onsubmit="return false">
        <div class="modal-body">

            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="cat_name"  id="cat_name" class="form-control" placeholder="eg.Shoes..">
              </div>
              <div class="form-group">
                <label>Category Image</label>
                <input type="text" name="cat_image"  id="cat_image" class="form-control" placeholder="eg.url..">
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
<!-- end of adding new product -->


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> Category Management 
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
             <th> Category Id </th>
            <th>Category</th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead class="table-dark">
        <tbody>
          <!-- Shop Insertion  -->
          <tr>
          <?php echo($obj->categoryTable()); ?>
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


