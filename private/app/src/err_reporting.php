<?php

/**
 * Fichier de définition du comportement des erreurs PHP
 * 
 * Info
 * - http://php.net/manuel/fr/function.error-reporting.php
*/

// Dans le cas où la variable $env n'est pas défini
// On initialise la variable $env avec la valeur "prod"
if(!isset($env)){
    $env = "prod";
}

// Dans le cas où la variable $env est défini à une autre valeur que "dev"
// On demande à PHP d'ignorer toutes les erreurs.

if($env != "dev"){
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
}
else{
    // Dans le cas où la variable $env est défini à la valeur "dev"
    // On demande à PHP d'afficher toutes les erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

?>