<?php
// DB
require_once "./service/class/Database.php";

class Conversation {
    public static function getAllByUser($id) {
        $conv = [];
        $db = new Database();
        $conv = $db->query("SELECT * FROM conversations_users WHERE id_user=? ORDER BY last_seen DESC",[$id],"all");
        return $conv;
    }

    public static function getConvUsers($id_conv) {
        $users = [];
        $db = new Database();
        $users = $db->query("SELECT * FROM conversations_users WHERE id_conv=? ORDER BY id DESC",[$id_conv],"all");
        return $users;
    }

    public static function updateLastSeen($id_user, $id_conv) {
        $db = new Database();
        $db->query("UPDATE conversations_users SET last_seen=? WHERE id_user = ? AND id_conv = ?",[date('Y-m-d H:i:s'),$id_user,$id_conv]);
    }
}