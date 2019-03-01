<?php

function getProducts($type){
    global $db;
    $q = $db['main']->query("SELECT id, name, illustration, price FROM products WHERE `state` = '1' AND `type`= '".$type."'");
    return $q->fetchAll(PDO::FETCH_ASSOC);
}
function getProductsByIdList($list){
    global $db;
    $q = $db['main']->query("SELECT id, name FROM products WHERE `id` IN (".implode(',',$list).")");
    return $q->fetchAll(PDO::FETCH_COLUMN |PDO::FETCH_GROUP);
}
/**
 * Recupération d'un produit
 *
 * @param [type] $id
 * @return void
 */
function getProduct($id)
{
    global $db;

    $sql = "SELECT id, name, price, illustration FROM products WHERE id=:id";

    $q = $db['main']->prepare($sql);
    $q->bindValue(':id', $id, PDO::PARAM_INT);
    $q->execute();

    return $q->fetch(PDO::FETCH_ASSOC);
}

function getIngredients(){
    global $db;
    return $db['main']->query("SELECT id, name FROM ingredients ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
}
?>