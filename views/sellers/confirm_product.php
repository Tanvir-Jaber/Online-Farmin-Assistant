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
                        <h1 class="m-0 text-dark">Requested Product History</h1>
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
                                <h3 class="card-title">History of Requested Product</h3>
                            </div>
                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                        <th>Product Image</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Item Need</th>
                                        <th>Units</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tableBody">
                                    <?php
                                    $list = $dbmanipulate->viewConfimrStatusInfo($Seid);
                                    if ($list){
                                        foreach ($list as $lists){
                                            ?>
                                            <tr>
                                                <td><?php echo $lists->name ?></td>
                                                <td><?php echo $lists->address ?></td>
                                                <td><?php echo $lists->pnumber ?></td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <?php
                                                        $listImage = $dbmanipulate->viewConfirmImage($lists->product);
                                                        ?>
                                                        <img class="rounded-circle" height="70px" width="70px" src="<?php echo $listImage->image?>">

                                                    </div>
                                                </td>
                                                <td><?php echo $lists->date ?></td>
                                                <td><?php echo $lists->time ?></td>
                                                <td><?php echo $lists->item ?></td>
                                                <td><?php echo $lists->units ?></td>
                                                <td><span class="btn-sm btn-success">Confirmed</span></td>
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
    include_once "sellersFooter.php";
}
else{
    header("Location: ../login-register/login.php");
}
?>

