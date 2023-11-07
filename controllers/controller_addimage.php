<?php
// --- modèle
require_once "./models/Image.php";

if(isset($_SESSION['user_info']) && $_SESSION['user_info']['role'] != "user") {
    if(isset($_POST['submit'])) {
        if(!empty($_POST['src']) && !empty($_POST['author']) && !empty($_POST['author_link']) && !empty($_POST['title']) && !empty($_POST['description'])) {
            Image::addImage($_POST['src'],$_POST['title'],$_POST['author'],$_POST['author_link'],$_POST['description'],$_SESSION['user_info']['id']);
            header("Location:?page=admin");
        }
    }
}
else {
    header("Location:?page=home&access=denied");
}

// --- view
include "./views/layout.phtml";