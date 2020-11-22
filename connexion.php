<?php

require_once 'inc/init.php';
//--------------------TRAITEMENT PHP--------------------
$message =''; 

// debug($_GET);

if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') { 

    unset($_SESSION['membre']);
    $message='<div class="alert alert-info">Vous êtes deconnecté?</div>';

}


if(estConnecte()){
        header ('location:profil.php'); 
        exit(); 

}



// 1 - traitement du formulaire
// debug($_POST);

if (!empty($_POST)){ 

       

        if(empty($_POST['pseudo']) || empty($_POST['mdp'])){ 
            $contenu.='<div class="alert alert-danger">Les identifiants sont obligatoires</div>';
        }


        

        if(empty($contenu)) { 

            $resultat = executeRequete("SELECT * FROM membre WHERE pseudo =:pseudo", array(':pseudo' => $_POST['pseudo']));

            if($resultat -> rowCount()==1){ 
                $membre = $resultat->fetch(PDO::FETCH_ASSOC); 

                // debug($membre); 


               
                if(password_verify($_POST['mdp'],$membre['mdp'])){ 

                    $_SESSION['membre'] = $membre; 

             
                    header('location:profil.php'); 
                    exit(); 

                
                } else { 
                   $contenu.='<div class="alert alert-danger">Erreur sur le mot de passe</div>'; 
                }

                
            } else { 
                $contenu .='<div class="alert alert-danger">Erreur sur le pseudo</div>';
            }

        } // fin du if(empty($contenu))






} // fin du if (!empty($_POST))





//------------------------------affichage----------------------------
require_once 'inc/header.php';
?>


<?php
echo $message; // pour les messages de deconnexion 
echo $contenu; // pour les messages de connexion
?>
<div class="container">
<h1 class=" ptxxl">Connexion</h1>
    <form action="" method="post">

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
  <input type="submit" value="se connecter" class="btn btn-info">


  </form>
</div>  


<?php
require_once 'inc/footer.php';