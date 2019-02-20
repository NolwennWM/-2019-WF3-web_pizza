<?php

if(!function_exists("randstr")){
    /**
     * Renvoi une chaine de caractère de la longueur donné en paramètre,
     * Elle contient de base des majuscules et des entiers mais ces paramètres
     * Peuvent être placé sur false.
     *
     * @param integer $longueur
     * @param boolean $maj
     * @param boolean $entier
     * @return string
     */
    function randstr(int $longueur, $maj=true, $entier=true) : string{
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longueurMin = ($entier ? 0:10);
        $longueurMax = ($maj ? strlen($caracteres)-1 : strlen($caracteres)-27);
        $chaineAleatoire = '';
        for ($i = 0; $i < $longueur; $i++){
            $chaineAleatoire .= $caracteres[rand($longueurMin, $longueurMax)];
            }
                    
        return $chaineAleatoire;
    }
}

?>