<?php
require_once 'inc/init.php';
$affiche_formulaire = true; // Pour afficher le formulaire tant que le membre n'est pas inscrit

//--------------------TRAITEMENT PHP --------------------------------------

debug($_POST);

if(!empty($_POST)){ // si $_POST n'est pas vide c'est que le formulaire a Ã©tÃ© envoyÃ©
    // validation du formulaire :
        if (!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo'])  > 20) { // si le pseudo n'existe pas dans $_POST c'est que le formulaire est altÃ©rÃ©, ou la valeur est < 4 ou la valeur est > 20 (pour la BDD), on met un message d'errur Ã  l'internaute
            $contenu.= '<div class="alert alert-danger">Le pseudo doit contenir entre 4 et 20 caractÃ¨res.</div>';
          }

            if (!isset($_POST['mdp']) || strlen($_POST['mdp']) < 4 || strlen($_POST['mdp'])  > 20) { 
            $contenu.= '<div class="alert alert-danger">Le mot de passe doit contenir entre 4 et 20 caractÃ¨res.</div>';
          }

             if (!isset($_POST['nom']) || strlen($_POST['nom']) < 1 || strlen($_POST['nom'])  > 20) { 
            $contenu.= '<div class="alert alert-danger">Le nom doit contenir entre 1 et 20 caractÃ¨res.</div>';
          }


             if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 1 || strlen($_POST['prenom'])  > 20) { 
            $contenu.= '<div class="alert alert-danger">Le prÃ©nom doit contenir entre 1 et 20 caractÃ¨res.</div>';
          }

            if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) || strlen($_POST['email']) > 50 ){ // la fonction prÃ©dÃ©finie filter_var() avec l'argument FILTER_VALIDATE_EMAIL vÃ©rifie que le string fourni est un email
                $contenu.= '<div class="alert alert-danger">L\'email n\'est pas valide</div>';

          }
          if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 4 || strlen($_POST['adresse'])  > 50) { 
            $contenu.= '<div class="alert alert-danger">L\'adresse doit contenir entre 4 et 50 caractÃ¨res.</div>';
          } 
          
          if (!isset($_POST['code_postal']) || !preg_match('#^[0-9]{5}$#', $_POST['code_postal'])) {
                  $contenu.= '<div class="alert alert-danger">Le code postal n\'est pas valide.</div>';
            }


             if (!isset($_POST['ville']) || strlen($_POST['ville']) < 1 || strlen($_POST['ville'])  > 20) { 
            $contenu.= '<div class="alert alert-danger">La ville doit contenir entre 1 et 20 caractÃ¨res.</div>';
          }



           



            //------------
            // S'il n'y a plus d'erreur sur le formulaire, on vÃ©rifie si le pseudo existe ou pas avant d'inscrire l'internaute en BDD :


                if(empty($contenu)){ // si la variable vide, c'est qu'il n'y a pas de message d'erreur

                    // on vÃ©rifie le pseudo en BDD :
                        $resultat = executeRequete("SELECT * FROM espace_membre WHERE pseudo = :pseudo",array(':pseudo' => $_POST['pseudo']));

                 if ($resultat->rowCount() > 0 ){ // si la requete retourne 1 OU pls lignes c'est que le pseudo est deja en bdd
                    $contenu .= '<div class="alert alert-danger">Pseudo indisponible. Veuillez en choisir un autre.</div>';


                 } else {
                     // sinon on fait l'inscription en BDD
                    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT); // nous hachons le mot de passe avec l'algorithme bcrypt par dÃ©faut qui nous retourne une clÃ© de hachage. Nous allons l'insÃ©rer en BDD
                    //  debug($mdp);
                    $succes=executeRequete(
                        "INSERT INTO espace_membre (pseudo, mdp, nom, prenom, email, adresse, code_postal, ville) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :adresse, :code_postal, :ville) ", 
                        array(':pseudo' => $_POST['pseudo'],
                        ':mdp' => $mdp, // on prend le mdp hachÃ© 
                        ':nom' => $_POST['nom'],
                        ':prenom' => $_POST['prenom'],
                        ':email' => $_POST['email'],
                       ':adresse' => $_POST['adresse'],
                        ':code_postal' => $_POST['code_postal'],
                        ':ville' => $_POST['ville'],
                                  
                      
                    
                    
                    
                    ));

                    $contenu .= '<div class="alert alert-success">Vous avez ajoutÃ© le contact. </div>';

                    $affiche_formulaire = false; // pour ne plus afficher le formulaire d'insciption ci-dessous





                 }
                
                }  // fin du if(!empty($contenu))

} // fin de if(!empty($_POST))





//--------------------AFFICHE --------------------------------------
require_once 'inc/header.php';
?>
<h1 class="mt-4 ptxxl">Inscription</h1>
<?php
echo $contenu; // pour les messages Ã  l'internaute
if ($affiche_formulaire):  // syntaxe en if ():  ....endif oÃ» le ":" correspond Ã  l'accolade ouvrante et le endif Ã  la fermante. Si le membre n'est pas inscrit on lui affiche le formulaire.
?>
<div class="container">
<form method="post" action="">

    <div><label for="pseudo">Pseudo</label></div>
    <div><input type="text" name="pseudo" id="pseudo" value="<?php echo $_POST['pseudo'] ?? '';?>"></div>

    <div><label for="mdp">Mot de passe</label></div>
    <div><input type="password" name="mdp" id="mdp" value="<?php echo $_POST['mdp'] ?? '';?>"></div>

    <div><label for="nom">Nom</label></div>
    <div><input type="text" name="nom" id="nom" value="<?php echo $_POST['nom'] ?? '';?>"></div>

    <div><label for="prenom">Prénom</label></div>
    <div><input type="text" name="prenom" id="prenom" value="<?php echo $_POST['prenom'] ?? '';?>"></div>

    <div><label for="email">Email</label></div>
    <div><input type="text" name="email" id="email" value="<?php echo $_POST['email'] ?? '';?>"></div>

    <div><label for="adresse">Adresse</label></div>
    <div><textarea name="adresse" id="adresse" col="30" rows="10"><?php echo $_POST['adresse'] ?? '';?></textarea></div>

    <div><label for="code_postal">Code Postal</label></div>
    <div><input type="text" name="code_postal" id="code_postal" value="<?php echo $_POST['code_postal'] ?? '';?>"></div>

    <div><label for="ville">Ville</label></div>
    <div><input type="text" name="ville" id="ville" value="<?php echo $_POST['ville'] ?? '';?>"></div>
      

   
    <div><input type="submit"  value="S'inscrire" class="btn btn-info"></div>

</form>
</div>

       




<?php


endif;
require_once 'inc/footer.php';
