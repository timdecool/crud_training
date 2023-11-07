<?php
// Import modèle
require_once "./models/Image.php";
$images = Image::getLastImages();

// La session est-elle lancée ?
if(isset($_SESSION['user_info'])) {
    $username = $_SESSION['user_info']['first_name'].' '.$_SESSION['user_info']['last_name'];
}

// --- view
include "./views/layout.phtml";
