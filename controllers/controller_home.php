<?php
$db = connectDB();

// 3 last pictures
$statement = $db->prepare("SELECT * FROM images ORDER BY id DESC limit 3");
$statement->execute();
$pictures = $statement->fetchAll(PDO::FETCH_ASSOC);

// La session est-elle lancée ?
if(isset($_SESSION['user_info'])) {
    $username = $_SESSION['user_info']['first_name'].' '.$_SESSION['user_info']['last_name'];
}

// --- view
include "./views/layout.phtml";
