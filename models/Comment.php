<?php
// DB
require_once "./service/class/Database.php";


class Comment {
    public static function getAll() {
        $comments = [];

        $db = new Database();
        $comments = $db->query("SELECT *, images.id AS image_id, comments.id AS comment_id, users.id AS user_id
        FROM comments 
        INNER JOIN images ON comments.id_image = images.id
        INNER JOIN users ON comments.id_user = users.id
        ORDER BY comment_id DESC",[],"all");
        return $comments;
    }

    public static function getComments($id_image) {
        $comments = [];
        $db = new Database();
        $comments = $db->query("SELECT *, comments.id AS comment_id FROM comments
        INNER JOIN users ON users.id = comments.id_user
        WHERE comments.id_image=?",[$id_image],"all");
        return $comments;
    }

    public static function addComment($id_image, $id_user, $comment) {
        $db = new Database();
        $db->query("INSERT INTO comments SET id_image = ?, id_user = ?, comment = ?",[$id_image,$id_user,$comment]);
    }

    public static function deleteComment($id) {
        $db = new Database();
        $db->query("DELETE FROM comments WHERE id=?",[$id]);
    }
}