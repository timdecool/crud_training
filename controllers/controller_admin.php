<?php
// --- modèle
require_once "./models/Image.php";

// Contrôles à l'entrée
if(!isset($_SESSION['user_info']) || $_SESSION['user_info']['role'] == "user") {
    header('Location: ./?page=home&access=denied');
}
if(!isset($_GET['view']) || ($_GET['view'] != "images" && $_SESSION['user_info']['role'] != "admin") || ($_GET['view'] != "images" && $_GET['view'] != "users" && $_GET['view'] != "comments")) {
    header('Location: ./?page=admin&view=images');
}

// Fetch publications
if($_GET['view'] == "images") {
    if($_SESSION['user_info']['role'] == "admin") {
        $images = Image::getAll();
    } else {
        $images = Image::getAllByUser($_SESSION['user_info']['id']);
    }
}

// Update users
if(isset($_POST['user_update'])) {
    $statement = $db->prepare("UPDATE users 
        SET role=?,date_updated=?
        WHERE id = ?");
        $statement->execute([
            $_POST['role'],
            date('Y-m-d H:i:s'),
            $_POST['id']
        ]);
}

// Fetch users
if($_GET['view'] == "users") {
        $statement = $db->prepare("SELECT * FROM users ORDER BY id DESC");
        $statement->execute();
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch comments
if($_GET['view'] == "comments") {
    $statement = $db->prepare
    ("SELECT *, images.id AS image_id, comments.id AS comment_id, users.id AS user_id
    FROM comments 
    INNER JOIN images ON comments.id_image = images.id
    INNER JOIN users ON comments.id_user = users.id
    ORDER BY comment_id DESC");
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
}

// --- view
include "./views/layout.phtml";