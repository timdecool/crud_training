<?php
require_once "./service/database.php";

class Image {

    public static function getAll() {
        $images = [];
        $pdo = connectDB();
        $sql = $pdo->prepare("SELECT * FROM images ORDER BY id DESC");
        $sql->execute();
        $images = $sql->fetchAll(PDO::FETCH_ASSOC);        
        return $images;        
    }

    public static function countAll() {
        $count = 0;
        $pdo = connectDB();
        $sql = $pdo->prepare("SELECT COUNT(*) AS count FROM images");
        $sql->execute();
        $count = $sql->fetch(PDO::FETCH_ASSOC);        
        return $count;        
    }

    public static function getOnePage($curPage) {
        $images = [];

        // Paramètres
        $offset = ($curPage-1)*6;
        $limit = 6;

        // Requête
        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT * FROM images ORDER BY id DESC LIMIT :offset,:limit");
        $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
        $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();
        $images = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $images;
    }

}