<?php
require_once 'inc/init.php';


//---------------------------------TRAITEMENT PHP-------------------

debug ($_POST);
if (!empty($_POST)) {

  //validation du formulaire:

//nom
  if(!isset($_POST['nom']) || strlen($_POST['nom']) < 4 || strlen($_POST['nom']) >20) {
          $contenu = '<div class ="alert alert-danger">Le nom doit contenir entre 1 et 20 caractères. </div>';
       }
//prenom
       if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 1 || strlen($_POST['prenom'])  > 20) { 
        $contenu.= '<div class="alert alert-danger">Le prénom doit contenir entre 1 et 20 caractères.</div>';
       }
//societe
       if (!isset($_POST['societe']) || strlen($_POST['societe']) < 1 || strlen($_POST['societe'])  > 50) { 
        $contenu.= '<div class="alert alert-danger">La société doit contenir entre 1 et 20 caractères.</div>';
        }
//telephone
      if (!isset($_POST['telephone']) || !preg_match('#^[0-9]{10}$#', $_POST['telephone'])) {
        $contenu .= '<div class="alert alert-danger">Le telephone n\'est pas valide.</div>';
        }

//email
        if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) || strlen($_POST['email']) > 50 ){ // 
          $contenu.= '<div class="alert alert-danger">L\'email n\'est pas valide</div>';

         }
//adresse
         if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 4 || strlen($_POST['adresse'])  > 50) { 
          $contenu.= '<div class="alert alert-danger">L\'adresse doit contenir entre 4 et 50 caractères.</div>';
        }
//ville
        if (!isset($_POST['ville']) || strlen($_POST['ville']) < 1 || strlen($_POST['ville'])  > 20) { 
          $contenu.= '<div class="alert alert-danger">La ville doit contenir entre 1 et 20 caractères.</div>';
        }
//CP 
        if (!isset($_POST['cp']) || !preg_match('#^[0-9]{5}$#', $_POST['cp'])) {
          $contenu.= '<div class="alert alert-danger">Le code postal n\'est pas valide.</div>';
        }
//demande
        if(!isset($_POST['demande']) || ($_POST['demande'] != 'ge' &&  $_POST['demande'] != 'gh' && $_POST['demande'] != 'com' && $_POST['demande'] != 'autre')){
          $contenu.= '<div class="alert alert-danger">Votre demande n\'est pas valide.</div>';

        }
//message
        
        if (!isset($_POST['message']) || strlen($_POST['description']) < 6 || strlen($_POST['description'])  > 255) { 
          $contenu.= '<div class="alert alert-danger">Votre message doit comprendre entre 6 et 255 caractères.</div>';
          } 
       
          

      

          // si aucun message d'erreur on valide et envoyez le formulaire en BDD

          if (empty($contenu)) {
 // echappement des données du formulaire

            $_POST['nom'] = htmlspecialchars(['nom'], ENT_QUOTES);
            $_POST['prenom'] = htmlspecialchars(['prenom'], ENT_QUOTES);
            $_POST['societe'] = htmlspecialchars(['societe'], ENT_QUOTES);
            $_POST['telephone'] = htmlspecialchars(['telephone'], ENT_QUOTES);
            $_POST['email'] = htmlspecialchars(['email'], ENT_QUOTES);
            $_POST['adresse'] = htmlspecialchars(['adresse'], ENT_QUOTES);
            $_POST['ville'] = htmlspecialchars(['ville'], ENT_QUOTES);
            $_POST['cp'] = htmlspecialchars(['cp'], ENT_QUOTES);
            $_POST['demande'] = htmlspecialchars(['demande'], ENT_QUOTES);
            $_POST['message'] = htmlspecialchars(['message'], ENT_QUOTES);
    
 
 // on prépare la reqûete.

            $resultat = $pdo->prepare("REPLACE INTO contact (nom, prenom, societe, telephone, email, adresse, ville, cp, demande, message) VALUES(:nom, :prenom, :societe, :telephone, :email, :adresse, :ville, :cp, :demande, :message)");

            $succes = $resultat ->execute(array(
              ':nom' => $_POST['nom'],
              ':prenom' => $_POST['prenom'],
              ':societe' => $_POST['societe'],
              ':telephone' => $_POST['telephone'],
              ':email' => $_POST['email'],
              ':adresse' => $_POST['adresse'],
              ':ville' => $_POST['ville'],
              ':cp' => $_POST['cp'],
              ':demande' => $_POST['demande'],
              ':message' => $_POST['message']
            ));

            if ($succes){
              $contenu = '<div class="alert alert-success">Votre demande de contact a bien été enregistré</div>';
                }else {
                  $contenu = '<div class="alert alert-danger">Erreur lors de l\'envoi de votre message. Veuillez essayer à nouveau</div>';
                }
          } // fin du if(empty($contenu))
} // fin du if(!empty($_POST))






//---------------------------------AFFICHAGE-------------------
require_once 'inc/header.php';
?>


      <div class="ptxxl pbl banner">
        <form id="contact" class="form "action="destination.php">
            <div class="divform ptm">
                <p class="mbs">
                 <label for="nom">Votre nom</label>
                 <input type="text" class="form-control" id="nom" autofocus>
                </p>
                <p class="mbs">
                  <label for="prenom">Votre prénom </label>
                  <input type="prenom" class="form-control"  id="prenom">
                </p>
                <p class="mbs">
                 <label for="societe">Nom de votre société</label>
                 <input type="text" class="form-control" id="societe" >
                </p>
              
                <p class="mbs">
                 <label for="telephone">Téléphone</label>
                 <input type="text" class="form-control" id="telephone" >
                </p>
              
                <p class="mbs">
                 <label for="email">E-mail : </label>
                 <input type="email" class="form-control" id="email">
                </p>
              
                <p class="mbs">
                  <label for="adresse">Adresse</label>
                  <input type="text" class="form-control" id="adresse">
                </p>
              <p class="mbs">
                 <label for="ville">Ville</label>
                 <input type="text" class="form-control" id="ville">
              <p>
                
              <p class="mbs">
                 <label for="cp">Code postal</label>
                <input type="text" class="form-control" id="cp">
        
              </p>
                
                         
              <p><small>(ceci est un texte bidon de remplissage, juste pour étirer la hauteur de ce bloc de contenu) On aurait dit que j'ai lu toutes les conditions et les trucs écrits en tout petit dans les CGU et je n'ai même pas peur de cliquer sur le bouton "envoyer".</small></p>
            
            </div>
            <div class="divform ptm">
                <div  class="mbm">
                    <label for="demande">Votre demande concerne:</label>
                    <select id="demande" class="form-control">
                        <option selected value="ge">Gestion d'entreprise</option>
                        <option value="gh">Gestion Humaine</option>
                        <option value="com">Communication et stratégie digitale</option>
                        <option value="autre">Autre demande</option>
                    </select>
                </div>
                <p>Votre Message</p>
                <textarea name="message" id="message" cols="10" rows="5">Je suis un textarea dont la hauteur se calcule par rapport au bloc de contenu à ma gauche.</textarea>
               <div class="contactbutton">
                 <button class="button button--tamaya button--border-thick" data-text="Confirmer"><span>Valider<!DOCTYPE html></span></button>
                </div>
              
            </div>
              </div>
              


        
           
        </form>
</div>


<?php
require_once 'inc/footer.php';