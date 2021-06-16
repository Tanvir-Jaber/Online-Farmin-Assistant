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
                        <h1 class="m-0 text-dark">List of Sellers</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <input type="hidden" class="user_id" value="<?php echo $Meid?>">
            <input type="hidden" class="user_name" value="<?php echo $Mename?>">
            <input type="hidden" class="sellers_name">
            <input type="hidden"  class="seller_id">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List of Sellers</h3>
                            </div>
                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tableBody attrTable">
                                    <?php
                                    $list = $dbmanipulate->viewSellerInfo();
                                    if ($list){
                                        foreach ($list as $lists){
                                            ?>
                                            <tr>
                                                <td class="attrName"><?php echo $lists->name ?>
                                                    <span class="message-show-on-alert badge-danger badge"></span>
                                                </td>
                                                <td><?php echo $lists->address ?></td>
                                                <td><?php echo $lists->pnumber ?></td>

                                                <td>
                                                    <a data-id = "<?php echo $lists->no?>" href="#" class="attrValue show-chat-box-click btn btn-warning"><i class="fas fa-user-edit">  Chat</i></a>
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
        <div style="display: none; position: absolute; width: 30%; bottom: 0;right: 5%; z-index: 9999999" class="show-chat-box card card-warning direct-chat direct-chat-warning shadow">
            <div class="card-header">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-close-tool">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body ">
                <div style="height: 400px" class="direct-chat-messages chatlogs">


                </div>
            </div>
            <div class="card-footer">
                <form action="#" method="post">
                    <div class="input-group">
                        <input type="text" name="message" placeholder="Type Message ..." class="form-control chatMessageSend">
                        <span class="input-group-append">
                      <button type="button" class="btn btn-warning chatSendBtn">Send</button>
                    </span>
                    </div>
                </form>
            </div>
            <!-- /.card-footer-->
        </div>
    </div>
    </div>
    <?php
    include_once "BuyersFooter.php";
    ?>
    <script>

        setInterval(function () {
            var ary = [];
            var buyers_id = $(".user_id").val();
            $(function () {
                $('.attrTable tr').each(function (a, b) {
                    /*var name = $('.attrName', b).text();*/
                    var value = $('.attrValue', b).attr('data-id');
                    ary.push(value)
                });
                /*console.log(JSON.stringify(ary));*/
                $.ajax({
                    url: "../process/data-process.php",
                    type:'GET',
                    data:{user_type_for_buyers:ary,user_id:buyers_id},
                    success:function (result) {
                        var datas = JSON.parse(result);
                        htmlstring = "";
                        var j = 0;
                        for (var f = 0; f<ary.length; f++) {
                            for (var i = 0; i < datas.length; i++) {
                                if ((datas[i].messageRead == "unseen") && (datas[i].sellers_id == ary[f]) ) {
                                    console.log(datas)
                                    $('.attrTable tr').each(function (a, b) {
                                        var name = $('.attrName', b).text();
                                        /*var value = $('.attrValue', b).attr('data-id');*/
                                        if($(".attrValue",b).attr('data-id') == datas[i].sellers_id){
                                            console.log(datas[i].sellers_id)
                                            j=j+1;
                                            htmlstring = $(".attrValue",b).attr('data-id');
                                            $('.attrName .message-show-on-alert',b).text(j);
                                        }
                                    });
                                }
                            }
                            j=0;
                        }
                    }
                });
            });
        },800);
        $(".show-chat-box-click").click(function () {
            var buyers_name = $(".user_name").val();
            var buyers_id = $(".user_id").val();
            var sellers_id = $(this).attr("data-id");
            var sellerDataCollectViaId = "";
            var sellers_name = $(this).parent().parent().find('td').eq('0').text();
            $(".seller_id").val(sellers_id);
            $(".sellers_name").val(sellers_name);
            setInterval(function () {
                $.ajax({
                    type: "POST",
                    url: "../process/data-process.php",
                    data: {
                        sellerDataCollectViaId :sellerDataCollectViaId,
                        buyers_id :buyers_id,
                        sellers_id :sellers_id,
                    },
                    success: function(data)
                    {
                        var data = JSON.parse(data);
                        var htmlstring = "";
                        for(var i =0; i<data.length;i++){
                            if((data[i].message_from) !=null){
                                htmlstring +="<div class=\"direct-chat-msg\">\n" +
                                    "                        <div class=\"direct-chat-infos clearfix\">\n" +
                                    "                            <span class=\"direct-chat-name float-left\">" + data[i].buyers_name + "</span>\n" +
                                    "                            <span class=\"direct-chat-timestamp float-right\">" + tConvert(data[i].time) + "</span>\n" +
                                    "                        </div>\n" +
                                    "                        <img class=\"direct-chat-img\"  src=\"../../assets/img/buyer.png\"  alt=\"Message User Image\">\n" +
                                    "                        <div class=\"direct-chat-text\">\n" + data[i].message_from +
                                    "                        </div>\n" +
                                    "                    </div>"
                            }
                            if((data[i].message_to) !=null){
                                htmlstring += "<div class=\"direct-chat-msg right\">\n" +
                                    "                        <div class=\"direct-chat-infos clearfix\">\n" +
                                    "                            <span class=\"direct-chat-name float-right\">"+ data[i].sellers_name + "</span>\n" +
                                    "                            <span class=\"direct-chat-timestamp float-left\">"+tConvert(data[i].time) + "</span>\n" +
                                    "                        </div>\n" +
                                    "                        <img class=\"direct-chat-img\"  src=\"../../assets/img/seller.png\"  alt=\"Message User Image\">\n" +
                                    "                        <div class=\"direct-chat-text\">\n" + data[i].message_to +
                                    "                        </div>\n" +
                                    "                    </div>"
                            }
                        }
                        $('.chatlogs').html(htmlstring);
                    }
                });
            },1000);

           $(".btn-tool").click(function () {
                sellers_id = null;
                $(".seller_id").val("")
            });
            $(".show-chat-box").css("display","block")

        });
        function tConvert (time) {
            // Check correct time format and split into components
            time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

            if (time.length > 1) { // If time format correct
                time = time.slice (1);  // Remove full string match value
                time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM
                time[0] = +time[0] % 12 || 12; // Adjust hours
            }
            return time.join (''); // return adjusted time or original string
        }

        $(".btn-close-tool").click(function () {
            $(".show-chat-box").css("display","none");
            location.reload();
        });

        $(".chatSendBtn").click(function () {
                var buyers_name = $(".user_name").val();
                var buyers_id = $(".user_id").val();
                var sellers_id = $(".seller_id").val();
                var sellers_name = $(".sellers_name").val();
                var chat_message = $(".chatMessageSend").val();
                var htmlstring = " ";
                var sellerDataCollectViaId = " ";
                if(chat_message.length>0){
                    $.ajax({
                        type: "POST",
                        url: "../process/data-process.php",
                        data: {
                            buyers_name :buyers_name,
                            buyers_id :buyers_id,
                            sellers_id :sellers_id,
                            sellers_name :sellers_name,
                            chat_message :chat_message,
                        },
                        success: function(data)
                        {
                            $(".chatMessageSend").val("")
                            $.ajax({
                                type: "POST",
                                url: "../process/data-process.php",
                                data: {
                                    sellerDataCollectViaId :sellerDataCollectViaId,
                                    buyers_id :buyers_id,
                                    sellers_id :sellers_id,
                                },
                                success: function(data)
                                {
                                    var data = JSON.parse(data);
                                    for(var i =0; i<data.length;i++){
                                        if(data[i].message_from !=null){
                                            htmlstring +="<div class=\"direct-chat-msg\">\n" +
                                                "                        <div class=\"direct-chat-infos clearfix\">\n" +
                                                "                            <span class=\"direct-chat-name float-left\">" + data[i].buyers_name + "</span>\n" +
                                                "                            <span class=\"direct-chat-timestamp float-right\">" + tConvert(data[i].time) + "</span>\n" +
                                                "                        </div>\n" +
                                                "                        <img class=\"direct-chat-img\"  src=\"../../assets/img/ok-2B.jpg\"  alt=\"Message User Image\">\n" +
                                                "                        <div class=\"direct-chat-text\">\n" + data[i].message_from +
                                                "                        </div>\n" +
                                                "                    </div>"
                                        }
                                        if(data[i].message_to !=null){
                                            htmlstring += "<div class=\"direct-chat-msg right\">\n" +
                                                "                        <div class=\"direct-chat-infos clearfix\">\n" +
                                                "                            <span class=\"direct-chat-name float-right\">"+ data[i].sellers_name + "</span>\n" +
                                                "                            <span class=\"direct-chat-timestamp float-left\">"+tConvert(data[i].time) + "</span>\n" +
                                                "                        </div>\n" +
                                                "                        <img class=\"direct-chat-img\"  src=\"../../assets/img/ok.png\"  alt=\"Message User Image\">\n" +
                                                "                        <div class=\"direct-chat-text\">\n" + data[i].message_to +
                                                "                        </div>\n" +
                                                "                    </div>"
                                        }
                                    }
                                    $('.chatlogs').html(htmlstring);
                                }
                            });
                        }
                    });
                }
        });


    </script>
    <?php

}
else{
    header("Location: ../login-register/login.php");
}
?>

