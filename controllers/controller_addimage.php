<?php
// --- modèle
require_once "./models/Image.php";

$error = "";

if(isset($_SESSION['user_info']) && $_SESSION['user_info']['role'] != "user") {
    if(isset($_POST['submit'])) {

        if (!empty($_FILES['image_file']['tmp_name'])) {
            // On récupère notre fichier temporaire
            $tempFile = $_FILES['image_file']['tmp_name'];
            // On peut récupérer des infos sur le fichier uploadé
            $checkFile = getimagesize($tempFile);
            
            if($checkFile) {
                $checkFile = explode("/",$checkFile['mime']);
                if($checkFile[1] == "jpeg" || $checkFile[1] == "png" || $checkFile[1] == "gif" || $checkFile[1] == "webp") {
                    if ($_FILES['image_file']['size'] < ini_get('upload_max_filesize')) {
                        // On précise le nom du fichier, en l'occurrence, l'id user et un timestamp
                        $newFile = './uploads/'.$_SESSION['user_info']['id'].'-'.time().'.'.$checkFile[1];
                        // On copie le fichier temporaire vers un vrai fichier dans le dossier uploads
                        move_uploaded_file($tempFile,$newFile);
                        if(!empty($_POST['author']) && !empty($_POST['author_link']) && !empty($_POST['title']) && !empty($_POST['description'])) {
                            Image::addImage($newFile,$_POST['title'],$_POST['author'],$_POST['author_link'],$_POST['description'],$_SESSION['user_info']['id']);
                            header("Location:?page=admin");
                        }
                    }
                }
            }
            else {
                $error = "Format de fichier non accepté.";
            }
        }
        else if(!empty($_POST['src']) && !empty($_POST['author']) && !empty($_POST['author_link']) && !empty($_POST['title']) && !empty($_POST['description'])) {
            Image::addImage($_POST['src'],$_POST['title'],$_POST['author'],$_POST['author_link'],$_POST['description'],$_SESSION['user_info']['id']);
            header("Location:?page=admin");
        }
    }
}
else {
    header("Location:?page=home&access=denied");
}

// --- view
include "./views/layout.phtml";