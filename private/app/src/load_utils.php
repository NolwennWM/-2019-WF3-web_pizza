<?php

/**
 * Fichier de chargement automatique des scripts du répertoire /private/app/utils
 */

 //test si la constante UTILS_PATH n'est pas définie.
 if(!defined("UTILS_PATH")){
    define('UTILS_PATH', null);
 }
if(UTILS_PATH != null){
    $utils_scan = scandir(UTILS_PATH);

    // Une boucle sur la liste des entrées $utils_scan
    foreach($utils_scan as $key => $value){
        if(preg_match("/\.php$/", $value)){
            include_once UTILS_PATH.$value;
        }
    }
}
?>