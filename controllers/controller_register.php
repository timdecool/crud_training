<?php
$msgSuccess = "";
$msgEmail = "";
if(isset($_POST['mail'])) {
    
    // Verification format
    if(filter_var(trim(strip_tags($_POST['mail'])), FILTER_VALIDATE_EMAIL)) {
        $db = connectDB();

        // Verification redondance BDD
        try {
            $sql="SELECT *
            FROM users WHERE mail=?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($_POST['mail']));            
        } catch (Exception $e) {$sqlError=$e->getMessage();}
    
        if (isset($sqlError)) {
            echo $sqlError;
        }         
    
        $userCheck=$stmt->rowCount();
        if($userCheck == 0) {
            // Si les deux sont bons, insertion BDD
            try {
                $sql="INSERT INTO users 
                SET first_name = ?, last_name = ?, mail = ?, password = ?";
                $stmt = $db->prepare($sql);
                $hashedPwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt->execute(array(
                    strip_tags($_POST['first_name']), 
                    strip_tags($_POST['last_name']), 
                    strip_tags($_POST['mail']),
                    $hashedPwd)); 
                $msgSuccess = 'Signup completed! <a href="?page=signin" class="text-reset">Sign in</a> now.';
            } catch (Exception $e) {$sqlError=$e->getMessage();}
            //  if error
            if (isset($sqlError)) {
                echo $sqlError;
            }
        }                
        else $msgEmail = "Already used";
    }
    else $msgEmail = "Incorrect adress";
}

// --- view
include "./views/layout.phtml";