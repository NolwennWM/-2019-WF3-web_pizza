<?php
/**
 * Fichier qui gère la page de sécurité
 */

/**
 * Sécurité
 */
function security_login(){
    if(isset($_SESSION["user"]) && !empty($_SESSION['user'])){
        redirect(url("account"));
    }
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        
        $isValid = true;
        $email          = isset($_POST['email']) ? trim($_POST['email']) : null;
        $password_text  = isset($_POST['password']) ? $_POST['password'] : null;
        global $db;

        $q = $db['main']->prepare("SELECT id, fullname, email, password FROM users WHERE email=:email");
        $q->bindvalue(':email', $email, PDO::PARAM_STR);
        $q->execute();

        $r = $q->fetchALL();
        if(empty($r)){
            $isValid = false;
        }

        if($isValid){
            if(password_verify($password_text,$r[0]['password'])){

                unset($r[0]['password']);
                $_SESSION['user'] = $r[0];
                redirect();
            }
            else{
                $isValid = false;
            }
        }
        if(!$isValid){
            setFlashbag('danger', "oops, mauvais identifiants...");
        }

    }

    include_once "../private/src/views/security/login.php";
}function security_register(){
    
    $firstname = null;
    $lastname = null;
    $email = null;
    global $db;
    global $re;

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $isValid = true;
        $firstname      = isset($_POST['firstname']) ? trim($_POST['firstname']) : null;
        $lastname       = isset($_POST['lastname']) ? trim($_POST['lastname']) : null;
        $email          = isset($_POST['email']) ? trim($_POST['email']) : null;
        $password_text  = isset($_POST['password']) ? $_POST['password'] : null;
        $password_check  = isset($_POST['password_check']) ? $_POST['password_check'] : null;
        $password_hash  = password_hash($password_text, PASSWORD_DEFAULT);

        //controle du formulaire

        if(!preg_match($re["firstname"], $firstname)){
            $isValid = false;
        }
        if(!preg_match($re["lastname"], $lastname)){
            $isValid = false;
        }
        if(!preg_match($re["email"], $email)){
            $isValid = false;
        }
        if($password_text != $password_check || strlen($password_text) < 6){
            $isValid = false;
        }

        // Verification de l'unicité de l'utilisateur
        $q = $db['main']->prepare('SELECT id FROM users WHERE email =:email');
        $q->bindValue(':email', $email, PDO::PARAM_STR);
        $q->execute();

        $r = $q->fetchALL();
        
        if(!empty($r)){
            $isValid = false;
        }

        if($isValid){
            $q = $db['main']->prepare("INSERT INTO users (`firstname`, `lastname`, `email`, `password`)
                                    VALUES (:firstname, :lastname, :email, :password)");
            $q->bindValue(':firstname', $firstname, PDO::PARAM_STR);
            $q->bindValue(':lastname', $lastname, PDO::PARAM_STR);
            $q->bindValue(':email', $email, PDO::PARAM_STR);
            $q->bindValue(':password', $password_hash, PDO::PARAM_STR);

            $r = $q->execute();
            if($r){
                redirect("/connexion");
            }else{
                setFlashbag('danger', "oops, les données n'ont pas été enregistrées dans la BDD");
            }
        }else{
            setFlashbag('danger', "oops, erreur sur le form");
        }

    }
    include_once "../private/src/views/security/register.php";
}

function security_forgotten_password(){
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        
        $email          = isset($_POST['email']) ? trim($_POST['email']) : null;
        global $db;

        
        $q = $db['main']->prepare("SELECT id FROM users WHERE email=:email");
        $q->bindvalue(':email', $email, PDO::PARAM_STR);
        $q->execute();

        $r = $q->fetchALL(PDO::FETCH_ASSOC);

        if(!empty($r)){

            $token = md5($email.microtime(true));
            $q = $db['main']->prepare("UPDATE users SET pwd_token=:token WHERE id=:id");
            $q -> bindValue(':token', $token, PDO::PARAM_STR);
            $q -> bindValue(':id', $r[0]['id'], PDO::PARAM_INT);

            $q -> execute();

            $url = "http://site-a.localsecurity/renew_pwd.php?t=".$token;
            // mail($email, "Renouvellement du mot de passe", "blabla bla bla\n".$url);
            echo '<a href="'.$url.'">$url</a>';
        }else{
            setFlashbag('danger', "Oups, aucun compte ne correspond à cette adresse email.");
        }
    }
    include_once "../private/src/views/security/forgotten_password.php";
}function security_logout(){
    session_destroy();
    redirect();
}


?>