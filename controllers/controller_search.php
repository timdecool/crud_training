<?php

$query = htmlspecialchars($_GET['query']);
$query = strip_tags($query);
$query = strtolower(strval(urldecode(trim($query))));

$db = connectDB();

$statement = $db->prepare("
SELECT * 
FROM images 
WHERE author LIKE ? OR title LIKE ? OR description LIKE ? OR id LIKE ?
");
$statement->execute(array("%".$query."%","%".$query."%","%".$query."%","%".$query."%"));
$images = $statement->fetchAll(PDO::FETCH_ASSOC);

// --- view
include "./views/layout.phtml";