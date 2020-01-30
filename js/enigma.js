var DOMAIN = "http://localhost/enigma";
$(document).ready(function(){


    $("#login_form").on("submit",function(){
        var errors = false;

        $('.errors').html('');
        var email = $("#log_email").val();
        var password = $("#log_pass").val();
       
        if(email == ""){
            errors = true;
            $('.errors').html("Please enter email");
        }
        if(password == ""){
            errors = true;
            $('.errors').html("Please enter password");
        }
        
        if(errors == true){
            return false;
        }

        if(errors == false){
            $.ajax({
            url: DOMAIN+"/controller/process.php",
            method: "POST",
            data: $("#login_form").serialize(),
               success: function(data){
                   console.log(data);

                if(data == "NOT_REGISTERED "){
                    $('.errors').html("Not Registered");
                    // window.location.href= encodeURI(DOMAIN+"/register.php");
                }
                else if(data == "PASSWORD_NOT_MATCHED"){
                    // window.location.href= encodeURI(DOMAIN+"/register.php");
                    window.alert("Incorrect Password");
                }
                else{
                    window.location.href= encodeURI(DOMAIN+"/index.php");
                }
                // else if(data == )
                // if(data == "NOT_REGISTERED"){
                //     window.alert("it seems like your email is already being in  used");
                // }else if (data == "PASSWORD_NOT_MATCHED"){
                //     window.alert("Incorrect Password");
                // }
                // else{
                //     window.location.href= encodeURI(DOMAIN+"/");
                // }
                // console.log(data);
            }
        })
            
        }
})


$("#register_form").on("submit",function(){
    var errors = false;

    $('.errors').html('');
    var cusname = $("#customer_fullname").val();
    var cusemail = $("#customer_email").val();
    var cuspassword = $("#customer_password1").val();
    var cuspassword2 = $("#customer_password2").val();
   
    if(cusname == ""){
        errors = true;
        $('.errors').html("Please enter name");
    }
    if(cusemail == ""){
        errors = true;
        $('.errors').html("Please enter email");
    }
    if(cuspassword == ""){
        errors = true;
        $('.errors').html("Please enter password");
    }
    if(cuspassword2 == ""){
        errors = true;
        $('.errors').html("Please enter Re-enter password");
    }
    
    if(errors == true){
        return false;
    }

    if(cuspassword === cuspassword2 && errors == false){
        $.ajax({
        url: DOMAIN+"/controller/process.php",
        method: "POST",
        data: $("#register_form").serialize(),
           success: function(data){
            $('.errors').html('');
               console.log(data);
            if(data == "REGISTRATION_SUCCESS"){
                window.location.href= encodeURI(DOMAIN+"/login.php");
            }else if (data == "EMAIL_ALREADY_EXISTS"){
                $('.errors').html("EMAIL_ALREADY_EXIST");
            }
            else{
                window.location.href= encodeURI(DOMAIN+"/login.php");
            }
            console.log(data);
        }
    })
        
    }else{
        errors = true;
        $('.errors').html("Password Mismatch");
    }
})














//    //Customer  Registration Validation and Processing 
//    $("#register_form").on("submit",function(){
//     var status = false;
//     var name = $("#customer_fullname");
//     var email = $("#customer_email");
//     var password = $("#customer_password1");
//     var password2 = $("#customer_password2");

//     var n_patt = new RegExp(/^[A-Za-z ]+$/);
//     var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-])*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);

//     // Name Validation 
//     if(name.val() == "" || name.val().length <= 3){
//         name.addClass("border-danger");
//         $("#fn_error").html("<span class='text-danger'>Please enter Name and Name should be 3 characters long </span>");
//         status = false;
//     }
//     else{
//         name.removeClass("border-danger");
//         $("#fn_error").html("");
//         status = true;
//     }

//     // Email Validation
//     if(!e_patt.test(email.val())){
//         email.addClass("border-danger");
//         $("#e_error").html("<span class='text-danger'>Please enter Valid Address</span>");
//         status = false;
//     }
//     else{
//         email.removeClass("border-danger");
//         $("#e_error").html("");
//         status = true;
//     }

//     // Password Validation 
//     if(password.val() == "" || password.val().length < 5){
//         password.addClass("border-danger");
//         $("#p1_error").html("<span class='text-danger'>Please enter more than 5 digit password</span>");
//         status = false;
//     }
//     else{
//         password.removeClass("border-danger");
//         $("#p1_error").html("");
//         status = true;
//     }


//     if(password2.val() == "" || password2.val().length < 5){
//         password2.addClass("border-danger");
//         $("#p2_error").html("<span class='text-danger'>Please enter more than 5 digit password</span>");
//         status = false;
//     }
//     else{
//         password2.removeClass("border-danger");
//         $("#p2_error").html("");
//         status = true;
//     }


//     // Password Match 
//     if(password.val() === password2.val() && status == true & password.val() !== "" && password2.val() !== ""){

//         // Transfer to process.php
//         $.ajax({
//             url: "http://localhost/enigma/controller/process.php",
//             method: "POST",
//             data: $("#register_form").serialize(),
//             success: function(data){
//                 // console.log('we move');
//                 // $(".overlay").hide();
//                 if(data == "EMAIL_ALREADY_EXISTS"){
//                     alert("it seems like your email is already in use");
//                 }else if (data == "SOME_ERROR"){
//                     alert("Something went wrong");
//                 }
//                 else{
//                     window.location.href= encodeURI(DOMAIN+"/page/login.php?msg=You are registered Now you can login");
//                 }

//             }
//         })
//     }
//     else{
//         password2.removeClass("border-danger");
//         $("#p2_error").html("<span class='text-danger'>Password mismatched</span>");
//         status = true;
//     }

// })



// // Customer Login 
// // User Login Validation  and Processing 
//      // Login Section 
//      $("#login_form").on("submit",function(){
//         var email = $("#log_email");
//         var pass = $("#log_pass");
//         var status = false;

//         // Email Validation 
//         if(email.val() == ""){
//             email.addClass("border-danger");
//             $("#e2_error").html("<span class='text-danger'>Please enter your email </span>");
//             status = false;
//         }else{
//             email.removeClass("border-danger");
//             $("#e2_error").html("");
//             status = true;
//         }

//         if(pass.val() == ""){
//             pass.addClass("border-danger");
//             $("#p3_error").html("<span class='text-danger'>Please enter your password </span>");
//             status = false;
//         }else{
//             pass.removeClass("border-danger");
//             $("#p3_error").html("");
//             status = true;
//         }
//         if(status){
//             // $(".overlay").show();
//             $.ajax({
//                 url: "http://localhost:8080/enigma/controller/process.php",
//                 method: "POST",
//                 data: $("#login_form").serialize(),
//                 success: function(data){
//                     if(data == "NOT_REGISTERED"){
//                         // $(".overlay").hide();
//                         email.addClass("border-danger");
//                         $("#e2_error").html("<span class='text-danger'>it seems like you are not registered</span>");
//                     }else if (data == "PASSWORD_NOT_MATCHED"){
//                         pass.addClass("border-danger");
//                         $("#p3_error").html("<span class='text-danger'>Password does not match</span>");
//                     } 
//                     else if(data == "LOGIN_SUCCESSFUL"){
//                        console.log(data);
//                        window.location.href="http://localhost:8080/enigma/page/empty.php";
//                     }

//                 }
//             })
//         }
//     })

    




    // Admin Section 

    // Registration Validation and Processing 
    $("#adminregister_form").on("submit",function(){ 
        var admin_status = false;
        var admin_name = $("#admin_fullname");
        var admin_email = $("#admin_email");
        var admin_pass = $("#admin_password1");
        var admin_pass2 = $("#admin_password2");
        var security_code = $("#admin_code");

        var n_patt = new RegExp(/^[A-Za-z ]+$/);
        var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-])*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);

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

        if(security_code.val()=="" || security_code.val().length<3){
            security_code.addClass("border-danger");
            $("#ac_error").html("<span class='text-danger'>Please enter more than 3 digit code </span>");
            admin_status = false;
        }
        else{
            security_code.removeClass("border-danger");
            $("#ac_error").html("");
            admin_status = true;
        }


        // Password Match 
        if(admin_pass.val() === admin_pass2.val() && admin_status == true & admin_pass.val() !== "" && admin_pass2.val() !== ""){

            // Transfer to process.php
            $.ajax({
                url: DOMAIN+"/functions/process.php",
                method: "POST",
                data: $("#adminregister_form").serialize(),
                success: function(data){
                    // $(".overlay").hide();
                    if(data == "EMAIL_ALREADY_EXISTS"){
                        alert("it seems like your email is already being in  used");
                    }else if (data == "SOME_ERROR"){
                        alert("Something went wrong");
                    }
                    else{
                        // window.location.href= encodeURI(DOMAIN+"/page/index.php?msg=You are registered Now you can login");
                    }

                }
            })
        }
        else{
            password2.removeClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>Password mismatched</span>");
            status = true;
        }        
    })


    // Admin Login Validation  and Processing 
     // Login Section 
     $("#adminlogin_form").on("submit",function(){
      
        var admin_email = $("#admin_email");
        var admin_pass = $("#admin_pass");
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

        if(admin_pass.val() == ""){
            admin_pass.addClass("border-danger");
            $("#p_error").html("<span class='text-danger'>Please enter your password </span>");
            status = false;
        }else{
            admin_pass.removeClass("border-danger");
            $("#p_error").html("");
            admin_status = true;
        }
        if(admin_status){
            // $(".overlay").show();
            $.ajax({
                url: DOMAIN+"/functions/process.php",
                method: "POST",
                data: $("#adminlogin_form").serialize(),
                success: function(data){
                    if(data == "NOT_REGISTERED"){
                        // $(".overlay").hide();
                        admin_email.addClass("border-danger");
                        $("#e_error").html("<span class='text-danger'>it seems like you are not registered</span>");
                    }else if (data == "PASSWORD_NOT_MATCHED"){
                        pass.addClass("border-danger");
                        $("#p_error").html("<span class='text-danger'>Password does not match</span>");
                    }
                    else{
                       console.log(data);
                    //    window.location.href= DOMAIN +"/page/home.php";
                    }

                }
            })
        }
    })



})
