<?php

namespace App\Helpers;

use App\Model\Model;

class Auth{

    public static function check(){

        if(isset($_SESSION['auth'])){
            return true;
        }
            return false;
    }

    public static function user(){
        if(self::check())return $_SESSION['auth'];
        return $_SESSION['auth'];
    }


    public static function get_user($data){
        
        $users = Model::get_user($data);
        if($users){
            $_SESSION['auth'] = $users;
            return true;
        }else{
            $_SESSION['messege'] = 'Error while logging user in ';
            return false;
            
        }
    }
    public static function logout(){
        unset($_SESSION['auth']);
    }
}


?>