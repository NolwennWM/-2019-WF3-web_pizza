<?php
/**
 * Fichier qui gère la page des produits
 */

/**
 * Produits
 */

 function products_pizzas(){
     include_once "../private/src/models/products.php";
     $pageTitle = "Nos Pizzas";
     $results= getProducts("pizza");
     include_once "../private/src/views/products/read.php";
 }
 function products_salads(){
    include_once "../private/src/models/products.php";
    $pageTitle = "Nos Salades";
    $results= getProducts("salad");
    include_once "../private/src/views/products/read.php";
 }
 function products_desserts(){
    include_once "../private/src/models/products.php";
    $pageTitle = "Nos Desserts";
    $results= getProducts("dessert");
    include_once "../private/src/views/products/read.php";
 }
 function products_drinks(){
    include_once "../private/src/models/products.php";
    $pageTitle = "Nos Boissons";
    $results= getProducts("drink");
    include_once "../private/src/views/products/read.php";
 }
 function products_menus(){
    include_once "../private/src/models/products.php";
    $pageTitle = "Nos Menus";
    $results= getProducts("menu");
    include_once "../private/src/views/products/read.php";
 }
function products_create(){ 
    if(!isset($_SESSION["user"]) || $_SESSION['user']['email'] != 'admin@admin.admin'){
        redirect();
    }
    include_once "../private/src/models/products.php";
    $price = null;
    $illustration = null;
    $description = null;
    $name = null;
    $type = null;
    $ingredients = [];

    if($_SERVER['REQUEST_METHOD'] ==='POST'){
        $isValid = true;
        global $db;
        global $re;

        $price = isset($_POST['price']) ? trim($_POST['price'] ): null;
        $illustration = isset($_POST['illustration']) ? trim($_POST['illustration'] ): null;
        $description =isset($_POST['description']) ? trim($_POST['description'] ): null;
        $name =isset($_POST['name']) ? trim($_POST['name'] ): null;
        $type =isset($_POST['type']) ? trim($_POST['type'] ): null;
        $ingredients =isset($_POST['ingredients']) ? $_POST['ingredients']: [];

        //contrôle des données
        if(!preg_match($re["name"], $name) || strlen($name)>40){
            $isValid = false;
        }
        if(!preg_match($re["image"], $illustration) || strlen($illustration)>255){
            $isValid = false;
        }
        if(!preg_match($re["name"], $name) ){
            $isValid = false;
        }

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

            $q = $db['main']->prepare("INSERT INTO product_ingredients (`id_product`,`id_ingredient`) VALUES (:product, :ingredient)");
            $q -> bindValue(':product', $article_id, PDO::PARAM_INT);
            foreach($ingredients as $ingr){
                $q -> bindValue(':ingredient', $ingr);
                $q -> execute();
            }

            setFlashbag("success", "Le produit a été ajouté");
            redirect();
        }
    }
    include_once "../private/src/views/products/create.php";
}
function products_delete(){
    if(!isset($_SESSION["user"]) || $_SESSION['user']['email'] != 'admin@admin.admin'){
        redirect();
    }
    
    global $db;
    $article_id = isset($_GET['id']) ? trim($_GET['id']) : null;

    if(empty($article_id)){
        echo "L'ID de l'article n'est pas défini...";
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] ==='POST'){
        $q = $db['main']->prepare("DELETE FROM product_ingredients WHERE id_product=:id");
        $q -> bindValue(":id", $article_id, PDO::PARAM_INT);
        $q-> execute();
        $q = $db['main']->prepare("DELETE FROM products WHERE id=:id");
        $q -> bindValue(":id", $article_id, PDO::PARAM_INT);
        $q-> execute();
        setFlashbag("success", "Le produit a été supprimé");
        redirect();
    }

    $q = $db['main']->prepare("SELECT price, illustration, description, name, type FROM products WHERE id=:id");
    $q -> bindValue(":id", $article_id, PDO::PARAM_INT);
    $q -> execute();

    $article= $q->fetch(PDO::FETCH_ASSOC);
    include_once "../private/src/views/products/delete.php";
}
/**
 * Mise à jour du produit.
 *
 * @return void
 */
function products_update(){
    if(!isset($_SESSION["user"]) || $_SESSION['user']['email'] != 'admin@admin.admin'){
        redirect();
    }
    include_once "../private/src/models/products.php";
    $price = null;
    $illustration = null;
    $description = null;
    $name = null;
    $type = null;
    $ingredients = [];
    global $db;

    $article_id = isset($_GET['id']) ? trim($_GET['id']) : null;
    
    if(empty($article_id)){
        echo "L'ID de l'article n'est pas défini...";
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] ==='POST'){
        $isValid = true;
        global $re;

        $price = isset($_POST['price']) ? trim($_POST['price'] ): null;
        $illustration = isset($_POST['illustration']) ? trim($_POST['illustration'] ): null;
        $description =isset($_POST['description']) ? trim($_POST['description'] ): null;
        $name =isset($_POST['name']) ? trim($_POST['name'] ): null;
        $type =isset($_POST['type']) ? trim($_POST['type'] ): null;
        $ingredients =isset($_POST['ingredients']) ? $_POST['ingredients']: [];

        //contrôle des données
        if(!preg_match($re["name"], $name) || strlen($name)>40){
            $isValid = false;
        }
        if(!preg_match($re["image"], $illustration) || strlen($illustration)>255){
            $isValid = false;
        }
        if(!preg_match($re["name"], $name) ){
            $isValid = false;
        }

        if($isValid){
            // $q = $db['main']->prepare("SELECT id_ingredient FROM product_ingredients WHERE id_product=:id");
            // $q -> bindValue(':id', $article_id, PDO::PARAM_INT);
            // $q -> execute();
            // $oldIngredients = $q->fetchAll(PDO::FETCH_ASSOC);

            // $q = $db['main']->prepare("INSERT INTO product_ingredients (`id_product`,`id_ingredient`) VALUES (:product, :ingredient)");
            // $q -> bindValue(':product', $article_id, PDO::PARAM_INT);
            // foreach($oldIngredients as $ing){
            //     if(!in_array($ing['id_ingredient'], $ingredients)){
            //         $q -> bindValue(':ingredient', $article_id, PDO::PARAM_INT);
            //         $q -> execute();
            //     }
            // }
            
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

            setFlashbag("success", "Le produit a bien été mis à jour");
            redirect();
        }
    }
    $q = $db['main']->prepare("SELECT t1.price AS price, t1.description AS description, t1.name AS name, t1.type AS type, t1.illustration AS illustration, t3.name AS ingname  
    FROM products AS t1 INNER JOIN product_ingredients AS t2 ON t2.id_product=:id INNER JOIN ingredients AS t3 ON t3.id=t2.id_ingredient WHERE t1.id=:id");
    $q -> bindValue(":id", $article_id, PDO::PARAM_INT);
    $q -> execute();

    $article= $q->fetchAll(PDO::FETCH_ASSOC);
    if($article){
        $price = $article[0]['price'];
        $illustration = $article[0]['illustration'];
        $description = $article[0]['description'];
        $name = $article[0]['name'];
        $type = $article[0]['type'];
        foreach($article as $dat){
            array_push($ingredients, $dat['ingname']);
        }
    }
        include_once "../private/src/views/products/update.php";
}


?>