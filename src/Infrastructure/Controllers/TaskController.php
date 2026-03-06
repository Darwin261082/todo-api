<?php

require_once __DIR__ . '/../Database.php';

class TaskController {

    public static function getTasks() {

        $userId = $_SERVER['user_id'];

        $db = Database::connect();

        $stmt = $db->prepare("SELECT * FROM tasks WHERE user_id = ?");

        $stmt->execute([$userId]);

        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

    }

    public static function createTask() {

        $data = json_decode(file_get_contents("php://input"), true);

        $userId = $_SERVER['user_id'];

        $db = Database::connect();

        $stmt = $db->prepare("INSERT INTO tasks (user_id,title) VALUES (?,?)");

        $stmt->execute([$userId,$data['title']]);

        echo json_encode(["message"=>"tarea creada"]);

    }

    public static function updateTask($id) {

        $data = json_decode(file_get_contents("php://input"), true);

        $db = Database::connect();

        $stmt = $db->prepare("UPDATE tasks SET title=?, completed=? WHERE id=?");

        $stmt->execute([
            $data['title'],
            $data['completed'],
            $id
        ]);

        echo json_encode(["message"=>"tarea actualizada"]);

    }

    public static function deleteTask($id) {

        $db = Database::connect();

        $stmt = $db->prepare("DELETE FROM tasks WHERE id=?");

        $stmt->execute([$id]);

        echo json_encode(["message"=>"tarea eliminada"]);

    }

}