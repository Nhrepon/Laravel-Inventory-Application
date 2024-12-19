<?php
namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtToken{
    public static function generateToken($email){
        $key = "1234-abcd";
        $payload = [
            'iss'=>'Laravel-Inventory',
            'iat'=> time(),
            'exp'=> time()+24*60*60,
            'email'=> $email,
        ];
        return JWT::encode($payload, $key, 'HS256');
    }


    public static function generateTokenForPasswordReset($email){
        $key = "1234-abcd";
        $payload = [
            'iss'=>'Laravel-Inventory',
            'iat'=> time(),
            'exp'=> time()+5*60,
            'email'=> $email,
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    public static function verifyToken($token){
        try{
            $key = "1234-abcd";
        $data = JWT::decode($token, new Key( $key, 'HS256'));
        return $data;
        }catch(Exception $e){
            return "unauthorized";
        }
    }
}




?>