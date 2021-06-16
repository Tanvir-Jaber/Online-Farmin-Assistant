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
                        <h1 class="m-0 text-dark">অ্যাডমিন ডেটা </h1>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if(isset($_SESSION['TostDelete'])){
        echo $_SESSION['TostDelete'];
        unset($_SESSION['TostDelete']);
        }
        ?>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card callout callout-danger">
                            <div class="card-header">
                                <h3 class="card-title">অ্যাডমিন ডেটা তালিকা</h3>
                            </div>
                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $list = $dbmanipulate->Admin();
                                    if ($list){
                                        foreach ($list as $lists){
                                            ?>
                                            <tr>
                                                <td><?php echo $lists->name ?></td>
                                                <td><?php echo $lists->email ?></td>
                                                <td><?php echo $lists->pnumber ?></td>
                                                <td><?php echo $lists->address ?></td>
                                                <td>
                                                    <a href="../process/data-process.php?user_bno22=<?php echo $lists->no; ?>" class="rounded-circle btn btn-danger"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <tbody>
                                </table>
                            </div>
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

