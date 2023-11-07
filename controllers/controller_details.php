<?php
// Import modèles
require_once "./models/ImageUser.php";
require_once "./models/Like.php";
require_once "./models/Comment.php";

//////////////////
///// IMAGE //////
//////////////////

// SELECT Infos image
$image = ImageUser::getImageDetails($_GET['id']);

// Redirection en cas d'erreur
if (empty($image)) {
        header('Location: ./?page=gallery&id='.$_GET['id']);
        die();
}

//////////////////
///// LIKES //////
//////////////////

// Vérifier si l'utilisateur connecté a déjà liké ce post
$hasLiked = Like::hasLiked($_SESSION['user_info']['id'],$_GET['id']);

// Envoyer son like
if (isset($_POST['like']) && $hasLiked['hasLiked'] == 0) {
    Like::like($_SESSION['user_info']['id'],$_GET['id']);
}
// Retirer son like
if (isset($_POST['like']) && $hasLiked['hasLiked'] == 1) {
    Like::unlike($_SESSION['user_info']['id'],$_GET['id']);
}

// Revérifier si l'utilisateur connecté a déjà liké ce post
$hasLiked = Like::hasLiked($_SESSION['user_info']['id'],$_GET['id']);

// Récupérer le nombre de likes
$likes = Like::countLikes($_GET['id']);

//////////////////
// COMMENTAIRES //
//////////////////

// INSERT des commentaires
if(isset($_POST['submit'])) {
    if(!empty($_POST['comment'])) {
        Comment::addComment($_GET['id'],$_SESSION['user_info']['id'],$_POST['comment']);
    }
}

// DELETE des commentaires
if(isset($_GET['delete'])) {
    Comment::deleteComment($_GET['delete']);
}

// SELECT des commentaires
$comments = Comment::getComments($_GET['id']);

// --- view
include "./views/layout.phtml";