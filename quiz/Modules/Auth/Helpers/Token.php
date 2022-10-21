<?php 
namespace Modules\Auth\Helpers;
class Token{
    public static function refres($user){
        $token = JWTAuth::claims($data)->fromUser($client);
        return $token;
    }
   
}