<?php

function debug($var){
    echo '<pre>';
        print_r($var);
    echo '</pre>';    
}

//-----------
// fonction qui indique si l'internaute est connecté

function estConnecte(){
    if (isset($_SESSION['membre'])){ // si membre existe dans la session c'est que l'internaute est passé par la page de connexion avec les bons pseudos et mdp


        return true; // il est connecté

    }   else{
            return false; // il n'est pas connecté
    }

}


//fonction qui indique si le membre connecté est administrateur 

function estadmin(){ // si le membre est connecté alors on regarde son statut dans la session. S'il vaut 1 alors il est bien admin. 
    if (estconnecte() && $_SESSION['membre']['statut'] == 1 ){
        return true; // le membre est admin connecté
    } else{
        return false; // il ne l'est pas 
    }
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






