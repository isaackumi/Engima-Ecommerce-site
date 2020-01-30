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

    <!-- Sidebar -->
    

<!-- begininnig of adding new product -->
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form id="product_form" autocomplete="off" onsubmit="return false">

        <div class="modal-body">

        <!-- Category Name -->
        <div class="form-group">
        <label> Category Name</label>
               <select class="form-control" name="icati" id="icatid">
                 <option value="0">-- Category Name --</option>
                <?php echo($obj->categoryDropdown()); ?>
               </select>
              
            </div>
            <!-- End of Subcategory -->



      <!-- Subcategory Name -->
        <div class="form-group">
        <label > Subcategory Name</label>
               <select class="form-control" name="subcatna" id="subcatid">
                 <option value="0">-- Subcategory Name --</option>
                <?php echo($obj->subcatDropdown()); ?>
               </select>
                
            </div>
            <!-- End of Subcategory -->


            <!-- Shop Name -->
            <div class="form-group">
        <label> Shop Name</label>
               <select class="form-control" name="shpi" id="shpid">
                 <option value="0">-- Shop Name --</option>
                <?php echo($obj->shopDropdown()); ?>
               </select>
              
            </div>
            <!-- End of shop name -->

            <div class="form-group">
                <label> Product Name </label>
                <input type="text" name="product_na" id="product_name" class="form-control" placeholder="eg. Fashforward">
              </div>

            <div class="form-group">
                <label> Product Price </label>
                <input type="number" name="product_pr" id="product_price" class="form-control" placeholder="eg.100, 100.20">
              
              </div>
            <div class="form-group">
                <label> Product Quantity</label>
                <input type="number" name="product_qt" id="product_qty"  class="form-control" placeholder="eg.100">
              </div>

            <div class="form-group">
                <label>Product Color</label>
                <input type="text" name="product_co" id="product_color" class="form-control" placeholder="eg.Dashiki Skirt">
              </div>

            <div class="form-group">
                <label>Product Description</label>
                <input type="text" name="product_de" id="product_desc" class="form-control" placeholder="eg.Dashiki Skirt">
               </div>
            
            <div class="form-group">
                <label>Tags</label>
                <input type="text"  id="product_ta" name="product_tags" class="form-control" placeholder="eg. Raffia prints">
              </div>

            <div class="form-group">
                <label >Insert mainimg link</label>
                <input type="text" name="product_i" id="product_img" class="form-control">
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
    <h6 class="m-0 font-weight-bold text-primary">Product Management 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add +
            </button>
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered"  width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Product Id </th>
            <th> Product Title</th>
            <th>Product price</th>
            <th>Quantity</th>
            <th>Color</th>
            <th>Product Tags</th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
         <!-- Product Insertion  -->
         <tr>
          <?php echo($obj->productTable()); ?>
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
