<?php


require_once 'inc/init.php';


//---------------------------------TRAITEMENT PHP-------------------

if(isset($_POST['formconnexion'])) {
    $mailconnect = htmlspecialchars($_POST['email']);
    $mdpconnect = sha1($_POST['mdp']);
    if(!empty($mailconnect) AND !empty($mdpconnect)) {
       $requser = $bdd->prepare("SELECT * FROM espace_membre WHERE email = ? AND mdp = ?");
       $requser->execute(array($mailconnect, $mdpconnect));
       $userexist = $requser->rowCount();
       if($userexist == 1) {
          $userinfo = $requser->fetch();
          $_SESSION['id_membre'] = $userinfo['id_membre'];
          $_SESSION['pseudo'] = $userinfo['pseudo'];
          $_SESSION['email'] = $userinfo['email'];
          header("Location: editionprofil.php?id=".$_SESSION['id_membre']);
       } else {
          $erreur = "Mauvais mail ou mot de passe !";
       }
    } else {
       $erreur = "Tous les champs doivent être complétés !";
    }
 }
 

//---------------------------------AFFICHAGE-------------------
require_once 'inc/header.php';
echo $contenu;
?>

<!-- essai -->
< <div style="align-center">
         <h2 class="ptxxxl mbl" >Connexion</h2>
         
         <form method="POST" action="connexion.php">
            <div class="mbl">
            <input type="email" name="email" placeholder="Mail" />
            <input type="password" name="mdp" placeholder="Mot de passe" />
            </div>
            <input type="submit" name="formconnexion" value="Se connecter !" />
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>





 

   

        <?php
require_once 'inc/footer.php';  