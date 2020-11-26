<?php

require_once'../inc/init.php';


//----------------traitement PHP


if(!estAdmin()){ 
header('location:../connexion.php');
exit();

}

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



          if(empty($contenu)){ 

          
                $resultat = executeRequete("SELECT * FROM membre WHERE email = :email",array(':email' => $_POST['email']));

         if ($resultat->rowCount() > 0 ){ 
            $contenu .= '<div class="alert alert-danger">Email déja enregistré. Veuillez en choisir un autre.</div>';


         } else {
            
            $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT); 
          
            $requete=executeRequete(
                "REPLACE INTO membre VALUES (:pseudo, :mdp, :nom, :prenom, :email, :adresse, :code_postal, :ville, :statut) ", 
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

         if($requete){
                $contenu .= '<div class="alert alert-success">Vous avez ajouté le contact. </div>';

         } else{
            $contenu .= ' <div class ="alert alert-danger">Erreur lors de l\'enregistrement du contact. Veuillez essayer à nouveau </div>';
         }
        }

     
                          
            

    } // fin du if(!empty($contenu))
} // fin du if(!empty($_POST))


if (isset($_GET['id_membre'])) {
   $resultat = executeRequete(" SELECT * FROM membre WHERE id_membre = :id_membre", array(':id_membre' => $_GET['id_membre']));

        $membre=$resultat->fetch(PDO::FETCH_ASSOC); 
}


//-------------------affichage


require_once '../inc/header.php'

?>

<div class="container">
<h1 class="mt-4">Gestion des Membres</h1>

<ul class="nav nav-tabs">
    <li><a href="gestion_membre.php" class="nav-link active">Affichage des membres</a></li>
    <li><a href="ajouter_membre.php" class="nav-link">	Ajouter un membre</a></li>
</ul>

<?php
echo $contenu;

?>

<!-- // formulaire ajout ou modification de contact -->


<form action="" method="post">


<input type="hidden" name="id_membre" value="<?php echo $membre['id_membre']?? 0; ?>">


<div class="row mbs">
    <div class=" col-md-6 ">
      <label for="pseudo">Pseudo</label>
      <input type="text" class="form-control" name="pseudo" id="pseudo" value="<?php echo $membre['pseudo'] ?? '';?>">
    </div>
    <div class=" col-md-6 ">
      <label for="mdp">Mot de passe</label>
      <input type="password" class="form-control" name="mdp" id="mdp" value="<?php echo $membre['mdp'] ?? '';?>">
    </div>
  </div>

  <div class="row mbs">
    <div class=" col-md-6 ">
      <label for="nom">Nom</label>
       <input type="text" class="form-control"name="nom" id="nom" value="<?php echo $membre['nom'] ?? '';?>">
     </div>
    <div class=" col-md-6 ">
     <label for="prenom">Prénom</label>
      <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $membre['prenom'] ?? '';?>">
    </div>
  </div>

  <div class="mbs">
    <label for="email">Email</label>
    <input type="text" class="form-control" name="email" id="email" value="<?php echo $membre['email'] ?? '';?>">
  </div>

  <div class="mbs"> 
      <label for="adresse">Adresse</label>
      <input type="text" class="form-control" id="adresse" name="adresse"><?php echo $membre['adresse'] ?? '';?>
  </div>

  <div class="row mbs">
    <div class=" col-md-6 ">
        <label for="ville">Ville</label>
        <input type="text" class="form-control" id="ville" name="ville" value="<?php echo $membre['ville'] ?? '';?>">
    </div>
                  
    <div class=" col-md-6 ">
      <label for="cp">Code postal</label>
      <input type="text" class="form-control" name="code_postal" id="code_postal"value="<?php echo $membre['code_postal'] ?? '';?>">
    </div>
    
  </div>
  <input type="submit"  value="Inscrire" class="btn btn-info">
</form>
</div>




<?php

require_once '../inc/footer.php';