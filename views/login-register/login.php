<?php
if(!isset($_SESSION)){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Online Farming Assistant</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../../dist/css/bappi.min.css">
  <style>
     .error{
       color: #e80000;
       display: table;
       border-collapse: collapse;
       width:100%;
       margin: 0px;

     }
    .input-group-text{
      width: 42px;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card callout callout-info" style="border-top: 3px solid #00c012;border-left: 4px solid #00c012;  ">
    <div class="card-header text-center">
        <img src="../../assets/img/FARMING%20LOGO.png " width="250" height="200" alt="Avatar" style="border-radius: 20px">

    </div>
      <?php
      if(isset($_SESSION['errorMessageSignin'])){
          echo $_SESSION['errorMessageSignin'];
          unset($_SESSION['errorMessageSignin']);
      }
      ?>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form autocomplete="off" id="loginForm" action="../process/data-process.php" method="post">
        <div class="input-group mb-2">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="input-group mb-2">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-lock"></span>
            </div>
          </div>
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="signin" style="background: #00c012;border: #00adc2;color: #ffffff;font-weight: bold" class="btn btn-block"><i class="fa fa-sign-language mr-2" aria-hidden="true"></i>Sign In</button>
          </div>
        </div>
      </form>
      <p class="mb-1">
        <a href="forgot-password.php">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
  </div>
</div>
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/bappi.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>

<script>
    jQuery.validator.addMethod("email", function (value, element) {
        if ( /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value)) {
            return true;
        } else {
            return false;
        };
    }, "Please enter a valid email address");

    $("#loginForm").validate({
        rules:{
            email:{
                required: true,
                email:true
            },
            password:{
                required: true,
                minlength:6
            },
        },

        messages:{
            email: {
                required: "Please enter your email address "
            },

            password:{
                required: "Please enter your password",
                minlength:" Password should be above 5 characters"
            }
        }
    });


</script>
</body>
</html>
