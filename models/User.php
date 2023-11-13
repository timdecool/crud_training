<?php
// DB
require_once "./service/class/Database.php";

class User {

    public static function getAll() {
        $users = [];
        $db = new Database();
        $users = $db->query("SELECT * FROM users ORDER BY id DESC",[],"all");

        return $users;        
    }

    public static function getUser($id) {
        $user = [];

        $db = new Database();
        $user = $db->query("SELECT * FROM users WHERE id=?",[$id],"row");

        return $user;        
    }

    public static function getUserByMail($mail) {
        $user = [];
        $db = new Database();
        $user = $db->query("SELECT * FROM users WHERE mail=?",[$mail],"row");
        return $user;
    }

    public static function addUser($firstName, $lastName, $mail, $password) {
        $db = new Database();
        $db->query("INSERT INTO users SET first_name = ?, last_name = ?, mail = ?, password = ?",[$firstName, $lastName, $mail, $password]);
    }

    public static function updateUser($firstName, $lastName, $mail, $id) {
        $db = new Database();
        $db->query("UPDATE users SET first_name = ?, last_name = ?, mail = ?, date_updated = ? WHERE id=?",[$firstName, $lastName, $mail, date('Y-m-d H:i:s'), $id]);
    }

    public static function updateRole($role, $id) {
        $db = new Database();
        $db->query("UPDATE users SET role=?,date_updated=? WHERE id=?",[$role,date('Y-m-d H:i:s'),$id]);
    }

    public static function deleteUser($id) {
        $db = new Database();
        $db->query("DELETE FROM users WHERE id=?",[$id]);
    }
}