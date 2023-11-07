<?php
require_once "./service/database.php";

class ImageUser {
    public static function getImageDetails($id) {
        $image = [];

        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT images.*, users.first_name AS first_name, users.last_name AS last_name FROM images 
        INNER JOIN users ON users.id = images.id_user WHERE images.id=?");
        $statement->execute([$id]);
        $image = $statement->fetch(PDO::FETCH_ASSOC);

        return $image;
    }
    

}