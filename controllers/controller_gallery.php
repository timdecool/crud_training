<?php

$db = connectDB();
$statement = $db->prepare("SELECT * FROM images ORDER BY id DESC");
$statement->execute();
$images = $statement->fetchAll(PDO::FETCH_ASSOC);


// --- view
include "./views/layout.phtml";

