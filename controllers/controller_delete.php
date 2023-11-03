<?php
$db = connectDB();

if($_GET['view'] == 'images')  {
    $statement = $db->prepare("DELETE FROM images WHERE id = ?");
    $statement->execute([
        $_GET['id']
    ]);
    header("Location:?page=admin&view=images");
}

if($_GET['view'] == 'users') {
    $statement = $db->prepare("DELETE FROM users WHERE id = ?");
    $statement->execute([
        $_GET['id']
    ]);
    header("Location:?page=admin&view=users");
}

if($_GET['view'] == 'comments') {
    $statement = $db->prepare("DELETE FROM comments WHERE id = ?");
    $statement->execute([
        $_GET['id']
    ]);
    header("Location:?page=admin&view=comments");

}
