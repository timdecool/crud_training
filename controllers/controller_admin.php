<?php
// --- modèle
require_once "./models/Image.php";
require_once "./models/User.php";
require_once "./models/Comment.php";



// Contrôles à l'entrée
if(!isset($_SESSION['user_info']) || $_SESSION['user_info']['role'] == "user") {
    header('Location: ./?page=home&access=denied');
}
if(!isset($_GET['view']) || ($_GET['view'] != "images" && $_SESSION['user_info']['role'] != "admin") || ($_GET['view'] != "images" && $_GET['view'] != "users" && $_GET['view'] != "comments")) {
    header('Location: ./?page=admin&view=images');
}

//////////////////
/// IMAGES ///////
//////////////////

// Fetch publications
if($_GET['view'] == "images") {
    if($_SESSION['user_info']['role'] == "admin") {
        $images = Image::getAll();
    } else {
        $images = Image::getAllByUser($_SESSION['user_info']['id']);
    }
}

////////////////////
/////// USERS //////
////////////////////

// Update users
if(isset($_POST['user_update'])) {
    User::updateRole($_POST['role'],$_POST['id']);
}

// Fetch users
if($_GET['view'] == "users") {
    $users = User::getAll();
}

///////////////////////
////// COMMENTS ///////
///////////////////////

// Fetch comments
if($_GET['view'] == "comments") {
    $comments = Comment::getAll();
}


// --- view
include "./views/layout.phtml";