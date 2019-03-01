<?php

/**
 * Fichier de définition des routes de l'application.
 * 
 * _ Chaque ligne du tableau $routes défini une route
 * _ Chaque route est défini par 
 *      _ le nom de la route
 *      _ le "path"
 *      _ le "controller", la fonction déclenché par la route
 *      _ la | les méthode(s)
 */

$routes = [
    // Route Index (page d'accueil du site)
    ["homepage", "/", "homepage:index", ["HEAD","GET"]],

    // Liste des produits
    ["pizzas", "/pizzas", "products:pizzas", ["HEAD","GET"]],
    ["salads", "/salades", "products:salads", ["HEAD","GET"]],
    ["desserts", "/desserts", "products:desserts", ["HEAD","GET"]],
    ["drinks", "/boissons", "products:drinks", ["HEAD","GET"]],
    ["menus", "/menus", "products:menus", ["HEAD","GET"]],

    
    ["create", "/ajouter", "products:create", ["HEAD","GET"]],
    ["update", "/modifier", "products:update", ["HEAD","GET"]],
    ["delete", "/supprimer", "products:delete", ["HEAD","GET"]],

    // Page de contact
    ["contact", "/contact", "contact:index", ["HEAD","GET","POST"]],

    // Pages de sécurité
    ["login", "/connexion", "security:login", ["HEAD","GET","POST"]],
    ["logout", "/deconnexion", "security:logout", ["HEAD","GET","POST"]],
    ["register", "/inscription", "security:register", ["HEAD","GET","POST"]],
    ["forgotten_password", "/mot-de-passe-oublie", "security:forgotten_password", ["HEAD","GET","POST"]],

    // Page de commande
    ["order", "/panier", "order:index", ["HEAD","GET"]],
    ["add", "/ajout-produit", "order:add", ["HEAD","GET"]],
    ["cancel", "/suppression-commande", "order:delete", ["HEAD","GET"]],

    // Profil utilisateur
    ["account", "/mon-compte", "account", ["HEAD","GET"]],

    //Toujours en dernier du tableau route.
    ["error-404","/404","errors:404",["HEAD", "GET"]]
];

?>