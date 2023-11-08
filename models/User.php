<?php
require_once "./service/database.php";

class User {

    public static function getAll() {
        $users = [];
        $pdo = connectDB();
        $sql = $pdo->prepare("SELECT * FROM users ORDER BY id DESC");
        $sql->execute();
        $users = $sql->fetchAll(PDO::FETCH_ASSOC);        
        return $users;        
    }

    public static function getUser($id) {
        $user = [];

        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT * FROM users WHERE id=?");
        $statement->execute([$id]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;        
    }

    public static function getUserByMail($mail) {
        $user = [];

        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT * FROM users WHERE mail=?");
        $statement->execute([$mail]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public static function addUser($firstName, $lastName, $mail, $password) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("INSERT INTO users 
        SET first_name = ?, last_name = ?, mail = ?, password = ?");
        $stmt->execute([$firstName, $lastName, $mail, $password]);
    }

    public static function updateUser($firstName, $lastName, $mail, $id) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("UPDATE users
        SET first_name = ?, last_name = ?, mail = ?, date_updated = ?         
        WHERE id=?");
        $stmt->execute([$firstName, $lastName, $mail, date('Y-m-d H:i:s'), $id]);
    }

    public static function updateRole($role, $id) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("UPDATE users
        SET role=?,date_updated=?        
        WHERE id=?");
        $stmt->execute([$role,date('Y-m-d H:i:s'),$id]);
    }

    public static function deleteUser($id) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("DELETE FROM users WHERE id=?");
        $stmt->execute([$id]);
    }
    
}