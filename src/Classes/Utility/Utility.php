
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