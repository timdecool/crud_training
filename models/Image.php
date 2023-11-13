<?php
require_once "./service/database.php";

require_once "./service/class/Database.php";

class Image {
    /////////////////////
    ////// SELECTS //////
    /////////////////////

    public static function getAll(): array {
        $images = [];
        $db = new Database();
        $images = $db->query("SELECT * FROM images ORDER BY id DESC",[],"all");
        return $images;        
    }

    public static function countAll(): int {
        $count = 0;
        $db = new Database();
        $count = $db->query("SELECT COUNT(*) AS count FROM images",[],"col");
        return $count;        
    }

    public static function getAllByUser($id) {
        $images = [];
        $db = new Database();
        $images = $db->query("SELECT * FROM images WHERE id_user=? ORDER BY id DESC",[$id],"all");
        return $images;
    }

    public static function getOnePage($offset,$limit) {
        $images = [];
        $db = new Database();
        $images = $db->limitedQuery("SELECT * FROM images ORDER BY id DESC LIMIT :offset,:limit",$offset,$limit);
        return $images;
    }

    public static function getOne($id) {
        $image = [];
        $db = new Database();
        $image = $db->query("SELECT * FROM images WHERE id=?",[$id],"row");
        return $image;
    }

    public static function getLastImages() {
        $images = [];
        $db = new Database();
        $images = $db->query("SELECT * FROM images ORDER BY id DESC limit 3",[],"all");
        return $images;
    }

    public static function getImagesByQuery($query) {
        $images = [];
        $db = new Database();
        $images = $db->query("SELECT * FROM images WHERE author LIKE ? OR title LIKE ? OR description LIKE ? OR id LIKE ?",["%".$query."%","%".$query."%","%".$query."%","%".$query."%"],"all");
        return $images;
    }

    //////////////////
    /////// CUD //////
    //////////////////

    public static function addImage($src,$title,$author,$authorLink,$description,$id_user) {
        $db = new Database();
        $db->query("INSERT INTO images (src, title, author, author_link, description, id_user) VALUES (?, ?, ?, ?, ?, ?)",
        [$src,$title,$author,$authorLink,$description,$id_user]);
    }

    public static function updateImage($src,$title,$author,$authorLink,$description,$id) {
        $db = new Database();
        $db->query("UPDATE images SET src=?, title=?, author=?, author_link=?, description=?, date_updated=? WHERE id = ?",
        [$src,$title,$author,$authorLink,$description,date('Y-m-d H:i:s'),$id]);
    }

    public static function deleteImage($id) {
        $db = new Database();
        $db->query("DELETE FROM images WHERE id=?",[$id]);
    }
}