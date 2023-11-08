<?php
// --- model
require_once "./models/Message.php";

// --- controller
$messages = Message::getAllUserMessages($_SESSION['user_info']['id']);


// --- view
include "./views/layout.phtml";
