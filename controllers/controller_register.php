<?php
// --- modèle
require_once "./models/User.php";

$success = false;
$msgEmail = "";
if(isset($_POST['mail'])) {
    $mail = trim(strip_tags($_POST['mail']));
    // Verification format
    if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $userCheck = User::getUserByMail($mail);
        if(empty($userCheck)) {
            // Si les deux sont bons, insertion BDD
            $hashedPwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
            User::addUser(strip_tags($_POST['first_name']),strip_tags($_POST['last_name']),$mail,$hashedPwd);
            $success = true;
        }                
        else $msgEmail = "Already used";
    }
    else $msgEmail = "Incorrect adress";
}

// --- view
include "./views/layout.phtml";