<?php
$db = connectDB();

if($_GET['view'] == 'images')  {
    Image::deleteImage($_GET['id']);
    header("Location:?page=admin&view=images");
}

if($_GET['view'] == 'users') {
    User::deleteUser($_GET['id']);
    header("Location:?page=admin&view=users");
}

if($_GET['view'] == 'comments') {
    Comment::deleteComment($_GET['id']);
    header("Location:?page=admin&view=comments");
}
