<?php 
// --- Modèle
require_once "./models/Message.php";
require_once "./models/User.php";


$user = User::getUser($_GET['user']);
$friend = User::getUser($_GET['person']);
$messages = Message::getConversation($_GET['user'],$_GET['person']);

$conversation = array("user" => $user, "friend" => $friend, "messages" => $messages);
header('content-type:application/json');
echo json_encode($conversation);