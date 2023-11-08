<?php

// --- modèle
require_once "./models/User.php";


$msgSignin = '';
// Extraction de données
if(isset($_POST['signin'])) {
    $user = User::getUserByMail($_POST['mail']);
            
    if(!empty($user)) {
        if(password_verify($_POST['password'],$user['password'])) {
            // Connecter l'utilisateur
            $_SESSION['user_info'] = $user;
            header("Location:?page=home");
        } else {
            // Refuser l'accès
            $msgSignin = 'Wrong password';
        }
    }
    else {
        $msgSignin = 'Unknown user';
    }
}

// --- view
include "./views/layout.phtml";