<?php

require_once __DIR__ . '/JwtService.php';

class AuthMiddleware {

    public static function handle() {

        $headers = getallheaders();

        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            echo json_encode(["error" => "Token requerido"]);
            exit;
        }

        $token = str_replace("Bearer ", "", $headers['Authorization']);

        try {

            $decoded = JwtService::validate($token);

            $_SERVER['user_id'] = $decoded->user_id;

        } catch (Exception $e) {

            http_response_code(401);
            echo json_encode(["error" => "Token inválido"]);
            exit;

        }

    }

}