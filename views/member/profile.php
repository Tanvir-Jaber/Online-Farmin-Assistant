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
                        <h1>Profile</h1>
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
        <section class="content">
            <div class="container-fluid">
                <?php
                 if ($trueStatus){
                     ?>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="card card-primary card-outline">
                                 <div class="card-body box-profile">
                                     <div class="text-center">
                                         <?php
                                         if($trueStatus->image){
                                             ?>
                                             <img class="profile-user-img img-fluid img-circle"
                                                  src="<?php echo $trueStatus->image?>">
                                             <?php

                                         }else{
                                           ?>
                                             <img class="profile-user-img img-fluid img-circle"
                                                  src="../../assets/img/ok-2B.jpg">
                                             <?php
                                         }
                                         ?>

                                         <form action="../process/data-process.php" method="post" enctype="multipart/form-data" >
                                             <input type = 'hidden' name="id"  value="<?php echo $Meid?>">
                                             <input required type="file" name="photo" accept="image/x-png,image/gif,image/jpeg">

                                             <input style="color: " type="submit" class="btn btn-primary btn-round btn-outline-success w-70 mb-2"  name="Change_member_photo" value="Upload" >

                                         </form>
                                     </div>
                                     <?php $list = $dbmanipulate->showUserProfile($Meemail) ?>
                                     <h3 class="profile-username text-center"><?php echo $trueStatus->name ?></h3>
                                     <p class="text-muted text-center"><?php echo "<b>".$list->position. "</b><br> of Online Farming Assistant " ?></p>
                                     <div class="card card-primary">
                                         <div class="card-header">
                                             <h3 class="card-title">About Me</h3>
                                         </div>

                                         <?php
                                         if (isset($_SESSION["updateMsg"])){
                                             echo $_SESSION["updateMsg"];
                                             unset($_SESSION["updateMsg"]);
                                         }
                                         ?>
                                         <form action="../process/data-process.php" method="post">
                                             <div class="card-body">
                                                 <strong><i class="fas fa-book mr-1"></i> Name</strong>
                                                 <p class="text-muted">
                                                     <input name="name" value="<?php echo $trueStatus->name?>">
                                                     <input type="hidden" name="id" value="<?php echo $Meid?>">

                                                 </p>
                                                 <hr>
                                                 <strong><i class="fas fa-mail-bulk mr-1"></i> Email Address</strong>
                                                 <p class="text-muted">

                                                     <input name="email" value="<?php echo $Meemail?>">
                                                 </p>
                                                 <hr>
                                                 <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                                                 <p class="text-muted">
                                                     <textarea name="address" cols="30" rows="3"><?php echo $list->address?></textarea>

                                                 </p>


                                                 <hr>
                                                 <strong><i class="fas fa-phone-square-alt mr-1"></i>Phone Number</strong>
                                                 <p class="text-muted">
                                                     <input name="pnumber" value="<?php echo $list->pnumber?>">

                                                 </p>
                                                 <hr>
                                                 <strong><i class="far fa-file-alt mr-1"></i> Company Name</strong>
                                                 <p class="text-muted">
                                                     <input name="cname" value="<?php echo $list->cname?>">

                                                 </p>
                                                 <button style="color: black" class="btn btn-success  btn-outline-secondary " name="change_member_profile" >Update</button>

                                             </div>
                                         </form>

                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="card callout callout-danger card-outline card-danger">
                                 <div class="card-header p-2">
                                     <ul class="nav nav-pills">
                                         <li class="nav-item"><a style="text-decoration: none" class="nav-link active" href="#activity" data-toggle="tab">Change Password</a></li>
                                     </ul>
                                 </div>
                                 <div class="card-body">
                                     <div class="tab-content">
                                         <div class="active tab-pane" id="activity">
                                             <form id="UpdatePass" action="../process/data-process.php" method="post" class="form-horizontal">
                                                 <div class="form-group row">
                                                     <div class="col-sm-12 mb-2">
                                                         <input type="hidden" value="<?php echo $Meid?>" name="user_no">
                                                         <input type="password" class="form-control" name="password" id="password" placeholder="Create password">
                                                     </div>
                                                     <div class="col-sm-12">
                                                         <input type="password" class="form-control" name="repass" placeholder="Confirm password">
                                                     </div>
                                                 </div>
                                                 <div class="form-group row">
                                                     <div class="col-sm-12">
                                                         <button type="submit" name="change-pass" class="btn w-100 btn-danger">Submit</button>
                                                     </div>
                                                 </div>
                                             </form>
                                         </div>
                                     </div>
                                     <!-- /.tab-content -->
                                 </div><!-- /.card-body -->
                             </div>
                             <!-- /.card -->
                         </div>
                         <!-- /.col -->
                     </div>
                     <?php
                 }
                 else{
                     echo "<div class=\"alert alert-success alert-dismissible ml-1 mr-1\">
                  <h5><i class=\"icon fas fa-check\"></i> Opps!</h5>
                  Your account is not activated.
                </div>";
                 }
                ?>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
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
