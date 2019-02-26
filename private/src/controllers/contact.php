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
      if($send){
         $query = $db["main"]->prepare("INSERT INTO `webpizza`.`messages` (`firstname`, `lastname`, `email`, `message`, `sending_timestamp`) 
                           VALUES (:firstname, :lastname, :email, :message, :timer)");
         $query -> bindValue(':firstname', $firstname, PDO::PARAM_STR_CHAR);
         $query -> bindValue(':lastname', $lastname, PDO::PARAM_STR_CHAR);
         $query -> bindValue(':email', $email, PDO::PARAM_STR);
         $query -> bindValue(':message', $message, PDO::PARAM_STR);
         $query -> bindValue(':timer', time(), PDO::PARAM_INT);
         $result = $query->execute();

         if($result){
            setFlashbag('success', "Le message a bien été envoyé");
         }else{
            setFlashbag('danger', "Le message n'a pas pu être envoyé");
         }
      }
   }else{
      echo "Le formulaire ne peut être traité qu'avec la méthode POST";
   }
   redirect($_SERVER[HTTP_REFERER]);
}

?>