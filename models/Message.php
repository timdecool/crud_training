<?php
// DB
require_once "./service/class/Database.php";


class Message {
    public static function getAllUserMessages($id) {
        $messages = [];
        $db = new Database();
        $messages = $db->query("SELECT * FROM messages 
        WHERE id_sender=? OR id_receiver=? ORDER BY id DESC",[$id,$id],"all");
        return $messages;
    }

    public static function getConversation($id_conv) {
        $messages = [];

        $db = new Database();
        $messages = $db->query("SELECT * FROM messages 
        WHERE id_conv=? ORDER BY id ASC",[$id_conv],"all");

        return $messages;
    }

    public static function sendMessage($id_conv,$id_sender,$message) {
        $db = new Database();
        $db->query("INSERT INTO messages(id_conv,id_sender,message)
        VALUES (?,?,?)",[$id_conv,$id_sender,$message]);
    }

    public static function getLastMessage($id_conv) {
        $message = [];
        $db = new Database();
        $message = $db->query("SELECT * FROM messages 
        WHERE id_conv=? ORDER BY id DESC LIMIT 1",[$id_conv],"row");
        return $message;

    }
}