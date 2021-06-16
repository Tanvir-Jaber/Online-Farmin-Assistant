<?php
if(!isset($_SESSION)){
    session_start();
}
$Meid = $_SESSION ['Mid'];
$Mename = $_SESSION ['Mname'];
$Meemail = $_SESSION ['Memail'];
if (isset($_SESSION ['Mid']) && isset($_SESSION ['Mname']) && isset($_SESSION ['Memail']) ){

    include_once "BuyersHeader.php";
    $trueStatus = $dbmanipulate->singleUsers($Meid);
    ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contact Us</h1>
                    </div>
                </div>
            </div>
        </section>
        <?php
        if(isset($_SESSION['UpdateSuccessMessageForPassword'])){
            echo $_SESSION['UpdateSuccessMessageForPassword'];
            unset($_SESSION['UpdateSuccessMessageForPassword']);
        }
        ?>
        <div   class="content wow bounceInUp" data-wow-duration= "2s">
            <?php
            if (isset($_SESSION["SendMessage"])){
                echo $_SESSION["SendMessage"];
                unset($_SESSION["SendMessage"]);
            }
            ?>
            <br>
            <br>
            <div class="row">

                <div class="col-3">
                    <i class="fas fa-phone fa-2x"></i><span style="color: #344e86; font-size: 25px"> Phone:</span>
                    <p style="padding-left: 30px">+8801865-232773</p>
                    <br>
                    <i class="far fa-envelope fa-2x"></i><span style="color: #344e86; font-size: 25px"> Mail:</span>
                    <p style="padding-left: 30px">onlinefarmingassistant@gmail.com</p>
                    <br>
                    <i class="fas fa-map-marker-alt fa-2x"></i>
                    <span style="color: #344e86; font-size: 25px"> Address:</span>
                    <p style="padding-left: 30px"> Khulshi, Chittagong</p>



                </div>
                <div class="col-9" >
                    <div style="border-radius: 15px;margin-right: 20px; border: 3px solid;    margin-top: -20px; box-shadow: 5px 10px 10px 2px black" class="tab-pane ">
                        <form class="form-horizontal" action="../process/data-process.php" method="post">
                            <input class="user_id" name="user_id" type="hidden" value="<?php echo $Meid?>" >

                            <div style="padding: 10px" class="form-group row">
                                <div class="col-6">
                                    <label  ><strong  >Your Name:</strong></label>
                                    <div >
                                        <input type="text" disabled class="form-control" name="name" value="<?php echo $Mename?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label  ><strong  >Your Email:</strong></label>
                                    <div >
                                        <input type="email" disabled  class="form-control"  value="<?php echo $Meemail?>">
                                        <input type="hidden"  name="email" value="<?php echo $Meemail?>">
                                    </div>
                                </div>
                                <div class="col-6">

                                    <div >
                                        <br>
                                        <input required placeholder="Subject" class="form-control" name="subject" value="">
                                    </div>
                                </div>
                                <div class="col-6">

                                    <div >
                                        <br>
                                        <textarea required placeholder="Message" class="form-control " rows="10" name="mesaage" value=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button style="color: white" type="submit" class="btn btn-success  btn-outline-primary btn-round" name="send_message_to_adminBySeller" >Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <br>


        </div>
        <!-- /.content -->
    </div>
</div>
</body>
</html>
 <?php
    ?>
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../dist/js/bappi.min.js"></script>
    <script src="../../dist/js/demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
    <script>
        $("#UpdatePass").validate({
            rules:{
                password:{
                    required: true,
                    minlength:6
                },
                repass:{
                    required: true,
                    minlength:6,
                    equalTo:"#password"
                }
            },

            messages:{
                password:{
                    required: "Please provide a strong password",
                    minlength:" Password should be above 5 characters "
                },
                repass:{
                    required: "Please provide a confirm password",
                    minlength:"Password should be above 5 characters ",
                    equalTo:"Confirm Password Should be same to Password"
                }
            }
        });


    </script>
    <?php
}
else{
    header("Location: ../login-register/login.php");
}
?>
