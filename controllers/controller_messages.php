<?php
// --- model
require_once "./models/Conversation.php";
require_once "./models/Message.php";
require_once "./models/User.php";

if(isset($_GET['conv'])) {
    $convUsers = Conversation::getConvUsers($_GET['conv']);
    $isAllowed = false;
    
    foreach($convUsers as $u) {
        if($u['id_user'] == $_SESSION['user_info']['id']) $isAllowed = true;
    }
    if(!$isAllowed) {
        header("Location:?page=messages");
    }

    Conversation::updateLastSeen($_SESSION['user_info']['id'],$_GET['conv']);

    
    $userConvs = Conversation::getAllByUser($_SESSION['user_info']['id']);
    $convInfos = [];
    foreach($userConvs as $c) {
        $convUsers = Conversation::getConvUsers($c['id_conv']);
        $users = [];
        foreach($convUsers as $u) {
            if($u['id_user'] != $_SESSION['user_info']['id']) {
                $details = User::getUser($u['id_user']);
                $users[] = $details['first_name'].' '.$details['last_name'];
            }
        }
        $lastMessage = Message::getLastMessage($c['id_conv']);
        $conv = [];
        $conv[] = $users;
        $conv[] = $lastMessage;
        $convInfos[] = $conv;        
    }

}
else {
    $allConvs = Conversation::getAllByUser($_SESSION['user_info']['id']);
    $goToConv = $allConvs[0]['id_conv'];
    header("Location:?page=messages&conv=".$goToConv);
}

// --- view
include "./views/layout.phtml";
