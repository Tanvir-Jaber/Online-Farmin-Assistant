<?php
if(!isset($_SESSION)){
    session_start();
}
$Adid = $_SESSION ['Aid'];
$Adname = $_SESSION ['Aname'];
$Ademail = $_SESSION ['Aemail'];
if (isset($_SESSION ['Aid']) && isset($_SESSION ['Aname']) && isset($_SESSION ['Aemail']) ){
    include_once "AdminHeader.php";
    ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add New Admin</h1>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if(isset($_SESSION['CreateSuccessMessageForNewAdmin'])){
            echo $_SESSION['CreateSuccessMessageForNewAdmin'];
            unset($_SESSION['CreateSuccessMessageForNewAdmin']);
        }
        ?>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-warning card-outline">
                            <div class="card-body box-profile">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">New Admin</h3>
                                    </div>
                                    <form action="../process/data-process.php" method="post">
                                        <div class="card-body">
                                            <strong><i class="fas fa-book mr-1"></i>Full Name</strong>
                                            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                                            <hr>
                                            <strong><i class="fas fa-mail-bulk mr-1"></i> Email Address</strong>
                                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                                            <hr>
                                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                                            <input type="text" name="address" class="form-control" placeholder="Address" required>
                                            <hr>
                                            <strong><i class="fas fa-phone-square-alt mr-1"></i>Phone Number</strong>
                                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                                            <hr>
                                            <strong><i class="fas fa-user-lock mr-1"></i>Password</strong>
                                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                                            <hr
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" name="newAdmin" style="background: #00adc2;border: #00adc2;color: #ffffff;font-weight: bold" class="btn btn-block"><i class="fa fa-sign-language mr-2" aria-hidden="true"></i>Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
    </div>
    <?php
    include_once "AdminFooter.php";
}
else{
    header("Location: ../login-register/login.php");
}
?>



