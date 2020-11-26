<?php
//FONCTIONS DU SITE 


function debug($var){
    echo '<pre>';
        print_r($var);
    echo '</pre>';    
}


//-----------
// fonction qui indique si l'internaute est connecté

function estConnecte(){
    if (isset($_SESSION['membre'])){ 


        return true; 

    }   else{
            return false; 
    }

}


//fonction qui indique si le membre connecté est administrateur 

function estadmin(){ 
    if (estconnecte() && $_SESSION['membre']['statut'] == 1 ){
        return true; 
    } else{
        return false; 
    }
}


//----------
// fonction qui exÃ©cute les requetes

function executeRequete($requete, $param = array()){ 
   
    foreach ($param as $indice => $valeur) {
        $param[$indice] = htmlspecialchars($valeur);
    }

    global $bdd; 

    $resultat = $bdd->prepare($requete); 
    $succes = $resultat->execute($param); 

  
    
    if($succes){ 

        return $resultat;

    } else {
        return false; 
    }
}





