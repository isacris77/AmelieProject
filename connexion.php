<?php

require_once 'inc/init.php';
//--------------------TRAITEMENT PHP--------------------
$message =''; // pour afficher le message de dÃ©connexion

//2 - DÃ©connexion de l'internaute

// debug($_GET);

if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') { // si le membre a cliquÃ© sur "deconnexion"

    unset($_SESSION['id_membre']); // on ne fait pas un session_destroy(qui supprimerait toute la session car on veut pouvoir conserver le panier de l'internaute).
    $message='<div class="alert alert-info">Vous Ãªtes deconnectÃ©?</div>';

}

// 3 - Le membre deja connectÃ© et redirigÃ© vers son profil
if(estConnecte()){
        header ('location:profil.php'); // Nous affichons le formulaire de connexion qu'aux membres non connectÃ©s. Les autres sont redirigÃ©s vers le profil
        exit(); // pour quitter le script 

}



// 1 - traitement du formulaire
// debug($_POST);

if (!empty($_POST)){ //si le formulaire a Ã©tÃ© envoyÃ©

        // controle du formulaire

        if(empty($_POST['pseudo']) || empty($_POST['mdp'])){ // si le champ pseudo ou le champ mdp sont vides ou non dÃ©finis
            $contenu.='<div class="alert alert-danger">Les identifiants sont obligatoires</div>';
        }


        //s'il n'y a pas de message d'erreur Ã  l'internaute, on cherche le pseudo en BDD

        if(empty($contenu)) { // si c'est vide c'est qu'il n'y a pas d'erreur

            $resultat = executeRequete("SELECT * FROM espace_membre WHERE pseudo =:pseudo", array(':pseudo' => $_POST['pseudo']));

            if($resultat -> rowCount()==1){ // si il y a 1 ligne de rÃ©sultat alors le pseudo existe  : on peut vÃ©rifier le MDP
                $membre = $resultat->fetch(PDO::FETCH_ASSOC); // on "fetche" l'object $resultat pour en extraire les donnÃ©es du membre (pas de boucle) car le pseudo est unique

                // debug($membre); 


                // on vÃ©rifie le mdp
                if(password_verify($_POST['mdp'],$membre['mdp'])){ //  si le mdp du formulaire correspond au hash du mdp en BDD  alors cette fonction retourne true
                    // on connecte le membre 

                    $_SESSION['id_membre'] = $membre; // nous remplissons la session(ouverte avec le session_start dans init.php) avec les infos du membre qui proviennent de la BDD

                    // puis on redirige vers la page de profil : 
                    header('location:profil.php'); 
                    exit(); // et on quitte le script

                
                } else { // sinon dÃ¨s que les mdp ne correspond pas 
                   $contenu.='<div class="alert                     alert-danger">Erreur sur le mot de passe</div>'; 
                }

                
            } else { // s'il n'y a pas de ligne de rÃ©sultat, c'est que le pseudo n'existe pas en BDD
                $contenu .='<div class="alert alert-danger">Erreur sur le pseudo</div>';
            }

        } // fin du if(empty($contenu))






} // fin du if (!empty($_POST))





//------------------------------affichage----------------------------
require_once 'inc/header.php';
?>
<h1 class="mt-4">Connexion</h1>

<?php
echo $message; // pour les messages de deconnexion 
echo $contenu; // pour les messages de connexion
?>
<div class="container">
<form action="" method="post">

    <div><label for="pseudo">Pseudo</label></div>
    <div><input type="text" name="pseudo" id="pseudo"></div>

    <div><label for="mdp">Mot de passe</label></div>
    <div><input type="password" name="mdp" id="mdp"></div>

    <input type="submit" value="se connecter" class="btn btn-info"></div>

</form>


<?php
require_once 'inc/footer.php';