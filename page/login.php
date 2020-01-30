<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">
</head>


<body>
 <div class = "login-page">
    <div class = "form">
        <form action="" class="register-form">
            <label for="title">Login</label>
            <input type="text" placeholder= "Email Address" name="email" id="email"> 
            <input type="text" placeholder = "Password" name="password" id="pss"> 

            <button>Login</button>  

            <p class="message">Not Registered? <a href="#">Register </a></p>
        </form>

        <form action="" class="register-page">
            <input type="text" placeholder= "Full Name*" name="fullname" id="fullname"> 
            <input type="text" placeholder = "Prefered Enigma Shop Name*" name="businessname" id="bssname"> 
            <input type="text" placeholder= "Email Address *" name="email" id="email"> 
            <input type="text" placeholder = "Retype Email Address*" name="retypeemail" id="retypeemail"> 
            <input type="text" placeholder= "Password *" name="pass" id="pass"> 
            <input type="text" placeholder = "Retype Password*" name="retypepass" id="retypepass"> 
            
            <button>Register</button>

            <p class="message">Already Registered? <a href="#">Login </a></p>




        </form>
        
    
    </div>
 
 
 </div>

 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

 <script>

     $('.message a').click(function(){
         $('form').animate({height: "toggle", opcaity: "toggle"}, "slow");
     });
 
 </script>
    
</body>
</html>