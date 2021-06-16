<?php


include_once ("../../vendor/autoload.php");
include_once ("../../vendor/phpmailer/phpmailer/src/PHPMailer.php");

use App\Utility\Utility;
use App\user_registration\registration;
use App\user_registration\authentication;
use App\DataManipulation\DataManipulation;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer( true);
$datamanipulation =new DataManipulation();
$authenticate =new authentication();
$registration =new registration();
if(!isset($_SESSION)){
    session_start();
}

if(isset($_POST['reg-btn'])){
    $receiver=$_POST['email'];
    $emailToken = rand(100000, 999999);
    $name = $_POST['name'];
    $value_pass = $_POST['password'];
    $salt = 'myrandomstring';
    $hashed_value = md5($salt.$value_pass);
    $_POST['password'] = $hashed_value;
    $_POST['emailToken'] = $emailToken;

    $registerEmail = $registration->emailIsExits($receiver);
    if ($registerEmail) {
        $http_reffer = $_SERVER['HTTP_REFERER'];
        $_SESSION['errorMessageRegister'] = "<div class=\"alert alert-danger alert-dismissible rounded-0\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <h5><i class=\"icon fas fa-ban\"></i> Oops!</h5>
                  Already exists this email address. Please try another email address
                </div>";
        Utility::redirect("$http_reffer");
    }
    else{
        try {
            //Server settings
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'onlinefarmingassistant@gmail.com';
            $mail->Password   = 'Online123';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('onlinefarmingassistant@gmail.com', 'Online Farming Assistant');
            $mail->addAddress("$receiver", 'User');
            $mail->addAddress('onlinefarmingassistant@gmail.com');
            $mail->addReplyTo('onlinefarmingassistant@gmail.com', 'Information');

            $mail->isHTML(true);
            $mail->Subject = "Verification Code";
            $mail->Body    = "<p>Here is your code <b> $emailToken </b></p>";
            $mail->AltBody = 'this is the body in plain text for non-HTML main clients';

            if($mail->send()){
                $registration->setData($_POST);
                echo $_POST['emailToken'];
                $insert = $registration->insertRegisterData();
                $_SESSION['m'] = $receiver;
                Utility::redirect("../login-register/verification.php");
            }

        }
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

        }
    }
}
if (isset($_POST['verification-btn'])) {
    $otp = $_POST['otp'];
    $mail = $_POST['mail'];
    $verification = $registration->varification($otp,$mail);
    $http_reffer = $_SERVER['HTTP_REFERER'];
    if ($verification){
        $registration->tokenUpdate($mail);
        Utility::redirect("../login-register/login.php");
    }
    else{
        $_SESSION['errorMessageVerification'] = "<div class=\"alert alert-warning alert-dismissible rounded-0\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <h5><i class=\"icon fas fa-exclamation-triangle\"></i> Oops!</h5>
                  Sorry. Your verification code is not matched
                </div>";
        Utility::redirect("$http_reffer");
    }

}
if (isset($_POST['signin'])){
    $value_pass = $_POST['password'];
    $salt = 'myrandomstring';
    $hashed_value = md5($salt.$value_pass);
    $_POST['password'] = $hashed_value;
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $authenticate->setSignInData($_POST);
    $data = $authenticate->authenticate();
    if($data){
        if($data->position == 'Admin'){
            $_SESSION ['Aid'] = $data->no;
            $_SESSION ['Aname'] = $data->name;
            $_SESSION ['Aemail'] = $data->email;
            Utility::redirect("../admin/bHome.php");
        }
        else if($data->position == 'Expert'){
            $_SESSION ['Aid'] = $data->no;
            $_SESSION ['Aname'] = $data->name;
            $_SESSION ['Aemail'] = $data->email;
            Utility::redirect("../expert/bHome.php");
        }
        else if($data->position == 'Buyers'){
            $_SESSION ['Mid'] = $data->no;
            $_SESSION ['Mname'] = $data->name;
            $_SESSION ['Memail'] = $data->email;
            Utility::redirect("../member/BuyersHome.php");
        }
        else{
            $_SESSION ['Sid'] = $data->no;
            $_SESSION ['Sname'] = $data->name;
            $_SESSION ['Semail'] = $data->email;
            Utility::redirect("../sellers/sellersHome.php");
        }
    }
    else{
        $_SESSION['errorMessageSignin'] = "<div class=\"alert alert-danger alert-dismissible rounded-0\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <h5><i class=\"icon fas fa-exclamation-triangle\"></i> Oops!</h5>
                  Sorry. Your email and password not matched
                </div>";
        Utility::redirect("$http_reffer");
    }

}
if (isset($_POST['Change_member_photo']))
{
    $http = $_SERVER['HTTP_REFERER'];
    $id = $_POST['id'];
    $random = rand(100,999);
    $files = $_FILES['photo'];
    $fileName = $files['name'];
    $fileTmpName = $files['tmp_name'];
    $image = '../../assets/img/' .$random. $fileName;

    move_uploaded_file($fileTmpName, $image);
    $Change_member_photo = $datamanipulation->Change_member_photo($id,$image);
    if($Change_member_photo){
        Utility::redirect("$http");
    }

}
if (isset($_POST['forgot-pass'])){
    $emailToken = rand(100000, 999999);
    $_POST['emailToken'] = $emailToken;
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $email = $_POST['email'];
    $check = $authenticate->checkEmail($email);
    if($check){
        try {
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'onlinefarmingassistant@gmail.com';
            $mail->Password   = 'Online123';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('onlinefarmingassistant@gmail.com', 'Online Farming Assistant');
            $mail->addAddress("$email", 'User');
            $mail->addAddress('onlinefarmingassistant@gmail.com');
            $mail->addReplyTo('onlinefarmingassistant@gmail.com', 'Information');

            $mail->isHTML(true);
            $mail->Subject = "Verification Code";
            $mail->Body    = "<p>Here is your code <b> $emailToken </b></p>";
            $mail->AltBody = 'this is the body in plain text for non-HTML main clients';

            if($mail->send()){
                $update_forgot = $registration->checkActivetokenUpdate($email,$emailToken);
                $_SESSION['mm'] = $email;
                Utility::redirect("../login-register/recover-password.php");
            }

        }
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

        }
    }
    else{
        $_SESSION['errorMessageForgot'] = "<div class=\"alert alert-danger alert-dismissible rounded-0\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <h5><i class=\"icon fas fa-exclamation-triangle\"></i> Oops!</h5>
                  Sorry. Your email address is not registered.
                </div>";
        Utility::redirect("$http_reffer");
    }
}
if(isset($_POST['send_message_to_adminBySeller']))
{
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message_user = $_POST['mesaage'];
    $http_reffer = $_SERVER["HTTP_REFERER"];
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'onlinefarmingassistant@gmail.com';                     // SMTP username
        $mail->Password   = 'Online123';                               // SMTP password
        $mail->SMTPSecure = 'ssl';         // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('onlinefarmingassistant@gmail.com', "Online Farming Assistant");
        //$mail->addAddress("$userEmail", 'User');     // Add a recipient
        $mail->addAddress('onlinefarmingassistant@gmail.com');               // Name is optional
        $mail->addReplyTo($email, 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // Attachments
        //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = "
                            
                               <table>
                              <tr><th>Message</th></tr>
                              <tr><td>$message_user</td></tr>
                              </table>";
        $mail->AltBody = 'this is the body in plain text for non-HTML main clients';

        if($mail->send()){

            $_SESSION["SendMessage"] = "<div style='background-color: #218838' class=\"alert alert-success alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span style='color: white'>
                            <b> Success - </b> Your message sent to admin. </span>
                        </div>";
            Utility::redirect("$http_reffer");

        }

    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        //echo 'Message has been sent';
    }



}

if(isset($_GET['user_no'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_GET['user_no'];
    $status = $datamanipulation->usercheckactive($id);
    if ($status){
        Utility::redirect("$http_reffer");
    }
}
if(isset($_POST['editNotice'])){

    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_POST['notice_id'];
    $noticeInfo = $_POST['notice'];
    $status = $datamanipulation->updateNotice($noticeInfo,$id);
    if ($status){
        $_SESSION['SuccessMsg'] = "<div class=\"alert alert-success alert-dismissible ml-2 mr-2 rounded-0\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <h5><i class=\"icon fas fa-check\"></i> Success!</h5>
                  Your Notice is successfully changed.
                </div>";
        Utility::redirect('../admin/Notice.php');

    }
}
if(isset($_GET['user_bno22'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_GET['user_bno22'];
    $status = $datamanipulation->usercheckactiveDelete($id);
    if ($status){
        $_SESSION['TostDelete'] ="<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-error\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Delete Successfully</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}
if(isset($_GET['moveToTrash'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_GET['moveToTrash'];
    $status = $datamanipulation->UserDataMoveToTrash($id);
    if ($status){
        $_SESSION['TostDelete'] ="<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-error\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Data Move To Trash</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}
if(isset($_GET['Active_yes_userAccount'])){
    var_dump($_GET['Active_yes_userAccount']);
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_GET['Active_yes_userAccount'];
    $activate="yes";
    $status = $datamanipulation->userActivaeYes($activate,$id);
    var_dump($status);
    if ($status){
        $_SESSION['TostDelete'] ="<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-success\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Recovery Successfully</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}

if (isset($_POST['change-pass'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $user_id = $_POST['user_no'];
    $pass = $_POST['password'];
    $salt = 'myrandomstring';
    $hashed_value = md5($salt.$pass);
    $pass = $hashed_value;
    $statusTrue = $datamanipulation->updateUserPassword($user_id,$pass);
    if ($statusTrue){
        $_SESSION['UpdateSuccessMessageForPassword'] = "<div class=\"alert alert-success alert-dismissible ml-2 mr-2 rounded-0\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <h5><i class=\"icon fas fa-check\"></i> Success!</h5>
                  Your password is successfully changed.
                </div>";
        Utility::redirect("$http_reffer");
    }
}
if(isset($_GET['Alogout'])){
    session_destroy();
    Utility::redirect("../login-register/login.php");
}
if (isset($_POST['change_recover_password'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $user_mail = $_POST['email'];
    $otp = $_POST['otp'];
    $pass = $_POST['password'];
    $salt = 'myrandomstring';
    $hashed_value = md5($salt.$pass);
    $pass = $hashed_value;
    $statusTrue = $registration->recoverEmailToken($user_mail,$otp);
    if ($statusTrue){
        $status = $registration->updateUserPassword($user_mail,$pass);
        Utility::redirect("../login-register/login.php");
    }
    else{
        $_SESSION['errorMessageRecover'] = "<div class=\"alert alert-danger alert-dismissible rounded-0\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <h5><i class=\"icon fas fa-exclamation-triangle\"></i> Oops!</h5>
                  Sorry. Your otp not matched
                </div>";
        Utility::redirect("$http_reffer");
    }
}
if(isset($_GET['delete_notice'])){
    $http = $_SERVER["HTTP_REFERER"];
    $notic = $_GET['delete_notice'];
    $data = $datamanipulation->deleteNotice($_GET['delete_notice']);

    if($data){
        $_SESSION["deleteMsg"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Delete - </b> Delete Notice Successfully.</span>
                         </div>";
        Utility::redirect("$http");

    }

}
if (isset($_POST['newAdmin'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $_POST['emailToken'] = "yes";
    $_POST['position'] = "Admin";
    $pass = $_POST['password'];
    $salt = 'myrandomstring';
    $hashed_value = md5($salt.$pass);
    $_POST['password'] = $hashed_value;
    $registration->setData($_POST);
    $insertNewAdmin = $registration->insertRegisterData();
    if ($insertNewAdmin){
        $_SESSION['CreateSuccessMessageForNewAdmin'] = "<div class=\"alert alert-success alert-dismissible ml-2 mr-2 rounded-0\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <h5><i class=\"icon fas fa-check\"></i> Success!</h5>
                  New Admin is created successfully.
                </div>";
        Utility::redirect("$http_reffer");
    }
}
if (isset($_POST['newExpertCreateAdmin'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $pass = $_POST['password'];
    $salt = 'myrandomstring';
    $hashed_value = md5($salt.$pass);
    $_POST['password'] = $hashed_value;
    $_POST['emailToken'] = "yes";
    $_POST['position'] = "Expert";
    $registration->setData($_POST);
    $insertNewAdmin = $registration->insertRegisterData();
    if ($insertNewAdmin){
        $_SESSION['CreateSuccessMessageForNewAdmin'] = "<div class=\"alert alert-info alert-dismissible ml-2 mr-2 rounded-0\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <h5><i class=\"icon fas fa-check\"></i> Success!</h5>
                  New Expert is created successfully.
                </div>";
        Utility::redirect("$http_reffer");
    }
}
if (isset($_POST['addNotice'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $noticeSuccess = $datamanipulation->addNotice($_POST['name'],$_POST['notice'],$_POST['notice_title']);
    if ($noticeSuccess){
        $_SESSION['SuccessMessageForNewNotice'] = "<div class=\"alert alert-success alert-dismissible ml-2 mr-2 rounded-0\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <h5><i class=\"icon fas fa-check\"></i> Success!</h5>
                  Notice Added Successfully.
                </div>";
        Utility::redirect("$http_reffer");
    }
}
if (isset($_POST['removeNotice'])){
    $datamanipulation->noticeDelete($_POST['value']);
}
if (isset($_POST['item_need'])){
    $user_id = $_POST['user_id'];
    $parent_id = $_POST['parent_id'];
    $confirm_name = $_POST['confirm_name'];
    $address = $_POST['address'];
    $item_need = $_POST['item_need'];
    $pnumber = $_POST['pnumber'];
    $parents_ids = $_POST['parents_ids'];
    $unitsofproduct = $_POST['unitsofproduct'];
    $datamanipulation->confirmProductInformation($user_id,$parent_id,$confirm_name,$address,$item_need,$pnumber,$parents_ids,$unitsofproduct);
}
if (isset($_GET['managePostDelete'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_GET['managePostDelete'];
    $managePostDelete = $datamanipulation->managePostDelete($id);
    if ($managePostDelete){
        $_SESSION['TostUpdate'] ="<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-error\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Delete post Successfully</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}
if (isset($_GET['AdminPendingPostRequest'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $no_of_post = $_GET['AdminPendingPostRequest'];
    $AdminPendingPostRequest = $datamanipulation->AdminSinglePendingPostRequest($no_of_post);
    if ($AdminPendingPostRequest){
        $_SESSION['TostUpdate'] ="<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-info\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Accept post Successfully</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}
if (isset($_POST['change_member_profile'])){
    //var_dump($_POST);
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_POST['id'];
    $name= $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $pnumber = $_POST['pnumber'];
    $cname = $_POST['cname'];

    $updateMemberProfile = $datamanipulation->updateMemberProfile($id,$name,$email,$address,$pnumber,$cname);
    if ($updateMemberProfile){
        $_SESSION['updateMsg'] ="<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-error\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Update Profile Successfully</div></div></div>";
       Utility::redirect("$http_reffer");
    }
}
if (isset($_POST['change_admin_profile'])){
    //var_dump($_POST);
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_POST['id'];
    $name= $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $pnumber = $_POST['pnumber'];
    $cname = $_POST['cname'];

    $updateMemberProfile = $datamanipulation->updateAdminProfile($id,$name,$email,$address,$pnumber,$cname);
    if ($updateMemberProfile){
        $_SESSION['updateMsg'] ="<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-error\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Update Profile Successfully</div></div></div>";
       Utility::redirect("$http_reffer");
    }
}
if (isset($_POST['change_sellers_profile'])){
    //var_dump($_POST);
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_POST['id'];
    $name= $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $pnumber = $_POST['pnumber'];
    $cname = $_POST['cname'];

    $updateMemberProfile = $datamanipulation->updateSellersProfile($id,$name,$email,$address,$pnumber,$cname);
    if ($updateMemberProfile){
        $_SESSION['updateMsg'] ="<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-error\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Update Profile Successfully</div></div></div>";
       Utility::redirect("$http_reffer");
    }
}
if (isset($_POST['noticeInfo'])){
    $files = rand(1000,10000).$_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $destinationFile ='../../assets/img/'.$files;
    move_uploaded_file($fileTmpName,$destinationFile);
    $_POST['destinationFile']=$destinationFile ;
    $user_name = $_POST['user_name'];
    $position = $_POST['position'];
    $user_id = $_POST['user_id'];
    $textarea = $_POST['noticeInfo'];
    $image = $_POST['destinationFile'];
    $post_title = $_POST['post_title'];
    $datamanipulation->textareaPostSave($user_id,$user_name,$textarea,$image,$position,$post_title);
    print_r($_FILES['file']);
}

if (isset($_POST['postDataCollect'])){

    $user_id = $_POST['value'];
    $data = $datamanipulation->postDataCollectviaUserId($user_id);
    echo json_encode($data);
}
if (isset($_GET['getData']))
{
    $data = $datamanipulation->getPostDataToShow();
    echo json_encode($data);
}

if (isset($_POST['sellerDataCollectViaId']))
{
    $buyers_id = $_POST['buyers_id'];
    $sellers_id = $_POST['sellers_id'];
    $data = $datamanipulation->viewSellerBuyersTotalInfo($buyers_id,$sellers_id);
    echo json_encode($data);
}
if (isset($_POST['sellerSDataCollectViaId']))
{
    $buyers_id = $_POST['buyers_id'];
    $sellers_id = $_POST['sellers_id'];
    $data = $datamanipulation->viewSellerBuyersTotalInfoS($buyers_id,$sellers_id);
    echo json_encode($data);
}

if (isset($_POST['btn-save-changes'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $user_id = $_POST['user_no_from'];
    $user_update_post = $_POST['updatePostDataSection'];
    $data = $datamanipulation->postUpdateDataCollectviaUserId($user_id,$user_update_post);
    if ($data){
        $_SESSION['TostUpdate'] = "<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-success\" aria-live=\"polite\" style=\"\"><div class=\"toast-message\">Update your post Successfully</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}

if (isset($_POST['commentValue'])){
    $commentNo = $_POST['commentNo'];
    $user_name = $_POST['user_name'];
    $user_id = $_POST['user_id'];
    $commentValue = $_POST['commentValue'];
    $approved = 'yes';
    $data = $datamanipulation->insertComment($user_id,$user_name,$commentValue,$commentNo,$approved);

}
if (isset($_POST['buyers_name']) && isset($_POST['buyers_id'])){
    $buyers_name = $_POST['buyers_name'];
    $buyers_id = $_POST['buyers_id'];
    $sellers_id = $_POST['sellers_id'];
    $sellers_name = $_POST['sellers_name'];
    $chat_message = $_POST['chat_message'];
    $data = $datamanipulation->insertMessageForChat($buyers_id,$sellers_id,$buyers_name,$sellers_name,$chat_message);

}
if (isset($_POST['btnRatingSend'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $rating_number_count= $_POST['rating_number_count'];
    $rating_user_count = $_POST['rating_user_count'];
    $data = $datamanipulation->ratingValueUpdate($rating_user_count,$rating_number_count);
    Utility::redirect("$http_reffer");
}
if (isset($_GET['user_type'])){
    $data = $datamanipulation->showAlertonMessage($_GET['sellers_id']);
    echo json_encode($data);
}
if (isset($_GET['user_type_for_buyers'])){
    $data = $datamanipulation->showAlertonMessageforbuyers($_GET['user_id']);
    echo json_encode($data);
}
if (isset($_GET['status_id'])){
    $data = $datamanipulation->confimrProductStatus($_GET['status_id']);
    $http_reffer = $_SERVER['HTTP_REFERER'];
    Utility::redirect("$http_reffer");
}
if (isset($_POST['buyers_ids']) && isset($_POST['sellerActive']) && isset($_POST['sellers_names'])){
    $buyers_name = $_POST['buyers_names'];
    $buyers_id = $_POST['buyers_ids'];
    $sellers_id = $_POST['sellers_ids'];
    $sellers_name = $_POST['sellers_names'];
    $chat_message = $_POST['chat_messages'];
    $data = $datamanipulation->insertMessageForChatSellers($buyers_id,$sellers_id,$buyers_name,$sellers_name,$chat_message);

}