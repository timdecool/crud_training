<?php
require_once "./service/database.php";

class User {
    public static function getUser($id) {
        $user = [];

        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT * FROM users WHERE id=?");
        $statement->execute([$id]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user;        
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