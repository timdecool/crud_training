<?php
require_once "./service/database.php";

class Like {
    public static function countLikes($id_image) {
        $count = 0;

        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT COUNT(*) AS count FROM likes WHERE id_image=?");
        $statement->execute([$id_image]);
        $count = $statement->fetch(PDO::FETCH_ASSOC);

        return $count['count'];   
    }

    public static function hasLiked($id_user,$id_image) {
        $hasLiked = [];

        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT COUNT(*) AS hasLiked FROM likes WHERE id_user=? AND id_image=?");
        $statement->execute([$id_user,$id_image]);
        $hasLiked = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $hasLiked;
    }

    public static function like($id_user,$id_image) {
        $pdo = connectDB();
        $statement = $pdo->prepare("INSERT INTO likes(id_user,id_image) VALUES (?,?)");
        $statement->execute([$id_user,$id_image]);
    }

    public static function unlike($id_user,$id_image) {
        $pdo = connectDB();
        $statement = $pdo->prepare("DELETE FROM likes WHERE id_user=? AND id_image=?");
        $statement->execute([$id_user,$id_image]);
    }
    
}