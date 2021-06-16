<?php
/**
 * Created by PhpStorm.
 * User: sAlek Chowdhury
 * Date: 26-Mar-20
 * Time: 7:09 AM
 */

namespace App\user_registration;
use App\Model\Database as DB;
use App\Utility\Utility;
if(!isset($_SESSION)){
    session_start();
}
$http_referrer=$_SERVER['HTTP_REFERER'];

class registration extends DB
{
   public $name,$email,$phone,$position,$password,$address,$bloodGroup,$cname,$token,$date;
    public function setData($data){
        if(array_key_exists('name',$data)){
            $this->name=$data['name'];
        }
        if(array_key_exists('email',$data)){
            $this->email=$data['email'];
        }
        if(array_key_exists('phone',$data)){
            $this->phone=$data['phone'];
        }
        if(array_key_exists('position',$data)){
            $this->position=$data['position'];
        }
        if(array_key_exists('address',$data)){
            $this->address=$data['address'];
        }
        if(array_key_exists('password',$data)){
            $this->password=$data['password'];
        }
        if(array_key_exists('company',$data)){
            $this->cname=$data['company'];
        }
        if(array_key_exists('emailToken',$data)){
            $this->token=$data['emailToken'];
        }
    }



    public function insertRegisterData(){
            $dataArray=array($this->name,$this->email,$this->phone,$this->position,$this->cname,$this->password,$this->address,$this->token);
            $sql="insert into users(name,email,pnumber,position,cname,pass,address,emailtoken)VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $sth=$this->Dbconnect->prepare($sql);
            $status=$sth->execute($dataArray);
            return $status;
    }

    public function emailIsExits($email){
        $sql="select email from users WHERE  email='".$email."'";
        $status=$this->Dbconnect->query($sql);
        $status->setFetchMode(\PDO::FETCH_OBJ);
        $data=$status->fetch();
        return $data;
    }
    public  function varification($otp,$mail){
        $sql="select emailtoken from users WHERE email = '".$mail."' &&  emailtoken='".$otp."'";
        $status=$this->Dbconnect->query($sql);
        $status->setFetchMode(\PDO::FETCH_OBJ);
        $data=$status->fetch();
        return $data;
    }
    public  function tokenUpdate($mail){
        $sql="update users  set emailtoken = 'yes'  WHERE email = '".$mail."'";
        $this->Dbconnect->exec($sql);
    }
    public  function checkActivetokenUpdate($mail,$token){
        $sql="update users  set recover = '".$token."'  WHERE email = '".$mail."'";
        $status = $this->Dbconnect->exec($sql);
        return $status;
    }
    public  function recoverEmailToken($mail,$otp){
        $sql="select emailtoken from users WHERE email = '".$mail."' &&  recover='".$otp."'";
        $status=$this->Dbconnect->query($sql);
        $status->setFetchMode(\PDO::FETCH_OBJ);
        $data=$status->fetch();
        return $data;
    }
    public  function updateUserPassword($user_id,$re_pass){
        $array=array($re_pass);
        $sql="update  users set pass=? WHERE email ='".$user_id."'";
        $data= $this->Dbconnect->prepare($sql);
        $status=$data->execute($array);
        return $status;
    }
}