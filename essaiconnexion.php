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
                      $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php#login1\">Me connecter</a>";
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
  }
 

//---------------------------------AFFICHAGE-------------------

require_once 'inc/header.php';
$erreur="";
?>
        
        <section id="login1" class="login-section">
            <section class="login-container mtxxl">
                <h3 class="loginh3">Connectez-vous</h3>
                <p class="explanatory-text"><!--trouvez une phrase d'accroche--></p>
        
                <form id="signup" method="POST" action="">
                    <label for="login-email">Email</label>
                    <input type="email" id="login-email" size="30" placeholder="Enter your email address" name="email" required>
        
                    <label for="login-password">Mot de passe</label>
                    <input type="password" id="login-password" size="30" placeholder="Enter your password" name="mdp" required>
        
                    <!-- <label class="checkbox"><input type="checkbox" name="save" value="" /> Conserver mes identifiants de connexion </label> -->
        
                    <a href="/forgot-password" class="forgot-link"> Vous avez oublié votre mot de passe ?</a>
        
                    <input id="login-submit" type="submit" name="formconnexion" value="Se connecter"/>
                </form>
               
            </section><!--
            
         --><section class="signup-container mtxxl">
                <h3 class="loginh3">Je crée mon compte </h3>
                <p class="explanatory-text">Pour suivre toutes les étapes de notre collaboration.</p>
        
                <form id="log-in" method="post" action="">
                    <div class="name-container">
                     
                            <label for="pseudo">Pseudo</label>
                            <input type="text" id="pseudo" size="30" placeholder="Votre pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" required>
                        
                      
        
                        <!-- <div>
                            <label for="last-name">Votre Nom</label>
                            <input type="text" id="last-name" size="30" placeholder="Your last name" required>
                        </div>
                    </div> -->
        
                    <label for="email">Email</label>
                    <input type="email" id="email" size="30" placeholder="Votre adresse mail"name="email" value="<?php if(isset($email)) { echo $email; } ?>" required>

                    <label for="email2">Email</label>
                    <input type="email" id="email2" size="30" placeholder="Confirmez votre mail"name="email2" value="<?php if(isset($email2)) { echo $email2; } ?>" required>
        
                    <label for="mdp">Mot de passe</label>
                    <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" required>

                    <label for="mdp2">Mot de passe</label>
                    <input type="password" placeholder="confirmez Votre mot de passe" id="mdp2" name="mdp2" required>
        
                    <!-- <label class="checkbox"><input type="checkbox" name="accept-terms" value="" /> J'accepte les <a href="/terms" target="_blank">Terms &amp; Conditions</a></label> -->
        
                    <input type="submit" name="forminscription" value="Je m'inscris" />
                </form>
                <?php
       
         ?>
            </section>
            
            <section class="switcher-overlay">
                <svg    viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path  d="M 0,0 L 100,0 L 80,100 L 0,100 z"></path>
                </svg>
                <div class="signup-text">
                    <h3 class="loginh3">Vous n'avez pas crée votre compte?</h3>
                    <p class="explanatory-text"><!--trouvez une phrase d'accroche--></p>
                    <button class="switch">Je m'enregistre</button>
                </div>
        
                <div class="login-text">
                    <h3 class="loginh3">Vous avez déjà un compte ?</h3>
                    <p class="explanatory-text"><!--trouvez une phrase d'accroche--></p>
                    <button class="switch">Connexion</button>
                </div>
            </section>
        
        </section>



   

        <?php
require_once 'inc/footer.php';  