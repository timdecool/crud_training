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

    public static function getConversation($id_user, $id_friend) {
        $messages = [];
        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT * FROM messages 
        WHERE (id_sender=? AND id_receiver=?) OR (id_sender=? AND id_receiver=?) ORDER BY id ASC");
        $statement->execute([$id_user,$id_friend,$id_friend,$id_user]);
        $messages = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $messages;
    }

    public static function sendMessage($id_sender,$id_receiver,$message) {
        $pdo = connectDB();
        $statement = $pdo->prepare("INSERT INTO messages(id_sender,id_receiver,message)
        VALUES (?,?,?)");
        $statement->execute([$id_sender,$id_receiver,$message]);
    }
}