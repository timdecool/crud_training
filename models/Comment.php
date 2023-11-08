<?php
require_once "./service/database.php";

class Comment {
    public static function getAll() {
        $comments = [];

        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT *, images.id AS image_id, comments.id AS comment_id, users.id AS user_id
        FROM comments 
        INNER JOIN images ON comments.id_image = images.id
        INNER JOIN users ON comments.id_user = users.id
        ORDER BY comment_id DESC");
        $statement->execute();
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $comments;
    }


    public static function getComments($id_image) {
        $comments = [];

        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT *, comments.id AS comment_id
        FROM comments
        INNER JOIN users ON users.id = comments.id_user
        WHERE comments.id_image=?");
        $statement->execute([$id_image]);
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $comments;
    }

    public static function addComment($id_image, $id_user, $comment) {
        $pdo = connectDB();
        $statement = $pdo->prepare("INSERT INTO comments SET id_image = ?, id_user = ?, comment = ?");
        $statement->execute([$id_image,$id_user,$comment]);

    }

    public static function deleteComment($id) {
        $pdo = connectDB();
        $statement = $pdo->prepare("DELETE FROM comments WHERE id=?");
        $statement->execute([$id]);
    
    }
    
}