<?php
// DB
require_once "./service/class/Database.php";


class ImageUser {
    public static function getImageDetails($id) {
        $image = [];

        $db = new Database();
        $image = $db->query("SELECT images.*, users.first_name AS first_name, users.last_name AS last_name FROM images 
        INNER JOIN users ON users.id = images.id_user WHERE images.id=?",[$id],"row");

        return $image;
    }
}