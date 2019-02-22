<?php
/**
 * Fichier qui gère la page de sécurité
 */

/**
 * Sécurité
 */

function security_login(){
    include_once "../private/src/views/security/login.php";
}function security_register(){
    include_once "../private/src/views/security/register.php";
}function security_forgotten_password(){
    include_once "../private/src/views/security/forgotten_password.php";
}

?>