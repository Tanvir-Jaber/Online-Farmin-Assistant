<?php
if(!isset($_SESSION)){
    session_start();
}
include_once ("../../vendor/autoload.php");
use App\DataManipulation\DataManipulation;
$dbmanipulate = new DataManipulation();
$Meid = $_SESSION ['Mid'];
$Mename = $_SESSION ['Mname'];
$Meemail = $_SESSION ['Memail'];
if (isset($_SESSION ['Mid']) && isset($_SESSION ['Mname']) && isset($_SESSION ['Memail']) ){
    include_once "BuyersHeader.php";
    ?>
    <style>

        .star-rating :checked ~ label {
            color:#f90;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="btn-sm btn-info"><a href="confirm_product.php" class="text-white" style="display: block;padding: 3px;width: 50px;margin-left: 22px"><i class="fa fa-backward" aria-hidden="true"></i></a></div>
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Sellers Profile</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <?php
                    $true = $dbmanipulate->singleUsers($_GET['seller_user_id']);
                    ?>
                    <div class="col-md-10 ml-auto mr-auto">
                        <div class="card card-widget widget-user">
                            <div class="widget-user-header bg-info">
                                <h3  class="widget-user-username"><?php echo $true->name?></h3>
                                <h5 class="widget-user-desc">Sellers</h5>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle elevation-2" src="<?php echo $true->image?>" alt="User Avatar">
                            </div>

                            <div class="card-footer">
                                <div class="d-flex justify-content-center ml-auto mr-auto">
                                <?php
                                $list_rating = $dbmanipulate->showratingUserId($_GET['seller_user_id']);
                                $value = count($list_rating);
                                if($value>0){
                                $sum = 0;
                                $s= 0;
                                foreach ($list_rating as $list_rating){
                                    $sum = $sum +$list_rating->rating;
                                }
                                $avg = $sum / $value;
                                $variable = (int)$avg;
                                if($variable>0){
                                for ($s=0; $s<$variable; $s++){
                                    ?><i style="font-size: 50px;color: #f90;" class="far fa-star"></i><?php
                                }}}
                                ?>


                                </div>
                                <div style="font-size: 30px">Name: &nbsp;&nbsp; <?php echo $true->name?></div>
                                <div style="font-size: 30px">Address: &nbsp;&nbsp;<?php echo $true->address?></div>
                                <div style="font-size: 30px">Phone Number: &nbsp;&nbsp;<?php echo $true->pnumber?></div>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>
    <?php
    include_once "BuyersFooter.php";
    ?>
    <?php
}
else{
    header("Location: ../login-register/login.php");
}
?>

