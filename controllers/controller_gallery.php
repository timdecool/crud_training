<?php
// Compter le total d'articles
$db = connectDB();
$statement = $db->prepare("SELECT COUNT(*) AS count FROM images");
$statement->execute();
$count = $statement->fetch(PDO::FETCH_ASSOC);



// Fetch les articles concernés
if(!isset($_GET['p'])) {
    $curPage = 1;
} else {
    $curPage = intval($_GET['p']);
}

$offset = ($curPage-1)*6;
$limit = 6;

$statement = $db->prepare("SELECT * FROM images ORDER BY id DESC LIMIT :offset,:limit");
$statement->bindParam(':offset', $offset, PDO::PARAM_INT);
$statement->bindParam(':limit', $limit, PDO::PARAM_INT);
$statement->execute();
$images = $statement->fetchAll(PDO::FETCH_ASSOC);

// --- view
include "./views/layout.phtml";

