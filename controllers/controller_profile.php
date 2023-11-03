<?php
if(isset($_SESSION['user_info'])) {
    $db = connectDB();
    if(isset($_POST['update'])) {
        try {
            $sql="UPDATE users
            SET first_name = ?, last_name = ?, mail = ?, date_updated = ?         
            WHERE id=?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($_POST['first_name'], $_POST['last_name'], $_POST['mail'], date('Y-m-d H:i:s'), $_SESSION['user_info']['id']));
        }
        catch (Exception $e) {$sqlError=$e->getMessage();}
    }

    try {
        $sql="SELECT * FROM users WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($_SESSION['user_info']['id']));
    } 
    catch (Exception $e) {$sqlError=$e->getMessage();}
    
    $user=$stmt->fetch(PDO::FETCH_ASSOC);
    if(isset($_POST['update'])) {
        $_SESSION['user_info'] = $user;
    }
}
else {
    header("Location:?page=home");
}


// --- view
include "./views/layout.phtml";