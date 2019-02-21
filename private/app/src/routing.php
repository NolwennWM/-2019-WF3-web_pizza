<?php

// Dans le cas où la variable $routes n'est pas défini (dans le fichier routes.php)
// On initialise la variable $routes avec un tableau vide.
if(!isset($routes)){
    $routes = [];
}

// Récupération de l'uri courant
if(!empty($_SERVER['REQUEST_URI'])){
    $uri = $_SERVER['REQUEST_URI'];
}

// Recherche de l'URI dans le tableau de routage.
foreach($routes as $route){
    if($route[1]==$uri){
        $GLOBALS['route_active'] = $route[0];
        break;
    }
}

if(!isset($GLOBALS['route_active'])){
    $GLOBALS['route_active'] = "error-404";
}

?>