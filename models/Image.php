<?php
require_once "./service/database.php";

class Image {

    /////////////////////
    ////// SELECTS //////
    /////////////////////

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

    public static function getAllByUser($id) {
        $images = [];

        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT * FROM images WHERE id_user=? ORDER BY id DESC");
        $statement->execute([$id]);
        $images = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $images;
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

    public static function getOne($id) {
        $image = [];

        $pdo = connectDB();
        $statement = $pdo->prepare("SELECT * FROM images WHERE id=?");
        $statement->execute([$id]);
        $image = $statement->fetch(PDO::FETCH_ASSOC);

        return $image;
    }

    public static function getLastImages() {
        $images = [];

        $pdo = connectDB();
        $sql = $pdo->prepare("SELECT * FROM images ORDER BY id DESC limit 3");
        $sql->execute();
        $images = $sql->fetchAll(PDO::FETCH_ASSOC);        

        return $images;
    }

    //////////////////
    /////// CUD //////
    //////////////////

    public static function addImage($src,$title,$author,$authorLink,$description,$id_user) {
        $pdo = connectDB();
        $sql = $pdo->prepare("INSERT INTO images (src, title, author, author_link, description, id_user)
        VALUES (?, ?, ?, ?, ?, ?)");
        $sql->execute([$src,$title,$author,$authorLink,$description,$id_user]);
    }

    public static function updateImage($src,$title,$author,$authorLink,$description,$id) {
        $pdo = connectDB();
        $sql = $pdo->prepare("UPDATE images 
        SET src=?, title=?, author=?, author_link=?, description=?, date_updated=?
        WHERE id = ?");
        $sql->execute([$src,$title,$author,$authorLink,$description,date('Y-m-d H:i:s'),$id]);
    }

    public static function deleteImage($id) {
        $pdo = connectDB();
        $stmt = $pdo->prepare("DELETE FROM images WHERE id=?");
        $stmt->execute([$id]);
    }

}