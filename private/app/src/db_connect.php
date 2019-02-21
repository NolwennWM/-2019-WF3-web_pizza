<?php

if(!isset($db_config)){
    $db_config = [];
}

// On boucle sur la liste de config des connexions aux bases de données.
foreach($db_config as $name => $params){
    $db_dsn = $params['type']
            .":host=".$params['host']
            .";port=".$params['port']
            .";dbname=".$params['schema']
            .";charset=".$params['charset'].";";

    $db_user = $params['user'];
    $db_pass = $params['pass'];

    $db[$name] = new PDO($db_dsn, $db_user, $db_pass);

    if($env == "dev"){
        $db[$name]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
}

?>