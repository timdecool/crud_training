<?php
// --- modèle
require_once "./models/Image.php";

if(!isset($_SESSION['user_info']) || $_SESSION['user_info']['role'] == "user") {
        header("Location:?page=home&access=denied");
        die;
}

$errors = [];
if(isset($_POST['submit'])) {

    if (!empty($_FILES['image_file']['tmp_name'])) {        

        // On récupère notre fichier temporaire
        $tempFile = $_FILES['image_file']['tmp_name'];
        // On peut récupérer des infos sur le fichier uploadé
        $isValid = true;

        $checkFile = getimagesize($tempFile);
        if($checkFile) $ext = explode("/",$checkFile['mime']);
        if(!$checkFile || ($ext[1] != "jpeg" && $ext[1] != "png" && $ext[1] != "gif" && $ext[1] != "webp")) {
            $errors[] = "Format de fichier invalide.";
            $isValid = false;
        }

        if($_FILES['image_file']['size'] > ini_get('upload_max_filesize')) {
            $errors[] = "Fichier trop volumineux.";
            $isValid = false;
        }

        if($isValid) {
            // On précise le nom du fichier, en l'occurrence, l'id user et un timestamp
            $newFile = './uploads/'.$_SESSION['user_info']['id'].'-'.time().'.'.$ext[1];
            // On copie le fichier temporaire vers un vrai fichier dans le dossier uploads
            move_uploaded_file($tempFile,$newFile);
            if(!empty($_POST['author']) && !empty($_POST['author_link']) && !empty($_POST['title']) && !empty($_POST['description'])) {
                Image::addImage($newFile,$_POST['title'],$_POST['author'],$_POST['author_link'],$_POST['description'],$_SESSION['user_info']['id']);
                header("Location:?page=admin");
            }
        }
    }
}
else if(!empty($_POST['src']) && !empty($_POST['author']) && !empty($_POST['author_link']) && !empty($_POST['title']) && !empty($_POST['description'])) {
    Image::addImage($_POST['src'],$_POST['title'],$_POST['author'],$_POST['author_link'],$_POST['description'],$_SESSION['user_info']['id']);
    header("Location:?page=admin");
}



// --- view
include "./views/layout.phtml";