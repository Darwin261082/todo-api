<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}


require __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../src/Infrastructure/Database.php';
require_once __DIR__ . '/../src/Infrastructure/Controllers/AuthController.php';
require_once __DIR__ . '/../src/Infrastructure/Controllers/TaskController.php';
require_once __DIR__ . '/../src/Infrastructure/Security/AuthMiddleware.php';

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$uri = str_replace('/todo-api/public/index.php', '', $uri);

if ($uri === '/api/register' && $method === 'POST') {
    AuthController::register();
}

elseif ($uri === '/api/login' && $method === 'POST') {
    AuthController::login();
}

elseif ($uri === '/api/tasks' && $method === 'GET') {
    AuthMiddleware::handle();
    TaskController::getTasks();
}

elseif ($uri === '/api/tasks' && $method === 'POST') {
    AuthMiddleware::handle();
    TaskController::createTask();
}

elseif (preg_match('/\/api\/tasks\/(\d+)/', $uri, $matches) && $method === 'PUT') {
    AuthMiddleware::handle();
    TaskController::updateTask($matches[1]);
}

elseif (preg_match('/\/api\/tasks\/(\d+)/', $uri, $matches) && $method === 'DELETE') {
    AuthMiddleware::handle();
    TaskController::deleteTask($matches[1]);
}

else {
    echo json_encode(["message" => "endpoint not found"]);
}