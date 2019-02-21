<?php

/**
 * 
 * 
 * Ce fichier génère la page finale html avant de retourner le résultat au navigateur
 */

// Dans le cas ou la route est vide, on force le programme à redéfinir la route
// vers la page 404
if(empty($route)){
    $route = end($routes);
}

/**
 * Récupération des éléments de la route qui definissent le contrôleur
 */
if(!isset($route[2]) || empty($route[2])){
    throw new Exception("Le contrôleur n'est pas définit.");
}

// Initialisation des variables qui définiront le fichier et la fonction à exécuter
$controller_file = null;    // homepage
$controller_path = null;    // "../private/src/controller/".$controller_file.".php";
$controller_methode = null; // homepage_index

// Récupération des éléments du contrôleur
$controller = explode(":", $route[2]);

// Définition du fichier contrôleur
$controller_file = isset($controller[0]) ? $controller[0] : null;

if($controller_file !== null && !empty($controller_file)){
    $controller_path = "../private/src/controllers/".$controller_file.".php";
}

// Définition de la fonction à exécuter.
$controller_methode = isset($controller[1]) ? $controller[1] : null;

if($controller_methode !== null && !empty($controller_methode)){
    $controller_methode = $controller_file."_".$controller_methode;
}else{
    $controller_methode = $controller_file."_index";
}

/**
 * Intégration du fichier contrôleur
 */
if(!file_exists($controller_path)){
    throw new Exception("Le fichier contrôleur de la route\"".$route[0]."\" est manquant.");
}

include_once $controller_path;

/**
 * Exécution de la fonction du contrôleur
 */

 // Test l'existance de la fonction du contrôleur

 if(!function_exists($controller_methode)){
     throw new Exception("La methode '".$controller_methode."' de la route '".$route[0]."' n'existe pas");
 }

$controller_methode();

?>
