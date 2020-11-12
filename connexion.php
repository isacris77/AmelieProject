<?php


require_once 'inc/init.php';

//---------------------------------TRAITEMENT PHP-------------------

if(isset($_POST['formconnexion'])) {
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);
    if(!empty($mailconnect) AND !empty($mdpconnect)) {
       $requser = $bdd->prepare("SELECT * FROM espace_membre WHERE mail = ? AND motdepasse = ?");
       $requser->execute(array($mailconnect, $mdpconnect));
       $userexist = $requser->rowCount();
       if($userexist == 1) {
          $userinfo = $requser->fetch();
          $_SESSION['id'] = $userinfo['id'];
          $_SESSION['pseudo'] = $userinfo['pseudo'];
          $_SESSION['mail'] = $userinfo['mail'];
          header("Location: profil.php?id=".$_SESSION['id']);
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
         <h2>Connexion</h2>
         <br /><br />
         <form method="POST" action="">
            <input type="email" name="mailconnect" placeholder="Mail" />
            <input type="password" name="mdpconnect" placeholder="Mot de passe" />
            <br /><br />
            <input type="submit" name="formconnexion" value="Se connecter !" />
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>



<!-- fin essai  -->
        <!-- <section class="login-section">
            <section class="login-container mtxxl">
                <h3 class="loginh3">Connectez-vous</h3>
                <p class="explanatory-text"><!--trouvez une phrase d'accroche--></p>
<!--         
                <form id="signup" method="get">
                    <label for="login-email">Email</label>
                    <input type="email" id="login-email" size="30" name="loginemail" required>
        
                    <label for="login-password">Mot de passe</label>
                    <input type="password" id="login-password" size="30" name="loginpassword" required>
        
                    <label class="checkbox"><input type="checkbox" name="save" value="" /> Conserver mes identifiants de connexion </label>
        
                    <a href="/forgot-password" class="forgot-link"> Vous avez oublié votre mot de passe ?</a>
        
                    <button id="login-submit" value="" type="submit">Connexion</button>
                </form>
            </section> -->
     <!-- <section class="signup-container mtxxl">
                <h3 class="loginh3">Je crée mon compte </h3>
                <p class="explanatory-text">Pour suivre toutes les étapes de notre collaboration.</p>
        
                <form id="log-in"method="send">
                    <div class="name-container">
                        <div>
                            <label for="prenom">Votre prénom</label>
                            <input type="text" id="first-name"  name="prenom" required>
                        </div>
        
                        <div>
                            <label for="nom">Votre Nom</label>
                            <input type="text" id="last-name"  name="nom" required>
                        </div>
                    </div>
        
                    <label for="signup-email">Email</label>
                    <input type="email" id="singup-email"  name="email"required>
        
                    <label for="signup-password">Mot de passe</label>
                    <input type="password" id="signup-password"  name="password" required>
        
                    <label class="checkbox"><input type="checkbox" name="accept-terms" value="" /> J'accepte les <a href="/terms" target="_blank">Terms &amp; Conditions</a></label>
        
                    <button id="signup-submit" value="" type="submit">Je m'enregistre</button>
                </form>
            </section>
            
            <section class="switcher-overlay">
                <svg    viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path  d="M 0,0 L 100,0 L 80,100 L 0,100 z"></path>
                </svg>
                <div class="signup-text">
                    <h3 class="loginh3">Vous n'avez pas crée votre compte?</h3>
                    <p class="explanatory-text"><!--trouvez une phrase d'accroche--></p>
                    <!-- <button class="switch">Je m'enregistre</button>
                </div>
        
                <div class="login-text">
                    <h3 class="loginh3">Vous avez déjà un compte ?</h3>
                    <p class="explanatory-text"><!--trouvez une phrase d'accroche--></p>
                    <!-- <button class="switch">Connexion</button>
                </div>
            </section>
        
        </section>  -->

 

   

        <?php
require_once 'inc/footer.php';  