<?php 
$db = connectDB();
$statement = $db->prepare("SELECT * FROM images WHERE id=?");
$statement->execute(array($_GET['id']));
$image = $statement->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])) {
    if(!empty($_POST['src']) && !empty($_POST['author']) && !empty($_POST['author_link']) && !empty($_POST['title']) && !empty($_POST['description'])) {
        $db = connectDB();
        $statement = $db->prepare("UPDATE images 
        SET src=?, title=?, author=?, author_link=?, description=?, date_updated=?
        WHERE id = ?");
        $statement->execute([
            $_POST['src'],
            $_POST['title'],
            $_POST['author'],
            $_POST['author_link'],
            $_POST['description'],
            date('Y-m-d H:i:s'),
            $_GET['id']
        ]);
        header("Location:?page=admin");
    }
}



// --- view
include "./views/layout.phtml";