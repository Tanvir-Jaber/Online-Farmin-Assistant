<?php
if(!isset($_SESSION)){
    session_start();
}
include_once ("../../vendor/autoload.php");
use App\DataManipulation\DataManipulation;
$dbmanipulate = new DataManipulation();
$Meid = $_SESSION ['Mid'];
$trueStatus = $dbmanipulate->singleUsers($Meid);
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
                        <h1 class="m-0 text-dark">Home</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
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
                            <input type="hidden"  class="parent_id" name="parent_id">
                            <input type="hidden"  class="parents_ids" name="parents_ids" >
                            <input type="text" name="confirm_name" class="form-control mb-1" placeholder="আপনার নাম লিখুন">
                            <input type="text" name="address" class="form-control mb-1" placeholder="দয়া করে আপনার ঠিকানা লিখুন">
                            <input type="number" name="item_need" class="form-control mb-1" placeholder="আপনার কয়টি আইটেম দরকার?">
                            <select name="unitsofproduct" class="form-control">
                                <option value="">ইউনিট নির্বাচন করুন</option>
                                <option value="kilogram">কেজি</option>
                                <option value="pieces">টুকরো পরিমাণ</option>
                            </select>
                            <input type="number" name="pnumber" class="form-control" placeholder="আপনার ফোন নম্বর লিখুন দয়া করে">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info btn-sm resetbtn" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                            <button type="submit" name="btnConfirmSend" class="btnConfirmSend btn btn-primary btn-sm"><i class="fas fa-save"></i> Confirm </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <section class="content">

            <?php
            $value = $dbmanipulate->singleUsers($Meid);
            if($value){
                $buyers_name = $value->name;
                $buyers_position = $value->position;
            }

            if($value){
                ?>
            <div class="container-fluid">
                <form action="search_process.php" method="get">
                    <div class="d-flex justify-content-center">
                        <div class="w-50 input-group input-group-sm">
                            <input type="search" placeholder="অনুসন্ধান করুন" name="product_search" class="form-control">
                            <span class="input-group-append">
                    <button type="submit" name="seraching_btn" class="btn btn-info btn-flat text-white">Go!</button>
                  </span>
                        </div>
                    </div>
                </form>

                <div class="d-flex justify-content-center " >
                    <div style="width: 90%" class="card-body box-profile card-danger ">
                        <div class="card card-danger card-outline callout callout-danger">
                            <form id="FormData" action="../process/data-process.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="name" name="name" value="<?php echo $buyers_name?>">
                                <input type="hidden" id="user_id" name="user_id" value="<?php echo $Meid?>">
                                <input type="hidden" id="position" name="position" value="<?php echo $buyers_position?>">
                                <div class="card-body ">
                                    <strong><i class="fas fa-book mr-1"></i>Post Box</strong>
                                    <div class="custom-file">
                                        <input type="file" name="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose File</label>
                                    </div>
                                    <input type="text" name="post_title" class="post_title form-control" id="post_title" placeholder="আপনার পোস্টের শিরোনাম লিখুন" required>
                                    <textarea style="resize: none; height: 150px" name="noticeInfo" class="post-message main-search form-control"></textarea>
                                    <div class="row mt-1">
                                        <div class="col-12">
                                            <button type="submit" name="newNotice" style="background: #02c27f;border: #00adc2;color: #ffffff;font-weight: bold" class="newNotice btn btn-block btn-secondary"><i class="fa fa-sign-language mr-2" aria-hidden="true"></i>Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center ">
                    <div class="col-md-8 dataShow"></div>

                </div>

                <?php
            }
                else{ ?>
                    <div class="typewriter d-flex justify-content-center">
                        <h1>Sorry.Your Account is not Active.</h1>
                    </div><?php
                }?>
            </section>
    </div>
    </div>
    <?php
    include_once "BuyersFooter.php";
    ?>
    <script>

        showData()
        var user_name = $("#name").val();
        var user_id = $("#user_id").val();
        var position = $("#position").val();

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
        function showData() {
            var getData = " ";
            $.ajax({
                type: "GET",
                url: "../process/data-process.php",
                data: {
                    getData: getData
                },
                success: function(data)
                {
                    var data = JSON.parse(data);
                    var html = " ";
                    var htmlString = " ";
                    for (var i = 0;  i<data.length;  i++){
                        if (data[i].commentNo == null) {
                            html +="<div class=\"\">\n" +
                                "<div class=\"card card-widget\">\n" +
                                "<div class=\"card-header\">\n" +
                                "<div class=\"user-block\">\n" +
                                "<img class=\"img-circle\" src=\"../../assets/img/ok-2B.jpg\" alt=\"User Image\">\n" +
                                "<span class=\"username\"><a href=\"#\">" + data[i].name + "</a></span>\n" +
                                "<span class=\"description\">" +data[i].date + " Time " +  tConvert(data[i].time) +"</span>\n" +
                                "</div>\n" +
                                "<div class=\"card-tools\">\n";
                            if(data[i].user_id != user_id && data[i].position != 'Buyers'){
                                html+= "<button data-id ='"+ data[i].user_id +"'  type=\"button\"  id=\"confirm_Btn_eye\" class=\"btn confirm_Btn_eye\" data-toggle=\"modal\" data-target=\"#exampleModal\">" +
                                    "<i class=\"fas fa-eye\"></i>\n" +
                                    "</button>\n";}
                                html+="<button data-id ='"+ data[i].no +"' type=\"button\" class=\"btn btn-tool\"  data-card-widget=\"collapse\">\n" +
                                "<i class=\"fas fa-minus\"></i>\n" +
                                "</button>\n" +
                                "</div>\n" +
                                "</div>\n" +
                                "<div class=\"card-body\">\n" +
                                 "<div style='white-space: pre-wrap; font-weight: bold; font-size: 30px'>" + data[i].title + "</div>" +
                                "<div style='white-space: pre-wrap;'>" + data[i].post + "</div>" +
                                "<img class=\"img-fluid pad\" src='"+ data[i].image +"'>" +
                                "<span class=\"float-right text-muted\">Comments</span></div>"

                            for (var j = 0; j < data.length; j++) {
                                if (data[i].no == data[j].commentNo) {
                                    html += "<div class=\"card-footer card-comments\">\n" +
                                        "<div class=\"card-comment\">\n" +
                                        "<img class=\"img-circle img-sm\" src=\"../../assets/img/ok-2B.jpg\" alt=\"User Image\">\n" +
                                        "<div class=\"comment-text\">\n" +
                                        "<span class=\"username\">\n" + data[j].name +
                                        "<span class=\"text-muted float-right\">"  + tConvert(data[j].time) + " </span>\n" +
                                        "</span>" + data[j].post +
                                        "</div>\n" +
                                        "</div>\n" +
                                        "</div>\n"
                                }
                            }
                               html += "<div class=\"card-footer\">\n" +
                                "<a href='' data-id ='"+ data[i].no +"' class=\"telegrambtn text-primary img-fluid img-circle img-sm\"><i class=\"fab fa-telegram fa-2x\" ></i></a>\n" +
                                "<div class=\"img-push\">\n" +
                                "<input type=\"text\" class=\"form-control form-control-sm\" placeholder=\"Press enter to post comment\">\n" +
                                "</div>\n" +
                                "</div>\n" +
                                "</div>\n" +
                                "</div>"


                        }
                        $(".dataShow").html(html);
                        $(".telegrambtn").click(function (e) {
                            e.preventDefault();
                            var commentValue = $(this).parent().find('input').val();
                            var commentNo = $(this).attr("data-id");
                            var user_name = $("#name").val();
                            var user_id = $("#user_id").val();
                            if (commentValue.length>0){
                                $.ajax({
                                    type: "POST",
                                    url: "../process/data-process.php",
                                    data: {
                                        commentValue: commentValue,
                                        commentNo: commentNo,
                                        user_name: user_name,
                                        user_id: user_id,
                                    },
                                    success: function(data)
                                    {
                                        showData()
                                    }
                                });
                                $(this).parent().find('input').val(" ")

                            }
                        })
                        $(".confirm_Btn_eye").click(function () {
                            var confirm = $(this).attr('data-id');
                            var parents_ids = ($(this).parent().find('button').eq("1").attr('data-id'))
                            $(".parent_id").val(confirm)
                            $(".parents_ids").val(parents_ids);
                        });
                    }
                }
            });

        }
        function submitPostData(form_data) {
            $.ajax({
                type: "POST",
                url: "../process/data-process.php",
                data: form_data,
                processData:false,
                contentType:false,
                cache:false,
                success: function(data)
                {
                    showData()
                }
            });
        }
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
        $(".resetbtn").click(function () {
            document.getElementById("ConfirmForm").reset();
        });
        $(".newNotice").click(function (e) {
            e.preventDefault();
            var textarea = $(".post-message").val().length;
            var post_title = $("#post_title").val().length;
            var textareas = $(".post-message").val();
            var imageFilename = $("#customFile").val().length;
            var form_data = new FormData($('#FormData')[0]);
            /*form_data.append("file",imageFilename);*/
            form_data.append("user_name",user_name);
            form_data.append("user_id",user_id);
            form_data.append("position",position);
            /* form_data.append("textarea",textareas);*/
            if(textarea>0 && imageFilename>0 && post_title>0)
            {

                submitPostData(form_data);
                $(".post-message").val("");
                $("#post_title").val("");
                $("#customFile").val('');
                $(".custom-file-label").text('Choose File');
            }
        })

    </script>
    <?php
}
else{
    header("Location: ../login-register/login.php");
}
?>

