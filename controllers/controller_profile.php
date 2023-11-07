<?php
// Import modèle
require_once "./models/User.php";

if(isset($_SESSION['user_info'])) {
    if(isset($_POST['update'])) {
        User::updateUser($_POST['first_name'], $_POST['last_name'], $_POST['mail'], $_SESSION['user_info']['id']);
    }
    $user = User::getUser($_SESSION['user_info']['id']);
    if(isset($_POST['update'])) {
        $_SESSION['user_info'] = $user;
    }
}
else {
    header("Location:?page=home");
}

// --- view
include "./views/layout.phtml";