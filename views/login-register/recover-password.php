<?php
if(!isset($_SESSION)){
    session_start();
}
if (isset($_SESSION['mm'])){
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
        <div class="card card-outline card-primary" style="border-top: 3px solid #00c012;border-left: 4px solid #00c012;  ">
                <div class="card-header text-center">

            </div>
            <?php
            if(isset($_SESSION['errorMessageRecover'])){
                echo $_SESSION['errorMessageRecover'];
                unset($_SESSION['errorMessageRecover']);
            }
            ?>
            <div class="card-body">
                <img src="../../assets/img/FARMING%20LOGO.png " width="250" height="200" alt="Avatar" style="border-radius: 20px; margin-left: 30px">
                <form id="RecoverForm" action="../process/data-process.php" method="post">
                    <input type="hidden" name="email" value="<?php echo $_SESSION['mm']?>">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="text" name="otp" class="form-control" placeholder="OTP">
                    </div>
                    <div class="input-group mb-3">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="New Password">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" name="change_recover_password" style="background: #00c012;border: #00adc2;color: #ffffff;font-weight: bold" class="btn btn-primary btn-block"><i class="fa fa-key mr-2" aria-hidden="true"></i>Change password</button>
                        </div>
                    </div>
                </form>
                <p class="mt-3 mb-1">
                    <a href="login.php">Login</a>
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

        $("#RecoverForm").validate({
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
                password:{
                    required: "Please enter your password",
                    minlength:" Password should be above 5 characters"
                }
            }
        });


    </script>
    </body>
    </html>
    <?php
}
else{
    header("Location: login.php");
}
?>

