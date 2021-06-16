<?php
if(!isset($_SESSION)){
    session_start();
}
include_once ("../../vendor/autoload.php");
use App\DataManipulation\DataManipulation;
$Adid = $_SESSION ['Aid'];
$Adname = $_SESSION ['Aname'];
$Ademail = $_SESSION ['Aemail'];
$dbmanipulate = new DataManipulation();
$trueStatus = $dbmanipulate->singleUsers($Adid);
if($trueStatus){
    $name=$trueStatus->name;
    $image=$trueStatus->image;
}else{
    $name="";
    $image="";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Farming Assistant</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="../../dist/css/bappi.min.css">
    <style>
        .error{
            color: #e80000;
            display: table;
            border-collapse: collapse;
            width:100%;
            margin: 0px;

        }
        .typewriter h1 {

            overflow: hidden;
            border-right: .10em solid orange;
            white-space: nowrap;
            margin: 0 auto;
            letter-spacing: .10em; /* Adjust as needed */
            animation:
                    typing 3.5s steps(55, end ),
                    blink-caret .75s step-end infinite ;

        }

        /* The typing effect */
        @keyframes typing {
            from { width: 0 }
            to { width: 50% }
        }

        /* The typewriter cursor effect */
        @keyframes blink-caret {
            from, to { border-color: transparent }
            30% { border-color: orange; }
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <marquee><span style="font-size: 20px" class="brand-text font-weight-bold">অনলাইন কৃষিকাজ সহকারী</span></marquee>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="bHome.php" class="brand-link">
            <span class="d-flex justify-content-center brand-text font-weight-light">Online Farming Assistant</span>
        </a>
        <div class="sidebar p-2 ">
            <div class="user-panel d-flex pb-2">

                    <?php
                    if($image){
                        ?>
                        <img style="width: 3.1rem; height: 3.1rem" src="<?php echo $image ?>" class="img-circle elevation-2" alt="User Image">
                        <?php

                    }else{
                        ?>
                        <img style="width: 3.1rem; height: 3.1rem" src="../../assets/img/ok-2B.jpg" class="img-circle elevation-2" alt="User Image">
                        <?php
                    }
                    ?>


                <div class="info">
                    <span class=" d-block font-weight-bold text-white"><?php echo $Adname ?></span>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav-list-my nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="bHome.php" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                চ্যাট
                            </p>
                        </a>
                    </li>
                   <!-- <li class="nav-item">
                        <a href="Notice.php" class="nav-link four">
                            <i class="nav-icon fas fa-user-edit"></i>
                            <p>
                                ক্রিয়েট নোটিশ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="add_expert.php" class="nav-link three">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>
                                নতুন বিশেষজ্ঞ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="ManagePost.php" class="nav-link five">
                            <i class="nav-icon fas fa-lightbulb"></i>
                            <p>
                                ম্যানেজ পোষ্ট
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="bprofile.php" class="nav-link six">
                            <i class="nav-icon fas fa-user-alt"></i>
                            <p>
                                প্রোফাইল
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="Members.php" class="nav-link seven">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                মেম্বার লিস্ট
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="post_approved.php" class="nav-link seven">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                মুলতুবি পোস্ট
                            </p>
                            <span style="background: #007e6c" class="badge  ml-4">
                                <?php
/*                                $list = $dbmanipulate->PendingPostCountRequest();
                                $count=0;
                                if($list){
                                    foreach ($list as $value){
                                        $count++;
                                    }
                                }
                                echo  $count;
                                */?>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="PendingRequest.php" class="nav-link eight ">
                            <i class="nav-icon fas fa-apple-alt"></i>
                            <p>
                                পেন্ডিং রিকুয়েস্ট
                            </p>
                            <span style="background: #1e7e34" class="badge  ml-4">
                                <?php
/*                                $list = $dbmanipulate->PendingRequest();
                                $count=0;
                                if($list){
                                    foreach ($list as $value){
                                        $count++;
                                    }
                                }
                                echo  $count;
                                */?>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="trash.php" class="nav-link">
                            <i class="nav-icon fas fa-trash-restore"></i>
                            <p>
                                ত্রাশ
                            </p>
                        </a>
                    </li>-->
                     <li class="nav-item">
                        <a href="../process/data-process.php?Alogout=1" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                লগআউট
                            </p>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>