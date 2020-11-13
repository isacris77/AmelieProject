<?php
require_once 'inc/init.php';

//---------------------------------TRAITEMENT PHP-------------------


 
if(isset($_POST['forminscription'])) {
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $email = htmlspecialchars($_POST['email']);
   $email2 = htmlspecialchars($_POST['email2']);
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);
   if(!empty($_POST['pseudo']) AND !empty($_POST['email']) AND !empty($_POST['email2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
      $pseudolength = strlen($pseudo);
      if($pseudolength <= 255) {
         if($email == $email2) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
               $reqemail = $bdd->prepare("SELECT * FROM espace_membre WHERE email = ?");
               $reqemail->execute(array($email));
               $emailexist = $reqemail->rowCount();
               if($emailexist == 0) {
                  if($mdp == $mdp2) {
                     $insertmbr = $bdd->prepare("INSERT INTO espace_membre(pseudo, email, mdp) VALUES(?, ?, ?)");
                     $insertmbr->execute(array($pseudo, $email, $mdp));
                     $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse email déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse email n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses email ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
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
<div style="align-center" >
         <h2 class="ptxxxl mbl">Inscription</h2>
         
         <form method="POST" action="">
            <table>
               <tr>
                  <td style="align-right">
                     <label for="pseudo">Pseudo :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td style="align-right">
                     <label for="email">email :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Votre email" id="email" name="email" value="<?php if(isset($email)) { echo $email; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td style="align-right">
                     <label for="email2">Confirmation du email :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Confirmez votre email" id="email2" name="email2" value="<?php if(isset($email2)) { echo $email2; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td style="align-right">
                     <label for="mdp">Mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                  </td>
               </tr>
               <tr>
                  <td style="align-right">
                     <label for="mdp2">Confirmation du mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td style="align-right">
                     <br />
                     <input type="submit" name="forminscription" value="Je m'inscris" />
                  </td>
               </tr>
            </table>
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>
        
        </section>  

 

   

        <?php
require_once 'inc/footer.php';  