<?
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


    $resulat = $pdo->prepare($requete);

    $succes = $resulat->execute($param);

    if ($succes) {
       return $resulat;
    } else {
        return false;
    }
}






