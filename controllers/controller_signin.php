<?php
$msgSignin = '';
// Extraction de données
if(isset($_POST['signin'])) {
    try {
        $db = connectDB();
        $sql="SELECT * FROM users WHERE mail=?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($_POST['mail']));
        $results=$stmt->fetch(PDO::FETCH_ASSOC);
    } 
    catch (Exception $e) {$sqlError=$e->getMessage();}
            
    if(!empty($results)) {
        if(password_verify($_POST['password'],$results['password'])) {
            // Connecter l'utilisateur
            $_SESSION['user_info'] = $results;
            header("Location:?page=home");
        } else {
            // Refuser l'accès
            $msgSignin = 'Wrong password';
        }
    }
    else {
        $msgSignin = 'Unknown user';
    }
}

// --- view
include "./views/layout.phtml";