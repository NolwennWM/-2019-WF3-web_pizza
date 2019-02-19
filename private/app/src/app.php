<?php

// Inclusion des differents fichiers.

// Intégration de la configuration.
require_once "../private/app/config/config.php";
// Définition de l'environnement.
require_once "../private/app/src/environnement.php";
// Comportement des erreurs.
require_once "../private/app/src/err_reporting.php";
// Connections aux bases de données.
require_once "../private/app/src/db_connect.php";
// Routage de l'application.
require_once "../private/app/src/routing.php";
// Compilation
require_once "../private/app/src/compile.php";

?>