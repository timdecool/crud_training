<?php 
// --- modèle
require_once "./models/Image.php";
$image = Image::getOne($_GET['id']);

if(isset($_POST['submit'])) {
    if(!empty($_POST['src']) && !empty($_POST['author']) && !empty($_POST['author_link']) && !empty($_POST['title']) && !empty($_POST['description'])) {
        Image::updateImage($_POST['src'],
            $_POST['title'],
            $_POST['author'],
            $_POST['author_link'],
            $_POST['description'],
            $_GET['id']);
        header("Location:?page=admin");
    }
}

// --- view
include "./views/layout.phtml";