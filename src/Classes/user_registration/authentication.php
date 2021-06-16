<?php
/**
 * Created by PhpStorm.
 * User: sAlek Chowdhury
 * Date: 29-Mar-20
 * Time: 7:39 AM
 */

namespace App\user_registration;
use App\Model\Database as DB;

class authentication extends DB
{
    public  $email, $password;

    public function setSignInData($data)
    {

        if (array_key_exists('email', $data)) {
            $this->email = $data['email'];
        }
        if (array_key_exists('password', $data)) {
            $this->password = $data['password'];
        }


    }


    public function checkEmail($email){
        $sql="select * from users WHERE email ='$email'";
        $sth=$this->Dbconnect->query($sql);
        $sth->setFetchMode(\PDO::FETCH_OBJ);
        $data=$sth->fetch();
        return $data;
    }
    public function authenticate(){
        $sql="select * from users WHERE emailtoken ='yes' && email ='".$this->email."' && pass ='".$this->password."'";
        $sth=$this->Dbconnect->query($sql);
        $sth->setFetchMode(\PDO::FETCH_OBJ);
        $data=$sth->fetch();
        return $data;
    }



    public  function viewCheckYesToken(){
        $sql="SELECT * FROM tbregistration WHERE email='".$this->email."' && emailtoken='yes'";
        $data=$this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;

    }
    public  function viewTeacherData(){
        $sql="select * from  tbregistration where email='".$this->email."'";
        $data=$this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;

    }
}