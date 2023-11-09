<?php 
// --- Modèle
require_once "./models/Message.php";
require_once "./models/User.php";
require_once "./models/Conversation.php";

$userConvs = Conversation::getAllByUser($_SESSION['user_info']['id']);
$convInfos = [];
foreach($userConvs as $c) {
    $convUsers = Conversation::getConvUsers($c['id_conv']);
    $users = [];

    foreach($convUsers as $u) {
        if($u['id_user'] != $_SESSION['user_info']['id']) {
            $users[] = User::getUser($u['id_user']);
        }
    }
    $lastMessage = Message::getLastMessage($c['id_conv']);
    $conv = [];
    $conv[] = $users;
    $conv[] = $lastMessage;
    $convInfos[] = $conv;        
}

header('content-type:application/json');
echo json_encode($convInfos);