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
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="btn-sm btn-danger"><a href="request_list.php" class="text-white" style="display: block;padding: 3px;width: 50px;margin-left: 22px"><i class="fa fa-backward" aria-hidden="true"></i></a></div>
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Sellers Profile</h1>
                    </div>
                </div>
            </div>
        </div>
        <form action="../process/data-process.php" method="post">

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><b>Seller Rating</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center ">
                                <input type="hidden" name="rating_number_count" class="rating_number_count">
                                <input type="hidden" name="rating_user_count" value="<?php echo $_GET["seller_user_id"]?>">
                                <span class="oness"> <i style="font-size: 50px;" class="far fa-star"></i></span>
                                <span class="twoss"> <i style="font-size: 50px;" class="far fa-star"></i></span>
                                <span class="threess"> <i style="font-size: 50px;" class="far fa-star"></i></span>
                                <span class="fourss"> <i style="font-size: 50px;" class="far fa-star"></i></span>
                                <span class="fivess"> <i style="font-size: 50px;" class="far fa-star"></i></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info btn-sm resetbtn" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                            <button type="submit" name="btnRatingSend" class=" btn btn-primary btn-sm"><i class="fas fa-save"></i> Confirm </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <?php
                    $true_one = $dbmanipulate->confirmProductInformationByNo($_GET['seller_user_id']);

                    $true = $dbmanipulate->singleUsers($true_one->user_id_To);
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
                                    $checssss = $dbmanipulate->userRatingCheckViaFrom($Meid);
                                    $checss_count = count($checssss);

                                    if ($checss_count==0){
                                        ?>
                                        <button class="btn-sm btn-info" type="button" data-toggle="modal" data-target="#exampleModal">Rating</button>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    $list_rating = $dbmanipulate->showratingUserId($true_one->user_id_To);
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
    <script>

        $(".resetbtn").click(function () {
            $(".oness").css('color','#212529')
            $(".twoss").css('color','#212529')
            $(".threess").css('color','#212529')
            $(".fourss").css('color','#212529')
            $(".fivess").css('color','#212529')
        });
        $(".oness").click(function () {
            $(this).css('color','#f90')
            $(this).parent().find('span').eq("1").css('color','#212529')
            $(this).parent().find('span').eq("2").css('color','#212529')
            $(this).parent().find('span').eq("3").css('color','#212529')
            $(this).parent().find('span').eq("4").css('color','#212529')
            $(".rating_number_count").val("1")
        })
        $(".twoss").click(function () {
            $(this).css('color','#f90')
            $(this).parent().find('span').eq("0").css('color','#f90')
            $(this).parent().find('span').eq("2").css('color','#212529')
            $(this).parent().find('span').eq("3").css('color','#212529')
            $(this).parent().find('span').eq("4").css('color','#212529')
            $(".rating_number_count").val("2")
        })
        $(".threess").click(function () {
            $(this).css('color','#f90')
            $(this).parent().find('span').eq("0").css('color','#f90')
            $(this).parent().find('span').eq("1").css('color','#f90')
            $(this).parent().find('span').eq("3").css('color','#212529')
            $(this).parent().find('span').eq("4").css('color','#212529')
            $(".rating_number_count").val("3")
        })
        $(".fourss").click(function () {
            $(this).css('color','#f90')
            $(this).parent().find('span').eq("0").css('color','#f90')
            $(this).parent().find('span').eq("1").css('color','#f90')
            $(this).parent().find('span').eq("2").css('color','#f90')
            $(this).parent().find('span').eq("4").css('color','#212529')
            $(".rating_number_count").val("4")
        })
        $(".fivess").click(function () {
            $(this).css('color','#f90')
            $(this).parent().find('span').eq("0").css('color','#f90')
            $(this).parent().find('span').eq("1").css('color','#f90')
            $(this).parent().find('span').eq("2").css('color','#f90')
            $(this).parent().find('span').eq("3").css('color','#f90')
            $(".rating_number_count").val("5")
        })
    </script>
    <?php
}
else{
    header("Location: ../login-register/login.php");
}
?>

