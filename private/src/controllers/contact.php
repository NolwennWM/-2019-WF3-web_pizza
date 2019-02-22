<?php
/**
 * Fichier qui gère la page de contact
 */

/**
 * Contact
 */

function contact_index(){
   if($_SERVER['REQUEST_METHOD'] === "POST"){
      $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
      $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
      $email = isset($_POST['email']) ? $_POST['email'] : null;
      $message = isset($_POST['message']) ? $_POST['message'] : null;
      $timer = date('l j F Y H');
      $send = true;
      global $re;
      global $db;

      if(!preg_match($re["firstname"], $firstname)){
         $send = false;
      }
      if(!preg_match($re["lastname"], $lastname)){
         $send = false;
      }
      if(!preg_match($re["email"], $email)){
         $send = false;
      }
      if(strlen($message) <10 ){
         $send = false;
      }
      var_dump($db['main']);
      if($send){
         $db["main"]->beginTransaction();
         $db["main"]->exec("INSERT INTO `webpizza`.`messages` (`firstname`, `lastname`, `email`, `times`, `messages`) 
                           VALUES (".$firstname.",". $lastname.",". $email.",". $timer.",". $message.");");
         $db["main"]->commit();
      }
   }else{
      echo "Le formulaire ne peut être traité qu'avec la méthode POST";
   }
}

?>