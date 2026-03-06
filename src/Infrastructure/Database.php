<?php

class Database {

    public static function connect() {
        $host = "localhost";
        $db = "todo_app";
        $user = "root";
        $pass = "";

        return new PDO(
            "mysql:host=$host;dbname=$db;charset=utf8",
            $user,
            $pass
        );
    }
}