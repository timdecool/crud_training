<?php

$error = "";
if (isset($_POST['upload'])) {
    // On récupère notre fichier temporaire
    $tempFile = $_FILES['image_file']['tmp_name'];
    // On peut récupérer des infos sur le fichier uploadé
    $checkFile = getimagesize($tempFile);
    
    if($checkFile) {
        $checkFile = explode("/",$checkFile['mime']);
        if($checkFile[1] == "jpeg" || $checkFile[1] == "png" || $checkFile[1] == "gif" || $checkFile[1] == "webp") {
            // On précise le nom du fichier, en l'occurrence, l'id user et un timestamp
            $newFile = './uploads/'.$_SESSION['user_info']['id'].'-'.time().'.'.$checkFile[1];
            // On copie le fichier temporaire vers un vrai fichier dans le dossier uploads
            move_uploaded_file($tempFile,$newFile);
        }
    }
    else {
        $error = "Format de fichier non accepté.";
    }
}


// --- view
include "./views/layout.phtml";