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
                        <h1 class="m-0 text-dark">Notice</h1>
                    </div>
                </div>
            </div>
        </div>
        <?php

        if(isset($_SESSION['SuccessMessageForNewNotice'])){
            echo $_SESSION['SuccessMessageForNewNotice'];
            unset($_SESSION['SuccessMessageForNewNotice']);
        }
         if(isset($_SESSION['SuccessMsg'])){
             echo $_SESSION['SuccessMsg'];
             unset($_SESSION['SuccessMsg']);
         }
        ?>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-success card-outline">
                            <div class="card-body box-profile">
                                <div class="card card-success">
                                    <div class="card-header">
                                    </div>
                                    <form action="../process/data-process.php" method="post">
                                        <input type="hidden" name="name" value="<?php echo $Adname?>">
                                        <div class="card-body">
                                            <strong><i class="fas fa-book mr-1"></i>নোটিশ বক্স</strong>
                                            <input type="text" name="notice_title" class="form-control" placeholder="দয়া করে আপনি শিরোনাম লিখুন" required>
                                            <textarea style="resize: none; height: 150px" name="notice" class="main-search form-control" required></textarea>

                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" name="addNotice" style="background: #02c27f;border: #00adc2;color: #ffffff;font-weight: bold" class="btn btn-block btn-outline-success"><i class="fa fa-sign-language mr-2" aria-hidden="true"></i>Submit</button>
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

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info" >
                            <div class="card card-warning" style="background-color:  #4f0547; box-shadow: 5px 10px 10px 2px black">
                                <div class="card-header">
                                    <h3 class="card-title">নোটিশ দেখুন</h3>
                                </div>

                            </div>
                            <?php

                            if(isset($_SESSION['inserMsg'])){
                                echo $_SESSION['inserMsg'];
                                unset($_SESSION['inserMsg']);
                            }
                            if(isset($_SESSION['updateMsg'])){
                                echo $_SESSION['updateMsg'];
                                unset($_SESSION['updateMsg']);
                            }
                            if(isset($_SESSION['deleteMsg'])){
                                echo $_SESSION['deleteMsg'];
                                unset($_SESSION['deleteMsg']);
                            }
                            ?>
                            <div class="card-body">

                            </div>

                            <h5><i class="fas fa-info"></i> নোটিশ দেখুন:</h5>
                            <?php
                            $list = $dbmanipulate->viewNoticeInfo();

                            if($list){
                                foreach ($list as $lists){
                                    ?>
                                    <div class="row">
                                        <div class="col-8"><b><?php $date = $lists->date; echo  date(' m/d/Y', strtotime($date));?></b></div>

                                        <div class=""> </div>
                                        <div class="col-4 btn-group" style="padding-left: 190px">
                                            <a style="text-decoration: none" href="edit_notice.php?notice_id=<?php echo $lists->no?>" class="btn btn-primary btn-outline-secondary btn-round"> Edit</a>
                                            <a style="text-decoration: none" href="../process/data-process.php?delete_notice=<?php echo $lists->no?>" class="btn btn-danger btn-outline-success btn-round">Delete</a>

                                        </div>

                                    </div>
                                    <!--<div class="mb-5 mr-5 d-flex justify-content-end">9/5/2020</div>-->
                                    <div style="text-transform:capitalize;font-weight:bold;white-space:pre-wrap;font-size: 30px; padding-left: 13px"><?php echo $lists->title?></div>
                                    <div style="white-space:pre-wrap;font-size: 17px; padding-left: 13px"><?php echo $lists->notice?></div>
                                    <?php
                                }}

                            ?>

                        </div>

                    </div>
                </div>
            </div>
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



