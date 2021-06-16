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
                        <h1 class="m-0 text-dark">Pending Request</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List of Request</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email Address</th>
                                       <!-- <th>Company Name</th>-->
                                        <th>Position</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $list = $dbmanipulate->PendingRequest();
                                        if ($list){
                                            foreach ($list as $lists){
                                                ?>
                                            <tr>
                                                <td><?php echo $lists->name ?></td>
                                                <td><?php echo $lists->email ?></td>
                                                <!--<td><?php /*echo $lists->cname */?></td>-->
                                                <td><?php echo $lists->position ?></td>
                                                <td><?php echo $lists->pnumber ?></td>
                                                <td><?php echo $lists->address ?></td>
                                                <td >
                                                    <div class="btn-group btn-group-sm">
                                                    <a href="../process/data-process.php?user_bno22=<?php echo $lists->no; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-restore-alt"></i></a>
                                                    <a href="../process/data-process.php?user_no=<?php echo $lists->no; ?>" class=" btn btn-info btn-sm"><i class="fas fa-check-square"></i></a>
                                                    </div>
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