<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService {

    private static $secret = "mi_clave_super_secreta_para_jwt_2026_app_segura";

    public static function generate($user) {

        $payload = [
            "user_id" => $user['id'],
            "email" => $user['email'],
            "exp" => time() + 3600
        ];

        return JWT::encode($payload, self::$secret, 'HS256');

    }

    public static function validate($token) {

        return JWT::decode($token, new Key(self::$secret, 'HS256'));

    }

}