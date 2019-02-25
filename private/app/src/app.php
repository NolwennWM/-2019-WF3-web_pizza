<?php
// Démarage de la session.
session_start();
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
// Inclusion des fonctions "Utils".
require_once "../private/app/src/load_utils.php";
// Compilation de la page.
require_once "../private/app/src/compile.php";


?>