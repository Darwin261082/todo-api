<?php

require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../Security/JwtService.php';

class AuthController {

    public static function register() {

        $data = json_decode(file_get_contents("php://input"), true);

        $db = Database::connect();

        $password = password_hash($data['password'], PASSWORD_BCRYPT);

        $stmt = $db->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");

        $stmt->execute([
            $data['name'],
            $data['email'],
            $password
        ]);

        echo json_encode(["message" => "usuario creado"]);

    }

    public static function login() {

        $data = json_decode(file_get_contents("php://input"), true);

        $db = Database::connect();

        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");

        $stmt->execute([$data['email']]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($data['password'], $user['password'])) {

            http_response_code(401);
            echo json_encode(["error" => "credenciales incorrectas"]);
            return;

        }

        $token = JwtService::generate($user);

        echo json_encode([
            "token" => $token
        ]);

    }

}