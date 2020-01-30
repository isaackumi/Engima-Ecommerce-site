var DOMAIN = "http://localhost/enigma";
$(document).ready(function(){
    // $("#shopT").DataTable();
     // Admin Section 

    // Registration Validation and Processing 
    $("#adminregister_form").on("submit",function(){ 
        var admin_status = false;
        var admin_name = $("#admin_fullname");
        var admin_email = $("#admin_email");
        var admin_pass = $("#admin_password1");
        var admin_pass2 = $("#admin_password2");
        var security_code = $("#security_code");

        var n_patt = new RegExp(/^[A-Za-z ]+$/);
        var e_patt = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;

        // Name Validation 
        if(admin_name.val() == "" || admin_name.val().length <= 3){
            admin_name.addClass("border-danger");
            $("#afn_error").html("<span class='text-danger'>Please enter Name and Name should be 3 characters long </span>");
            admin_status = false;
        }
        else{
            admin_name.removeClass("border-danger");
            $("#afn_error").html("");
            admin_status = true;
        }

        // Email Validation
        if(!e_patt.test(admin_email.val())){
            admin_email.addClass("border-danger");
            $("#ae_error").html("<span class='text-danger'>Please enter Valid Address</span>");
            admin_status = false;
        }
        else{
            admin_email.removeClass("border-danger");
            $("#ae_error").html("");
            admin_status = true;
        }

        // Password Validation 
        if(admin_pass.val() == "" || admin_pass.val().length < 5){
            admin_pass.addClass("border-danger");
            $("#ap1_error").html("<span class='text-danger'>Please enter more than 5 digit password</span>");
            admin_status = false;
        }
        else{
            admin_pass.removeClass("border-danger");
            $("#ap1_error").html("");
            admin_status = true;
        }


         // Password Validation 
        if(admin_pass2.val() == "" || admin_pass2.val().length < 5){
            admin_pass2.addClass("border-danger");
            $("#ap2_error").html("<span class='text-danger'>Please enter more than 5 digit password</span>");
            admin_status = false;
        }
        else{
            admin_pass2.removeClass("border-danger");
            $("#ap2_error").html("");
            admin_status = true;
        }

         // Security Code Validation 
        if(security_code.val()=="" || security_code.val().length<3){
            security_code.addClass("border-danger");
            $("#asc2_error").html("<span class='text-danger'>Please enter more than 3 digit code </span>");
            admin_status = false;
        }
        else{
            security_code.removeClass("border-danger");
            $("#asc2_error").html("");
            admin_status = true;
        }


        // Password Match 
        if(admin_pass.val() === admin_pass2.val() && admin_status == true & admin_pass.val() !== "" && admin_pass2.val() !== ""){

            // Transfer to process.php
            $.ajax({
                url: "http://localhost/enigma/controller/process.php",
                method: "POST",
                data: $("#adminregister_form").serialize(),
                success: function(data){
                    console.log("we move");
                    if(data == "ADMINSTRATOR_ALREADY_EXISTS"){
                        alert("it seems like your email is already being in  used");
                    }else if (data == "SOME_ERROR"){
                        alert("Something went wrong");
                    }
                    else{
                        // window.location.href= encodeURI(DOMAIN+"/admin/index.php?msg=You are registered Now you can login");
                    }

                }
            })
        }
        else{
            admin_pass2.removeClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>Password mismatched</span>");
            status = true;
        }
        
        

    })


    // // Admin Login Validation  and Processing 
    //  // Login Section 
     $("#admin_login_form").on("submit",function(){
      
        var admin_email = $("#admin_log_email");
        var admin_pass = $("#admin_log_pass");
        var admin_code = $("#admin_log_code");
        var admin_status = false;

        // Email Validation 
        if(admin_email.val() == ""){
            admin_email.addClass("border-danger");
            $("#e_error").html("<span class='text-danger'>Please enter your email </span>");
            admin_status = false;
        }else{
            admin_email.removeClass("border-danger");
            $("#e_error").html("");
            admin_status = true;
        }


        // Password Validation 
        if(admin_pass.val() == ""){
            admin_pass.addClass("border-danger");
            $("#p_error").html("<span class='text-danger'>Please enter your password </span>");
            status = false;
        }else{
            admin_pass.removeClass("border-danger");
            $("#p_error").html("");
            admin_status = true;
        }


        // Security Code Validation 
        if(admin_code.val() == ""){
            admin_code.addClass("border-danger");
            $("#sc_error").html("<span class='text-danger'>Please enter your security code</span>");
            status = false;
        }else{
            admin_pass.removeClass("border-danger");
            $("#sc_error").html("");
            admin_status = true;
        }


        if(admin_status){
            
            $.ajax({
                url: "http://localhost/enigma/controller/process.php",
                method: "POST",
                data: $("#admin_login_form").serialize(),
                success: function(data){
                    if(data == "NOT_REGISTERED"){
                        admin_email.addClass("border-danger");
                        $("#e_error").html("<span class='text-danger'>it seems like you are not registered</span>");
                    }else if(data == "PASSWORD_NOT_MATCHED"){
                        pass.addClass("border-danger");
                        $("#p_error").html("<span class='text-danger'>Password does not match</span>");
                    }
                    else{
                       console.log(data);
                        window.location.href= DOMAIN +"/admin/pages/dashboard.php";
                       
                   
                    }

                }
            })
        }
    })


    // Shop Validation
    $("#shop_form").on("submit",function(){
            var errors = false;

            $('.errors').html('');
            var vendorid = $("#vendor_id").val();
            var shopname = $("#shop_name").val();
            var shopdesc = $("#shop_desc").val();
            var shopadd = $("#shop_add").val();
            var shop_logo = $("#shop_image").val();

            if(shop_logo == ""){
               errors = true; 
               $('.errors').html("Sorry Shop Image not entered!");
            }

            if(shopadd == ""){
                errors = true;
                $('.errors').html("Please enter the shop address");
            }
            if(shopdesc == ""){
                errors = true;
                $('.errors').html("Please enter the shop description");
            }
            if(shopname == ""){
                errors = true;
                $('.errors').html("Please enter the shop name");
            }
            if(vendorid == "0"){
                errors = true;
                $('.errors').html("Please select a vendor");
            }

            if(errors == true){
                return false;
            }

            if(errors == false){
                $.ajax({
                url: DOMAIN+"/controller/process.php",
                method: "POST",
                data: $("#shop_form").serialize(),
                   success: function(data){
                    if(data == "SHOP_CREATED"){
                        alert("it seems like your email is already being in  used");
                    }else if (data == "SOME_ERROR"){
                        alert("Something went wrong");
                    }
                    else{
                        window.location.href= encodeURI(DOMAIN+"/admin/pages/shop.php");
                    }
                    console.log(data);
                }
            })
                
            }
    })



    // Vendor Validation
    $("#vendor_form").on("submit",function(){
        var errors = false;

        $('.errors').html('');
        var vendorname = $("#vendor_name").val();
        var vendoremail = $("#vendor_email").val();
        var vendorphone = $("#vendor_phone").val();
        var vendorlocate = $("#vendor_location").val();
        var vendorcity = $("#vendor_city").val();

        if(vendorcity == ""){
           errors = true; 
           $('.errors').html("Please enter the vendor city !");
        }

        if(vendorlocate == ""){
            errors = true;
            $('.errors').html("Please enter the vendor country");
        }
        if(vendorphone == "" && vendorphone.length < 10){
            errors = true;
            $('.errors').html("Please enter a valid number");
        }
        if(vendoremail == ""){
            errors = true;
            $('.errors').html("Please enter the vendor email");
        }
        if(vendorname == ""){
            errors = true;
            $('.errors').html("Please enter a vendor name");
        }

        if(errors == true){
            return false;
        }

        if(errors == false){
            $.ajax({
            url: DOMAIN+"/controller/process.php",
            method: "POST",
            data: $("#vendor_form").serialize(),
               success: function(data){
                   console.log(data);
                if(data == "VENDOR_ALREADY_EXISTS"){
                    alert("it seems like your email is already being in  used");
                }else if (data == "SOME_ERROR"){
                    alert("Something went wrong");
                }
                else{
                    window.location.href= encodeURI(DOMAIN+"/admin/pages/vendor-register.php");
                }
                console.log(data);
            }
        })
            
        }
})


// Category Form
$("#category_form").on("submit",function(){
    var errors = false;

    $('.errors').html('');
    var categoryname = $("#cat_name").val();
    var categoryimg = $("#cat_image").val();
    

    if(categoryname == ""){
       errors = true; 
       $('.errors').html("Please enter the category name !");
    }
    if(categoryimg == ""){
        errors = true; 
        $('.errors').html("Please add the category link!");
     }

    if(errors == true){
        return false;
    }

    if(errors == false){
        $.ajax({
        url: DOMAIN+"/controller/process.php",
        method: "POST",
        data: $("#category_form").serialize(),
           success: function(data){
            if(data == "SUCCESS"){
                alert("category already inserted");
            }else if (data == "SOME_ERROR"){
                alert("Something went wrong");
            }
            else{
                window.location.href= encodeURI(DOMAIN+"/admin/pages/category.php");
            }
            console.log(data);
        }
    })
        
    }
})

// Subcategory Form
$("#subcat_form").on("submit",function(){
    var errors = false;

    $('.errors').html('');
    var subcategoryname = $("#subcat_name").val();

    if(subcategoryname == ""){
       errors = true; 
       $('.errors').html("Please enter the subcategory name !");
    }
    
    if(errors == true){
        return false;
    }

    if(errors == false){
        $.ajax({
        url: DOMAIN+"/controller/process.php",
        method: "POST",
        data: $("#subcat_form").serialize(),
           success: function(data){
            if(data == "SUCCESS"){
                alert("category already inserted");
            }else if (data == "SOME_ERROR"){
                alert("Something went wrong");
            }
            else{
                window.location.href= encodeURI(DOMAIN+"/admin/pages/subcategory.php");
            }
            console.log(data);
        }
    })
        
    }
})


$("#shopdel_btn").click(function(){
    window.location.href= encodeURI(DOMAIN+"/admin/pages/shop.php");
})


//Product Form
$("#product_form").on("submit",function(){
    var errors = false;

    $('.errors').html('');
    var cat_name= $("#icatid").val();
    var shop_name= $("#shpid").val();
    var subcat_name= $("#subcatid").val()
    var productname = $("#product_name").val();
    var productqty = $("#product_qty").val();
    var productprice = $("#product_price").val();
    var productcolor = $("#product_color").val();
    var productdesc = $("#product_desc").val();
    var producttags = $("#product_tags").val();
    var productimg = $("#product_img").val();

    if(productimg == ""){
       errors = true; 
       $('.errors').html("Please add the product url !");
    }
    if(producttags == ""){
        errors = true; 
        $('.errors').html("Please enter the product tags. {eg.new,shoes} !");
     }
     if(productdesc == ""){
        errors = true; 
        $('.errors').html("Please add the product description!");
     }
     if(productcolor == ""){
        errors = true; 
        $('.errors').html("Please enter the product color!");
     }
     if(productprice == ""){
        errors = true; 
        $('.errors').html("Please enter the product price!");
     }
     if(productqty == ""){
        errors = true; 
        $('.errors').html("Please enter the product quantity!");
     }
     if(productname == ""){
        errors = true; 
        $('.errors').html("Please enter the product name! . eg {Dashiki Long sleeve}");
     }
     if(subcat_name == "0"){
        errors = true; 
        $('.errors').html("Please select a subcategory!");
     }
     if(shop_name == "0"){
        errors = true; 
        $('.errors').html("Please select a shop name!");
     }
     if(cat_name == "0"){
        errors = true; 
        $('.errors').html("Please select a category name!");
     }

    if(errors == true){
        return false;
    }

    if(errors == false){
        $.ajax({
        url: DOMAIN+"/controller/process.php",
        method: "POST",
        data: $("#product_form").serialize(),
           success: function(data){
               console.log(data);
            if(data == "ALREADY_INSERTED"){
                window.alert("product already inserted");
            }else if (data == "SOME_ERROR"){
                window.alert("Something went wrong");
            }
            else{
                window.location.href= encodeURI(DOMAIN+"/admin/pages/inventory.php");
            }
            console.log(data);
        }
    })
        
    }
})




})