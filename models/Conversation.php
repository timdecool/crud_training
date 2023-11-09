<?php

require_once "./service/database.php";

class Conversation {
    public static function getAllByUser($id) {
        $conv = [];

        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT * FROM conversations_users WHERE id_user=? ORDER BY last_seen DESC");
        $statement->execute([$id]);
        $conv = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $conv;
    }

    public static function getConvUsers($id_conv) {
        $users = [];

        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT * FROM conversations_users WHERE id_conv=? ORDER BY id DESC");
        $statement->execute([$id_conv]);
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public static function updateLastSeen($id_user, $id_conv) {
        $pdo = connectDB();
        $sql = $pdo->prepare("UPDATE conversations_users 
        SET last_seen=?
        WHERE id_user = ? AND id_conv = ?");
        $sql->execute([date('Y-m-d H:i:s'),$id_user,$id_conv]);
    }
}