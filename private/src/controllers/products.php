<?php
/**
 * Fichier qui gère la page des produits
 */

/**
 * Produits
 */

 function products_pizzas(){
    global $db;
    $q = $db['main']->query("SELECT id, name, illustration, price FROM products WHERE `type`= 'pizza'");
    $results= $q->fetchAll(PDO::FETCH_ASSOC);
     include_once "../private/src/views/products/pizzas.php";
 }
 function products_salads(){
    global $db;
    $q = $db['main']->query("SELECT id, name, illustration, price FROM products WHERE `type`= 'salad'");
    $results= $q->fetchAll(PDO::FETCH_ASSOC);
     include_once "../private/src/views/products/salads.php";
 }
 function products_desserts(){
    global $db;
    $q = $db['main']->query("SELECT id, name, illustration, price FROM products WHERE `type`= 'dessert'");
    $results= $q->fetchAll(PDO::FETCH_ASSOC);
     include_once "../private/src/views/products/desserts.php";
 }
 function products_drinks(){
    global $db;
    $q = $db['main']->query("SELECT id, name, illustration, price FROM products WHERE `type`= 'drink'");
    $results= $q->fetchAll(PDO::FETCH_ASSOC);
     include_once "../private/src/views/products/drinks.php";
 }
 function products_menus(){
    global $db;
    $q = $db['main']->query("SELECT id, name, illustration, price FROM products WHERE `type`= 'menu'");
    $results= $q->fetchAll(PDO::FETCH_ASSOC);
     include_once "../private/src/views/products/menus.php";
 }
 if(isset($_SESSION["user"]) && $_SESSION['user']['email']== 'admin@admin.admin'){
    function products_create(){ 
        $price = null;
        $illustration = null;
        $description = null;
        $name = null;
        $type = null;
    
    if($_SERVER['REQUEST_METHOD'] ==='POST'){
        $isValid = true;
        global $db;
    
        $price = isset($_POST['price']) ? trim($_POST['price'] ): null;
        $illustration = isset($_POST['illustration']) ? trim($_POST['illustration'] ): null;
        $description =isset($_POST['description']) ? trim($_POST['description'] ): null;
        $name =isset($_POST['name']) ? trim($_POST['name'] ): null;
        $type =isset($_POST['type']) ? trim($_POST['type'] ): null;
    
        //contrôle des données
    
        if($isValid){
            $q = $db['main']->prepare("INSERT INTO products (`price`,`illustration`,`description`,`name`,`type`) 
                                            VALUES (:price, :illustration, :description, :name, :type)");
            $q -> bindValue(':price', $price, PDO::PARAM_STR);
            $q -> bindValue(':illustration', $illustration, PDO::PARAM_STR);
            $q -> bindValue(':description', $description, PDO::PARAM_STR);
            $q -> bindValue(':name', $name, PDO::PARAM_STR);
            $q -> bindValue(':type', $type, PDO::PARAM_STR);
    
            $q -> execute();
    
            $article_id = $db['main']->lastInsertId();
            redirect();
        }
    }
        include_once "../private/src/views/products/crud/create.php";
    }
    function products_delete(){
        
        global $db;
        $article_id = isset($_GET['id']) ? trim($_GET['id']) : null;

        if(empty($article_id)){
            echo "L'ID de l'article n'est pas défini...";
            exit();
        }

        if($_SERVER['REQUEST_METHOD'] ==='POST'){
            $q = $db['main']->prepare("DELETE FROM products WHERE id=:id");
            $q -> bindValue(":id", $article_id, PDO::PARAM_INT);
            $q-> execute();
            redirect();
        }

        $q = $db['main']->prepare("SELECT price, illustration, description, name, type FROM products WHERE id=:id");
        $q -> bindValue(":id", $article_id, PDO::PARAM_INT);
        $q -> execute();

        $article= $q->fetch(PDO::FETCH_ASSOC);
        include_once "../private/src/views/products/crud/delete.php";
    }
    function products_update(){$price = null;
        $illustration = null;
        $description = null;
        $name = null;
        $type = null;
        global $db;

        $article_id = isset($_GET['id']) ? trim($_GET['id']) : null;
        
        if(empty($article_id)){
            echo "L'ID de l'article n'est pas défini...";
            exit();
        }
    
    if($_SERVER['REQUEST_METHOD'] ==='POST'){
        $isValid = true;
    
        $price = isset($_POST['price']) ? trim($_POST['price'] ): null;
        $illustration = isset($_POST['illustration']) ? trim($_POST['illustration'] ): null;
        $description =isset($_POST['description']) ? trim($_POST['description'] ): null;
        $name =isset($_POST['name']) ? trim($_POST['name'] ): null;
        $type =isset($_POST['type']) ? trim($_POST['type'] ): null;
    
        //contrôle des données
    
        if($isValid){
            $q = $db['main']->prepare("UPDATE products SET `price`= :price, `description`= :description, 
                                        `name`= :name, `type`= :type, `illustration`= :illustration WHERE id=:id");
            $q -> bindValue(':price', $price, PDO::PARAM_STR);
            $q -> bindValue(':illustration', $illustration, PDO::PARAM_STR);
            $q -> bindValue(':description', $description, PDO::PARAM_STR);
            $q -> bindValue(':name', $name, PDO::PARAM_STR);
            $q -> bindValue(':type', $type, PDO::PARAM_STR);
            $q -> bindValue(':id', $article_id, PDO::PARAM_INT);
    
            $q -> execute();
    
            $article_id = $db['main']->lastInsertId();
            redirect();
        }
    }
    $q = $db['main']->prepare("SELECT price, description, name, type, illustration  FROM products    WHERE id=:id");
    $q -> bindValue(":id", $article_id, PDO::PARAM_INT);
    $q -> execute();

    $article= $q->fetch(PDO::FETCH_ASSOC);

    if($article){
        $price = $article['price'];
        $illustration = $article['illustration'];
        $description = $article['description'];
        $name = $article['name'];
        $type = $article['type'];
    }
        include_once "../private/src/views/products/crud/update.php";
    }
 }
 else{
     redirect();
 }

?>