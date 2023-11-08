<?php
// --- Modèle
require_once "./models/Message.php";
require_once "./models/User.php";

// --- controller
if(isset($_GET['person'])) {
    if(isset($_POST['send'])) {
        Message::sendMessage($_SESSION['user_info']['id'],$_GET['person'],$_POST['message']);
    }
}

// --- view
include "./views/layout.phtml";
