<?php
// Import modèle
require_once "./models/Image.php";

// Compter les articles
$count = Image::countAll();

// Fetch les articles concernés
if(!isset($_GET['p'])) {
    $curPage = 1;
} else {
    $curPage = intval($_GET['p']);
}
$images = Image::getOnePage($curPage);

// --- view
include "./views/layout.phtml";

