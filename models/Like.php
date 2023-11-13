<?php
// DB
require_once "./service/class/Database.php";


class Like {
    public static function countLikes($id_image) {
        $count = 0;
        $db = new Database();
        $count = $db->query("SELECT COUNT(*) AS count FROM likes WHERE id_image=?",[$id_image],"col");
        return $count;   
    }

    public static function hasLiked($id_user,$id_image) {
        $hasLiked = 0;
        $db = new Database();
        $hasLiked = $db->query("SELECT COUNT(*) AS hasLiked FROM likes WHERE id_user=? AND id_image=?",[$id_user,$id_image],"col");
        return $hasLiked;
    }

    public static function like($id_user,$id_image) {
        $db = new Database();
        $db->query("INSERT INTO likes(id_user,id_image) VALUES (?,?)",[$id_user,$id_image]);
    }

    public static function unlike($id_user,$id_image) {
        $db = new Database();
        $db->query("DELETE FROM likes WHERE id_user=? AND id_image=?",[$id_user,$id_image]);
    }
}