<?php
require_once 'inc/init.php';
//---------------------------------TRAITEMENT PHP-------------------

if(isset($_POST['forminscription'])){
    
    if (!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) 
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mail = htmlspecialchars($_POST['mail']);
        $mail2 = htmlspecialchars($_POST['mail2']);
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
        $mdp2 = password_hash($_POST['mdp2'], PASSWORD_DEFAULT);

        $pseudolength = strlen($pseudo);
        if ($pseudolength <= 20 )
        {
            if ($mail == $mail2) 
            {
                if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                    { 

                     
               
                       if($mdp == $mdp2)
                       {

                       } 
                         else 
                         {
                                $erreur = "Vos mots de passe ne             correspondent pas.";
                         } 

                     }
                         else
                         {
                            $erreur = "Votre adresse mail est pas valide!";
                         }

                         } 
                         else 
                         {
                         $erreur = "Vos adresses mails ne sont pas identiques.";
                             }
        } 
        else 
        {
            $erreur ="Votre pseudo ne doit pas dépasser 20 caractères !";
        }
    } 
    else 
    {
       $erreur = 'Tous les champs doivent être complétés';
    }
}












//---------------------------------AFFICHAGE-------------------
require_once 'inc/header.php';
echo $contenu;
?>

<!-- essai -->
<div class="container" >
    <h2 class="mbl">Inscription</h2>
    <form method="POST"action="">
        <table>
            <tr>
                <td style="align-right">
                    <label for="pseudo">Pseudo :</label>
                </td>
                <td >
                     <input type="text" placeholder="Votre pseudo" id="pseudo"name="pseudo">   
                </td> 
            </tr>

            <tr>
                <td style="align-right">
                    <label for="mail">Mail :</label>
                </td>
                <td >
                     <input type="email"  id="mail"name="mail">   
                     
                </td> 
            </tr>

            <tr>
                <td style="align-right">
                    <label for="mail2">Confirmation de votre email:</label>
                </td>
                <td>
                     <input type="email" id="mail2" name="mail2">   
                </td> 
            </tr>

            <tr>
                <td style="align-right">
                    <label for="mdp">Votre mot de passe</label>
                </td>
                <td>
                     <input type="password" id="mdp" name="mdp">   
                </td> 
            </tr>

            <tr>
                <td style="align-right">
                    <label for="mdp2">Confirmation de votre mot de passe</label>
                </td>
                <td>
                     <input class="mbl" type="password"  id="mdp2" name="mdp2">   
                </td> 
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="forminscription"value="je m'inscris"></td>
            </tr>
        </table>
        
    </form>

    <?php
    if (isset($erreur)) {
        echo '<font color="red">'.$erreur.'</font>';
    }
    ?>

    
</div>




<!-- fin essai  -->
        <section class="login-section">
            <section class="login-container mtxxl">
                <h3 class="loginh3">Connectez-vous</h3>
                <p class="explanatory-text"><!--trouvez une phrase d'accroche--></p>
        
                <form id="signup" method="get">
                    <label for="login-email">Email</label>
                    <input type="email" id="login-email" size="30" name="loginemail" required>
        
                    <label for="login-password">Mot de passe</label>
                    <input type="password" id="login-password" size="30" name="loginpassword" required>
        
                    <label class="checkbox"><input type="checkbox" name="save" value="" /> Conserver mes identifiants de connexion </label>
        
                    <a href="/forgot-password" class="forgot-link"> Vous avez oublié votre mot de passe ?</a>
        
                    <button id="login-submit" value="" type="submit">Connexion</button>
                </form>
            </section><!--
            
         --><section class="signup-container mtxxl">
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