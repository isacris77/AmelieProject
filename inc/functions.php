<?php

function debug($var){
    echo '<pre>';
        print-r($var);
    echo '</pre>';    
}

function executeRequete($requete, $param = array()){


    foreach ($param as $indice => $valeur) {
       $param[$indice] = htmlspecialchars($valeur);
    }

    global $pdo;


    $resultat = $pdo->prepare($requete);

    $succes = $resultat->execute($param);

    if ($succes) {
       return $resultat;
    } else {
        return false;
    }
}






