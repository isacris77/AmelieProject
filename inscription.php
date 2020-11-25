<?php
require_once 'inc/init.php';
$affiche_formulaire = true; 

//--------------------TRAITEMENT PHP --------------------------------------

// debug($_POST);

if(!empty($_POST)){
    // validation du formulaire :

//pseudo
        if (!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo'])  > 20) { 
            $contenu.= '<div class="alert alert-danger">Le pseudo doit contenir entre 4 et 20 caractères.</div>';
          }
//mdp
            if (!isset($_POST['mdp']) || strlen($_POST['mdp']) < 4 || strlen($_POST['mdp'])  > 20) { 
            $contenu.= '<div class="alert alert-danger">Le mot de passe doit contenir entre 4 et 20 caractères.</div>';
          }
//nom
             if (!isset($_POST['nom']) || strlen($_POST['nom']) < 1 || strlen($_POST['nom'])  > 20) { 
            $contenu.= '<div class="alert alert-danger">Le nom doit contenir entre 1 et 20 caractères.</div>';
          }

//prenom
             if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 1 || strlen($_POST['prenom'])  > 20) { 
            $contenu.= '<div class="alert alert-danger">Le prénom doit contenir entre 1 et 20 caractères.</div>';
          }
//email
            if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) || strlen($_POST['email']) > 50 ){ 
                $contenu.= '<div class="alert alert-danger">L\'email n\'est pas valide</div>';
//adress
          }
          if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 4 || strlen($_POST['adresse'])  > 50) { 
            $contenu.= '<div class="alert alert-danger">L\'adresse doit contenir entre 4 et 50 caractères.</div>';
          } 
//code postal          
          if (!isset($_POST['code_postal']) || !preg_match('#^[0-9]{5}$#', $_POST['code_postal'])) {
                  $contenu.= '<div class="alert alert-danger">Le code postal n\'est pas valide.</div>';
            }

//ville
             if (!isset($_POST['ville']) || strlen($_POST['ville']) < 1 || strlen($_POST['ville'])  > 20) { 
            $contenu.= '<div class="alert alert-danger">La ville doit contenir entre 1 et 20 caractères.</div>';
          }



           



            //------------
            // S'il n'y a plus d'erreur sur le formulaire, on vérifie si le pseudo existe ou pas avant d'inscrire l'internaute en BDD :


                if(empty($contenu)){ 

                    // on vérifie le pseudo en BDD :
                        $resultat = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo",array(':pseudo' => $_POST['pseudo']));

                 if ($resultat->rowCount() > 0 ){ 
                    $contenu .= '<div class="alert alert-danger">Pseudo indisponible. Veuillez en choisir un autre.</div>';


                 } else {
                     // sinon on fait l'inscription en BDD
                    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT); 
                    $succes=executeRequete(
                        "INSERT INTO membre (pseudo, mdp, nom, prenom, email, adresse, code_postal, ville, statut) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :adresse, :code_postal, :ville, :statut) ", 
                        array(':pseudo' => $_POST['pseudo'],
                        ':mdp' => $mdp, 
                        ':nom' => $_POST['nom'],
                        ':prenom' => $_POST['prenom'],
                        ':email' => $_POST['email'],
                       ':adresse' => $_POST['adresse'],
                        ':code_postal' => $_POST['code_postal'],
                        ':ville' => $_POST['ville'],
                        ':statut' => 0 
                                  
                      
                    
                    
                    
                    ));

                    $contenu .= '<div class="alert alert-success">Vous avez ajouté le contact. </div>';

                    $affiche_formulaire = false; 





                 }
                
                }  // fin du if(!empty($contenu))

} // fin de if(!empty($_POST))





//--------------------AFFICHE --------------------------------------
require_once 'inc/header.php';
?>


<div class="container"> 
<h1 class=" ptxxl">Inscription</h1>
<?php
echo $contenu; 
if ($affiche_formulaire):  
?>

<form id="inscription" method="post" class="form" action="">
  

  <div class="row mbs">
    <div class=" col-md-6 ">
      <label for="pseudo">Pseudo</label>
      <input type="text" class="form-control" name="pseudo" id="pseudo" value="<?php echo $_POST['pseudo'] ?? '';?>">
    </div>
    <div class=" col-md-6 ">
      <label for="mdp">Mot de passe</label>
      <input type="password" class="form-control" name="mdp" id="mdp" value="<?php echo $_POST['mdp'] ?? '';?>">
    </div>
  </div>

  <div class="row mbs">
    <div class=" col-md-6 ">
      <label for="nom">Nom</label>
       <input type="text" class="form-control"name="nom" id="nom" value="<?php echo $_POST['nom'] ?? '';?>">
     </div>
    <div class=" col-md-6 ">
     <label for="prenom">Prénom</label>
      <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $_POST['prenom'] ?? '';?>">
    </div>
  </div>

  <div class="mbs">
    <label for="email">Email</label>
    <input type="text" class="form-control" name="email" id="email" value="<?php echo $_POST['email'] ?? '';?>">
  </div>

  <div class="mbs"> 
      <label for="adresse">Adresse</label>
      <input type="text" class="form-control" id="adresse" name="adresse"><?php echo $_POST['adresse'] ?? '';?>
  </div>

  <div class="row mbs">
    <div class=" col-md-6 ">
        <label for="ville">Ville</label>
        <input type="text" class="form-control" id="ville" name="ville" value="<?php echo $_POST['ville'] ?? '';?>">
    </div>
                  
    <div class=" col-md-6 ">
      <label for="cp">Code postal</label>
      <input type="text" class="form-control" name="code_postal" id="code_postal"value="<?php echo $_POST['code_postal'] ?? '';?>">
    </div>
    
  </div>
  <input type="submit"  value="S'inscrire" class="btn btn-info">
</form>
</div>

       




<?php


endif;
require_once 'inc/footer.php';
