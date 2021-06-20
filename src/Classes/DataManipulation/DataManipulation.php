
namespace App\DataManipulation;
use App\Model\Database as DB;
use  App\Utility\Utility;



class DataManipulation extends DB
{
    public $password;

    public function setupdatepass($data){
        if (array_key_exists('re_pass', $data)) {
            $this->password = $data['re_pass'];
        }
    }

    public function getPostDataToShow(){
        $sql = "SELECT * FROM post WHERE approved = 'yes' ORDER BY no DESC ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }

    public function Search(){
        $sql = "SELECT * FROM users where checkActive = 'no' && position != '7' && emailtoken = 'yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function Admin(){
        $sql = "SELECT * FROM users where checkActive = 'no' && position != 'Sellers' && position != 'Buyers' && emailtoken = 'yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function SearchVia(){
        $sql = "SELECT * FROM users where checkActive = 'yes' && position != 'Admin' && emailtoken = 'yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
     public function SearchAllDeleteData(){
        $sql = "SELECT * FROM users where checkActive = 'delete' && position != 'Admin' && emailtoken = 'yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }

    public function PendingRequest(){
        $sql = "SELECT * FROM users where checkActive = 'no' && position != 'Admin' && emailtoken = 'yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function PendingPostCountRequest(){
        $sql = "SELECT * FROM post where approved = 'no' && commentNo is NULL  ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function viewSellerInfo(){
        $sql = "SELECT * FROM users where checkActive = 'yes' && position != 'Admin' && position != 'Buyers' && emailtoken = 'yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function viewConfimrListInfo($id){
        $sql = "SELECT * FROM product_confirm where user_id_From = '".$id."' && status = 0 ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function viewConfimrStatusInfo($id){
        $sql = "SELECT * FROM product_confirm where user_id_to = '".$id."' && status = 1 ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function viewBuyersInfo(){
        $sql = "SELECT * FROM users where checkActive = 'yes' && position != 'Admin' && position != 'Sellers' && emailtoken = 'yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function viewExpertsInfo(){
        $sql = "SELECT * FROM users where position = 'Expert' && emailtoken = 'yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }

    public function showUserProfile($email)
    {
        $sql = "select * from users where email = '".$email."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetch();
        return $status;
    }
    public function AdminCheck($id)
    {
        $sql = "select * from users where checkActive = 'yes' &&  position = 'Admin' && no = '".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetch();
        return $status;
    }
    public function viewNoticeInfo()
    {
        $sql = "select * from notice ORDER BY no DESC ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function viewPostByUserId($user_id)
    {
        $sql = "select * from post WHERE user_id = '".$user_id."' && approved = 'yes' && commentNo is null  ORDER BY no DESC ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function viewPostPendingByUserId($user_id)
    {
        $sql = "select * from post WHERE user_id = '".$user_id."' && approved = 'no' && commentNo is null  ORDER BY no DESC ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function viewConfimrListRequestInfo($user_id)
    {
        $sql = "select * from product_confirm WHERE user_id_To = '".$user_id."' && status = 0";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function viewConfimrListSellersInfo($user_id)
    {
        $sql = "select * from product_confirm WHERE user_id_from = '".$user_id."' && status = 1";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function viewConfirmImage($user_id)
    {
        $sql = "select image from post WHERE no = '".$user_id."' && commentNo is null";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetch();
        return $status;
    }
    public function searchquerytofind($user_id)
    {
        $sql = "select no,user_id,name,date,time,title,post,image from post WHERE post like '%$user_id%' && approved='yes' && position='Sellers' && commentNo is null";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }

    public  function updateUserPassword($user_id,$re_pass){
        $array=array($re_pass);
        $sql="update  users set pass=? WHERE no =$user_id";
        $data= $this->Dbconnect->prepare($sql);
        $status=$data->execute($array);
        return $status;
    }
    public  function confimrProductStatus($user_id){
        $sql="update  product_confirm set status='1' WHERE no =$user_id";
        $data= $this->Dbconnect->exec($sql);
    }
    public function userPassword($user_id){
        $sql = "SELECT password FROM users WHERE user_id=$user_id";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();

        return $satatus;
    }
    public function singleUsers($id){
        $sql = "SELECT * FROM users WHERE checkActive = 'yes' && no ='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();

        return $satatus;
    }
    public function showratingUserId($id){
        $sql = "SELECT * FROM product_confirm WHERE rating is not NULL && user_id_To ='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        return $satatus;
    }
    public function userRatingCheckViaFrom($id){
        $sql = "SELECT * FROM product_confirm WHERE rating is not NULL && user_id_From ='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        return $satatus;
    }
    public function confirmProductInformationByNo($id){
        $sql = "SELECT user_id_To FROM product_confirm WHERE no ='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();

        return $satatus;
    }


    public function postDataCollectviaUserId($id){
        $sql = "SELECT * FROM post WHERE no ='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();

        return $satatus;
    }
    public function viewAllPostForAdmin(){
        $sql = "SELECT * FROM post WHERE approved = 'yes' && commentNo is NULL ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        return $satatus;
    }
    public function viewAllPendingRequestPostForAdmin(){
        $sql = "SELECT * FROM post WHERE approved = 'no' && commentNo is NULL ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        return $satatus;
    }
    public function viewPostComment($postNo){
        $sql = "SELECT * FROM post where commentNo = '".$postNo."' ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function viewNoticeByid($id){
        $sql = "SELECT * FROM notice where no = '".$id."' ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public function viewSellerBuyersTotalInfo($buyers_id,$sellers_id){
        $sql = "SELECT * FROM chat where buyers_id = '".$buyers_id."' &&  sellers_id = '".$sellers_id."' ORDER BY no DESC";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        $updates = "update chat set messageRead = 'seen' where buyers_id = '".$buyers_id."' &&  sellers_id = '".$sellers_id."'";
        $this->Dbconnect->exec($updates);

        return $satatus;
    }
    public function viewSellerBuyersTotalInfoS($buyers_id,$sellers_id){
        $sql = "SELECT * FROM chat where buyers_id = '".$buyers_id."' &&  sellers_id = '".$sellers_id."' ORDER BY no DESC";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();

        $update = "update chat set message = 'seen' where buyers_id = '".$buyers_id."' &&  sellers_id = '".$sellers_id."'";
        $this->Dbconnect->exec($update);

        return $satatus;
    }
    public function ratingValueUpdate($buyers_id,$sellers_id){
        $update = "update product_confirm set rating = '".$sellers_id."' where no = '".$buyers_id."'";
        $this->Dbconnect->exec($update);
    }
    public function usercheckactive($user_id){
        $re_check = 'yes';
        $array=array($re_check);
        $sql="update  users set checkActive=? WHERE no='".$user_id."'";
        $data= $this->Dbconnect->prepare($sql);
        $status=$data->execute($array);
        return $status;
    }
    public function updateMemberProfile($id,$name,$email,$address,$pnumber,$cname)
    {
        $array = array($name,$email,$address,$pnumber,$cname);
        $sqls = "update users set name=?,email=?,address=?,pnumber=?,cname=? WHERE  no='" . $id . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);

        $sqls2 = "update chat set buyers_name = '".$name."'  WHERE buyers_id ='" . $id . "'";
        $data2 = $this->Dbconnect->exec($sqls2);

        $sqls3 = "update post set name = '".$name."' WHERE  user_id ='" . $id . "'";
        $data3 = $this->Dbconnect->exec($sqls3);
        return $status;
    }

    public function updateAdminProfile($id,$name,$email,$address,$pnumber,$cname)
    {
        $array = array($name,$email,$address,$pnumber,$cname);
        $sqls = "update users set name=?,email=?,address=?,pnumber=?,cname=? WHERE  no='" . $id . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }
    public function userActivaeYes($activate,$id)
    {

        $array = array($activate);
        $sqls = "update users set checkActive=? WHERE  no='" . $id . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }

    public function updateSellersProfile($id,$name,$email,$address,$pnumber,$cname)
    {
        $array = array($name,$email,$address,$pnumber,$cname);
        $sqls = "update users set name=?,email=?,address=?,pnumber=?,cname=? WHERE  no='" . $id . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);

        $sqls2 = "update chat set sellers_name = '".$name."'  WHERE sellers_id ='" . $id . "'";
        $data2 = $this->Dbconnect->exec($sqls2);

        $sqls3 = "update post set name = '".$name."' WHERE  user_id ='" . $id . "'";
        $data3 = $this->Dbconnect->exec($sqls3);
        return $status;
    }

     public function Change_member_photo($id,$image)
    {
        $array = array($image);
        $sqls = "update users set image=? WHERE  no='" . $id . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }
    public function UserDataMoveToTrash($id)
    {
        $satatus='delete';
        $array = array($satatus);
        $sqls = "update users set 	checkActive=? WHERE  no='" . $id . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }
     public function updateNotice($noticeInfo,$id)
    {
        $array = array($noticeInfo);
        $sqls = "update notice set notice=? WHERE  no='" . $id . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }

    public function deleteNotice($id)
    {
        $sql = "delete from notice WHERE no = '".$id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;
    }
    public function usercheckactiveDelete($user_id){
        $sql=" delete from users WHERE no='".$user_id."'";
        $data= $this->Dbconnect->exec($sql);
        return $data;
    }
    public function noticeDelete($noticeNo){
        $sql=" delete from notice WHERE no='".$noticeNo."'";
        $data= $this->Dbconnect->exec($sql);
        return $data;
    }
    public function managePostDelete($postNo){
        $sql=" delete from post WHERE commentNo ='".$postNo."' || no='".$postNo."'";
        $data= $this->Dbconnect->exec($sql);
        return $data;
    }
    public function AdminSinglePendingPostRequest($postNo){
        $sql=" update post set approved = 'yes' WHERE no='".$postNo."'";
        $data= $this->Dbconnect->exec($sql);
        return $data;
    }
    public function addNotice($fname,$notice,$notice_title){
        $dataArray=array($fname,$notice,$notice_title);
        $sql="insert into notice(name,notice,title,date)VALUES (?,?,?,now())";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        return $status;
    }
    public function textareaPostSave($user_id,$name,$post,$image,$position,$post_title){
        $dataArray=array($user_id,$name,$post,$image,$position,$post_title);
        $sql="insert into post(user_id,name,post,image,position,title,date,time)VALUES (?,?,?,?,?,?,now(),now())";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        return $status;
    }
    public function confirmProductInformation($user_id,$parent_id,$confirm_name,$address,$item_need,$pnumber,$parents_ids,$unitsofproduct){
        $dataArray=array($user_id,$parent_id,$confirm_name,$address,$item_need,$pnumber,$parents_ids,$unitsofproduct);
        $sql="insert into product_confirm(user_id_From,user_id_To,name,address,item,pnumber,product,units,date,time)VALUES (?,?,?,?,?,?,?,?,now(),now())";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        return $status;
    }
    public function insertMessageForChat($buyers_id,$sellers_id,$buyers_name,$sellers_name,$chat_message){
        $dataArray=array($buyers_id,$sellers_id,$buyers_name,$sellers_name,$chat_message);
        $sql="insert into chat(buyers_id,sellers_id,buyers_name,sellers_name,message_from,date,time)VALUES (?,?,?,?,?,now(),now())";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        $update = "update chat set messageRead = 'seen' where buyers_id = '".$buyers_id."' &&  sellers_id = '".$sellers_id."'";
        $this->Dbconnect->exec($update);
        return $status;
    }
    public function insertMessageForChatSellers($buyers_id,$sellers_id,$buyers_name,$sellers_name,$chat_message){
        $data=array($buyers_id,$sellers_id,$buyers_name,$sellers_name,$chat_message);
        $sql="insert into chat(buyers_id,sellers_id,buyers_name,sellers_name,message_to,date,time)VALUES (?,?,?,?,?,now(),now())";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($data);
        $update = "update chat set message = 'seen' where buyers_id = '".$buyers_id."' &&  sellers_id = '".$sellers_id."'";
        $this->Dbconnect->exec($update);
        return $status;
    }
    public function insertComment($user_id,$name,$post,$commentNo,$approved){
        $dataArray=array($user_id,$name,$post,$commentNo,$approved);
        $sql="insert into post(user_id,name,post,date,time,commentNo,approved)VALUES (?,?,?,now(),now(),?,?)";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        return $status;
    }
    public function postUpdateDataCollectviaUserId($user_id,$post){
        $dataArray=array($post);
        $sql="update  post set post=? WHERE no ='".$user_id."'";
        $data= $this->Dbconnect->prepare($sql);
        $status=$data->execute($dataArray);
        return $status;
    }
    public function showAlertonMessage($sellers_id){
        $message = "unseen";
        $sql = "select buyers_id, message from chat where  sellers_id = '".$sellers_id."' &&  message='".$message."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();

        return $status;
    }
    public function showAlertonMessageforbuyers($id){
        $message = "unseen";
        $sql = "select sellers_id, messageRead from chat where buyers_id = '".$id."' && messageRead='".$message."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();

        return $status;
    }

}