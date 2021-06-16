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
                        <h1 class="m-0 text-dark">Home</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">মোট সদস্য</span>
                                <span class="info-box-number"> <?php
                                    $list = $dbmanipulate->SearchVia();
                                    $count = 0;
                                    if ($list){
                                        foreach ($list as $value){
                                            $count++;
                                        }
                                        echo $count;
                                    }
                                    ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">মোট পোস্ট</span>
                                <span class="info-box-number"><?php
                                    $list = $dbmanipulate->viewAllPostForAdmin();
                                    $count = 0;
                                    if ($list){
                                        foreach ($list as $value){
                                            $count++;
                                        }
                                        echo $count;
                                    }
                                    else{
                                        echo " 0 ";
                                    }
                                    ?></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"> পেন্ডিং রিকুয়েস্ট</span>
                                <span class="info-box-number"><?php
                                    $list = $dbmanipulate->PendingRequest();
                                    $counts = 0;
                                    if ($list){
                                        foreach ($list as $value){
                                            $counts++;
                                        }
                                        echo $counts;
                                    }
                                    else{
                                        echo " 0 ";
                                    }
                                    ?></span>
                            </div>
                        </div>
                    </div>
                  <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">মোট অ্যাডমিন</span>
                                <span class="info-box-number"><?php
                                    $list = $dbmanipulate->Admin();
                                    $counts = 0;
                                    if ($list){
                                        foreach ($list as $value){
                                            $counts++;
                                        }
                                        echo $counts;
                                    }
                                    else{
                                        echo " 0 ";
                                    }
                                    ?></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="../../assets/img/slid_1.jpg" height="420px" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="../../assets/img/slid_2.jpg" height="420px" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="../../assets/img/slid_3.jpg" height="420px" alt="Third slide">
                    </div>
                </div>
            </div>
        </section>
       <!-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="height: 430px; width: 98%; margin: 10px">
                    <img class="d-block w-100" src="../../assets/img/slid_1.jpg" alt="First slide">
                </div>
                <div class="carousel-item" style="height: 430px; width: 98%; margin: 10px">
                    <img class="d-block w-100"  src="../../assets/img/slid_2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item" style="height: 430px; width: 98%; margin: 10px">
                    <img class="d-block w-100" src="../../assets/img/slid_3.jpg" alt="Third slide">
                </div>

            </div>
        </div>-->





    </div>
    </div>
    <?php
    include_once "AdminFooter.php";
    ?>
        <script>
            $('.carousel').carousel({
                interval: 1500
            })
        </script>
    <?php
}
else{
    header("Location: ../login-register/login.php");
}
?>



