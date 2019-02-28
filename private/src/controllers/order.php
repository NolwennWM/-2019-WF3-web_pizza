<?php
/**
 * Fichier qui gère la page de commande
 */

/**
 * Commande
 */

 function order_index(){
    include_once "../private/src/views/order/index.php";
 }

function order_add(){
   include_once "../private/src/models/products.php";
   include_once "../private/src/models/order.php";

   $isOrderOK = false;
   $isOrderProductOK = false;

   // récupération des données du produit

   // Recup du paramètre ID
   $productID = isset($_GET['id']) ? trim($_GET['id']) : null;

   if (empty($productID)) 
   {
       setFlashbag("warning", "Le produit ne peux pas être ajouté au panier");
       redirect();
   }

   $product = getProduct($productID);

   // récupération des données du client
    $user_sess_id = session_id();
    $user_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;

   // récupération de la commande client
    if ($user_id != null) {
        $order = getOrderByUser($user_id);
    } else {
        $order = getOrderByUser($user_sess_id);
    }

   // création de la commande (si non existante)
    if (!$order) {
        $order = createOrder([ "session" => $user_sess_id, "id" => $user_id ]);
    } else {
        $order = $order['id'];
    }
   // récupération des produits de la commande
    $order_products = getOrderProducts($order);

    if (!$order_products) {
        $order_products = [];
    }
    $add = true;
    foreach ($order_products as $order_product ){
        if ($order_product['id_product'] == $product['id']) {
            $isOrderProductOK = updateProductInOrder($product, $order_product['id']);

            $add = false;
        } 
    }
   // ajout du produit dans la commande (si non existant dans la commande)
    if ($add) {
      $isOrderProductOK = addProductToOrder($product, $order);
   }
   // incrémentation d'une quantité de produit (si existant dans la commande)
    $order_products = getOrderProducts($order);

    $amount = 0;

    foreach ($order_products as $order_product) 
    {
        $qty = $order_product['qty'];
        $price = $order_product['price'];

        $amount+= ($qty * $price);
    }

    $isOrderOK = updateOrderAmount($order, $amount);

    if ($isOrderOK && $isOrderProductOK) {
        setFlashbag("success", "Le produit a été ajouter au panier.");
    } 
    else if ($isOrderOK || $isOrderProductOK) {
        setFlashbag("warning", "Une erreur s'est produite lors de l'ajout du produit au panier");
    } 
    else {
        setFlashbag("danger", "Impossible d'ajouter le produit au panier");
    }
   // redirection de l'utilisateur
    redirect($_SERVER['HTTP_REFERER']);
}
?>