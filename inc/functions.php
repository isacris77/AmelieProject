<?php

function debug($var){
    echo '<pre>';
        print_r($var);
    echo '</pre>';    
}



function executeRequete($requete, $param = array()){


    foreach ($param as $indice => $valeur) {
       $param[$indice] = htmlspecialchars($valeur);
    }

    global $bdd;


    $resultat = $bdd->prepare($requete);

    $succes = $resultat->execute($param);

    if ($succes) {
       return $resultat;
    } else {
        return false;
    }
}






