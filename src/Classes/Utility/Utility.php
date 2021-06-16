<?php
/**
 * Created by PhpStorm.
 * User: sAlek Chowdhury
 * Date: 26-Mar-20
 * Time: 12:46 PM
 */

namespace App\Utility;


class Utility
{
 static function varDump($array){
     echo "<pre>";
     var_dump($array);
     echo "</pre>";
 }
    static function redirect($url){


        header("Location: $url" );
    }
}