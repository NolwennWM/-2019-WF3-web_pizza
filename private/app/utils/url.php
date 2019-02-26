<?php

function url($routName){
    global $routes;
    if(!isset($routes)){
        return '/';
    }
    foreach($routes as $route){
        if($route[0]==$routName){
            return $route[1];
        }
    }
}

?>