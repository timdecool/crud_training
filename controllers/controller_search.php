<?php

// --- model
require_once "./models/Image.php";

$query = strtolower(strval(urldecode(strip_tags(htmlspecialchars($_GET['query'])))));
$images = Image::getImagesByQuery($query);

// --- view
include "./views/layout.phtml";