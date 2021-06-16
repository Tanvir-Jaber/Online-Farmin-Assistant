<?php
if(!isset($_SESSION)){
    session_start();
}
$Seid = $_SESSION ['Sid'];
$Sename = $_SESSION ['Sname'];
$Seemail = $_SESSION ['Semail'];
if (isset($_SESSION ['Sid']) && isset($_SESSION ['Sname']) && isset($_SESSION ['Semail']) ){
    include_once "sellersHeader.php";
    ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Notice Section</h1>
                    </div>
                </div>
            </div>
        </div>  <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info" >
                            <h3>Admin Notice</h3>



                            <?php
                            $notice = $dbmanipulate->viewNoticeInfo();

                            if($notice){
                                foreach ($notice as $list){
                                    $date=$list->date;
                                    $dateArray = explode("-",$date);

                                    $dateRevers= array_reverse($dateArray);
                                    $stringDate = implode("-", $dateRevers);
                                    ?>

                                    <div class="row">
                                        <div class="col-8">
                                            <strong style="color: #28a745"><?php echo"Date:- ". $list->date?></strong><span style="font-size: 20px; color: #a71d2a">
                                            <p style="font-weight:bold;white-space:pre-wrap;font-size: 30px;"><?php echo $list->title?></p>
                                        </div>
                                        <br>
                                        <div class="mb-2" style="white-space:pre-wrap;font-size: 17px; padding-left: 13px"><?php echo $list->notice?></div>
                                    </div>

                                    <p style="text-align: justify;margin-bottom: 50px; border-bottom: 2px solid #88151e">

                                    </p>


                                    <?php
                                }
                            }
                            ?>



                        </div>


                    </div>
                </div>
            </div>
        </section>

    </div>
    <?php
    include_once "sellersFooter.php";
}
else{
    header("Location: ../login-register/login.php");
}
?>
