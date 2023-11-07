<?php
require_once "./service/database.php";

class Comment {
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