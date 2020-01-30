<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enigma.</title>
     <!-- BootStrap Link -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <!-- Custom Stylesheet -->
     <link rel="stylesheet" href="css/index.css">
     <!-- Fontawesome Link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
</head>
<body>


<!-- Alert Section  -->
<?php
if(isset($_GET["msg"]) && !empty($_GET["msg"])){
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <?php echo($_GET["msg"]);?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php
}
?>
<!-- End of alert section -->

<div id="log-body">
<div class="card mb-3" >
  <div class="row no-gutters">
    <!-- Image Slide Section  -->
    <div class="col-md-4">
    <div id="image-sec">
        <div class="text-center  ">
        <img src="https://images.pexels.com/photos/794064/pexels-photo-794064.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" class="border border-warning  rounded-circle" alt="Register Logo">
        </div>
    </div>
    </div>
    <!-- End of Image Slider -->

    <div class="col-md-8">
      <div class="card-body">
        <div id="plogo-con" class="d-flex justify-content-center">
                    <div class="row">
                        <div class="col-lg col-md ">
                            <h2 id="plogo">Enigma <span >.</span></h2>
                            <p> If you can't stop thinking about it .. <b>BUY IT</b></p>
                        </div>
                    </div>
        </div>

        
        <!-- Admin Login Form  -->
        <form id="admin_login_form" onsubmit="return false" autocomplete="off">
               
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="admin_log_email" name="admin_log_email" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="e_error" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="admin_log_pass" name="admin_log_pass" placeholder="Password">
                        <small id="p_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Security Code</label>
                        <input type="text" class="form-control" id="admin_log_code" name="admin_log_code" placeholder="Security Code">
                        <small id="sc_error" class="form-text text-muted"></small>
                    </div>
                   
                    
                    <button type="submit" class="btn-lg btn-outline-secondary"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;Login</button>
                <a href="register.php">Register</a>
                </form>
            <!-- End of Admin Login Form -->
        
      </div>
    </div>
  </div>
</div>
</div>


    
    


    <!-- Bootstrap & Jquery Script -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   
   <!-- Custom Js Script -->
   
   <script src="js/amain.js"></script>
</body>
</html>