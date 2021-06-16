<?php
if(!isset($_SESSION)){
    session_start();
}
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
                                    $list = $dbmanipulate->viewConfimrListInfo($Meid);
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
                                                <td><span class="btn-sm btn-danger">Pending Request</span><a href="sellers_profile.php?seller_user_id=<?php echo  $lists->user_id_To ?>"  class="btn-sm btn-primary btn-view-profile" >View Profile</a></td>
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
    include_once "BuyersFooter.php";
    ?>
    <?php
}
else{
    header("Location: ../login-register/login.php");
}
?>

