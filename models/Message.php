<?php

class Message {
    public static function getAllUserMessages($id) {
        $messages = [];
        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT * FROM messages 
        WHERE id_sender=? OR id_receiver=? ORDER BY id DESC");
        $statement->execute([$id,$id]);
        $messages = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $messages;
    }

    public static function getConversation($id_conv) {
        $messages = [];
        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT * FROM messages 
        WHERE id_conv=? ORDER BY id ASC");
        $statement->execute([$id_conv]);
        $messages = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $messages;
    }

    public static function sendMessage($id_conv,$id_sender,$message) {
        $pdo = connectDB();
        $statement = $pdo->prepare("INSERT INTO messages(id_conv,id_sender,message)
        VALUES (?,?,?)");
        $statement->execute([$id_conv,$id_sender,$message]);
    }

    public static function getLastMessage($id_conv) {
        $message = [];
        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT * FROM messages 
        WHERE id_conv=? ORDER BY id DESC LIMIT 1");
        $statement->execute([$id_conv]);
        $message = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $message;

    }
}