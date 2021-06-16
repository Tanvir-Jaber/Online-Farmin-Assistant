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
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Search</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <form action="search_process.php" method="get">
                    <div class="d-flex justify-content-center">
                        <div class="w-50 input-group input-group-sm">
                            <input type="search" placeholder="অনুসন্ধান করুন" name="product_search" value="<?php echo $_GET['product_search']?>" class="form-control">
                            <span class="input-group-append">
                            <button type="submit" name="seraching_btn" class="btn btn-info btn-flat text-white">Go!</button>
                            </span>
                        </div>
                    </div>
                </form>
                <div class="ml-auto mr-auto mt-5 col-md-8">
                    <?php
                    $search_list = $dbmanipulate->searchquerytofind($_GET['product_search']);
                    if($search_list){
                        foreach ($search_list as $lists){
                            ?>
                            <div class="card card-widget">
                                <div class="card-header">
                                    <div class="user-block">
                                        <img class="img-circle" src="../../assets/img/ok-2B.jpg" alt="User Image">
                                        <span class="username"><a href="#"><?php echo $lists->name ?></a></span>
                                        <span class="description"><?php echo $lists->date ?></span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="card-tools">
                                        <button data-id="<?php echo $lists->user_id ?>" type="button" class="btn btn-tool btn-active-on-click" title="Mark as read" data-toggle="modal" data-target="#exampleModal">
                                            <i class="far fa-circle"></i>
                                        </button>
                                        <button data-id="<?php echo $lists->no ?>"  type="button" class="btn btn-tool btn-active-on" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div style="white-space: pre-wrap; font-size: 30px; font-weight: bold"><?php echo $lists->title ?></div>
                                    <div style="white-space: pre-wrap;"><?php echo $lists->post ?></div>
                                    <img class="img-fluid pad" src="<?php echo $lists->image ?>" alt="Photo">
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
        </section>
        <form id="ConfirmForm" action="../process/data-process.php" method="post" enctype="multipart/form-data">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><b>Information</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden"  name="user_id" value="<?php echo $Meid?>">
                            <input type="hidden"  class="parent_id" name="parent_id" >
                            <input type="hidden"  class="parents_ids" name="parents_ids" >
                            <input type="text" name="confirm_name" class="form-control mb-1" placeholder="আপনার নাম লিখুন" required>
                            <input type="text" name="address" class="form-control mb-1" placeholder="দয়া করে আপনার ঠিকানা লিখুন" required>
                            <input type="number" name="item_need" class="form-control mb-1" placeholder="আপনার কয়টি আইটেম দরকার?" required>
                            <select name="unitsofproduct" class="form-control">
                                <option value="">ইউনিট নির্বাচন করুন</option>
                                <option value="kilogram">কেজি</option>
                                <option value="pieces">টুকরো পরিমাণ</option>
                            </select>
                            <input type="number" name="pnumber" class="form-control" placeholder="আপনার ফোন নম্বর লিখুন দয়া করে" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info btn-sm resetbtn" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                            <button type="submit" name="btnConfirmSend" class="btnConfirmSend btn btn-primary btn-sm"><i class="fas fa-save"></i> Confirm </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php
    include_once "BuyersFooter.php";
    ?>
    <script>
        $(".btn-active-on-click").click(function () {
            var parent_id = ($(this).attr('data-id'))
            var parents_ids = ($(this).parent().find('button').eq("1").attr('data-id'))
            $(".parent_id").val(parent_id);
            $(".parents_ids").val(parents_ids);
        })
        $(".btnConfirmSend").click(function (e) {
            e.preventDefault();
            var ConfirmForm = new FormData($('#ConfirmForm')[0]);
            $.ajax({
                type: "POST",
                url: "../process/data-process.php",
                data: ConfirmForm,
                processData:false,
                contentType:false,
                cache:false,
                success: function(data)
                {
                    document.getElementById("ConfirmForm").reset();
                    window.location.href = "confirm_product.php";
                }
            });
        });
    </script>
    <?php
}
else{
    header("Location: ../login-register/login.php");
}
?>

