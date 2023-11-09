<?php
// --- model
require_once "./models/Message.php";

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if($data !== null) {
    Message::sendMessage($data['id_conv'],$data['id_sender'],$data['message']);
}