<?php

//fonction du site

function debug($var){
    echo '<pre>';
        print-r($var);
    echo '</pre>';    
}



//---------------
// fonction qui indique que l'internaute est connectÃ©
/// A ETUDIER

function estConnecte(){
    if (isset($_SESSION['membre'])){ // si membre existe dans la session c'est que l'internaute est passé par la page de connexion avec les bons pseudos et mdp


        return true; // il est connecté

    }   else{
            return false; // il n'est pas connecté
    }

}



// fonction qui exÃ©cute les requetes
function executeRequete($requete, $param = array()){


    foreach ($param as $indice => $valeur) {
       $param[$indice] = htmlspecialchars($valeur);
    }

    global $pdo;


    $resulat = $pdo->prepare($requete);

    $succes = $resulat->execute($param);

    if ($succes) {
       return $resulat;
    } else {
        return false;
    }
}






