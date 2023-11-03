<?php
$db = connectDB();

//////////////////
///// IMAGE //////
//////////////////

// SELECT Infos image
$statement = $db->prepare("SELECT images.*, users.first_name AS first_name, users.last_name AS last_name FROM images 
LEFT JOIN users ON users.id = images.id_user WHERE images.id=?");
$statement->execute(array($_GET['id']));
$image = $statement->fetch(PDO::FETCH_ASSOC);

// Redirection en cas d'erreur
if (empty($image)) {
    $statement = $db->prepare("SELECT MAX(id) AS maxid FROM images");
    $statement->execute();
    $maxId = $statement->fetch(PDO::FETCH_ASSOC);

    if($_GET['id'] > 0 && $_GET['id'] < $maxId['maxid']) {

        header('Location: ./?page=details&id='.(intval($_GET['id'])+1));
        die();
    } else {
        header('Location: ./?page=gallery&id='.$_GET['id']);
        die();
    }
}

//////////////////
// COMMENTAIRES //
//////////////////

// INSERT des commentaires
if(isset($_POST['submit'])) {
    if(!empty($_POST['comment'])) {
        $statement = $db->prepare("INSERT INTO comments SET id_image = ?, id_user = ?, comment = ?");
        $statement->execute(array($_GET['id'],$_SESSION['user_info']['id'],$_POST['comment']));
    }
}
// DELETE des commentaires
if(isset($_GET['delete'])) {
    $statement = $db->prepare("DELETE FROM comments WHERE id=?");
    $statement->execute(array($_GET['delete']));
}

// SELECT des commentaires
$statement = $db->prepare("SELECT 
*, comments.id AS comment_id
FROM comments
INNER JOIN users ON users.id = comments.id_user
WHERE comments.id_image=?");
$statement->execute(array($_GET['id']));
$comments = $statement->fetchAll(PDO::FETCH_ASSOC);

// --- view
include "./views/layout.phtml";