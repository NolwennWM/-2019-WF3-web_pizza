<?php
/**
 * Fichier qui gère la page de gestion de compte
 */

/**
 * account
 */

function account_index(){
    
    if(!isset($_SESSION["user"]) && empty($_SESSION['user'])){
        redirect("/connexion");
    }
     include_once "../private/src/views/account/index.php";
}

?>