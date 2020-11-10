<?php
require_once 'inc/init.php';


//---------------------------------TRAITEMENT PHP-------------------

if (!empty($_POST)) {

  //validation du formulaire:

  if(!isset($_POST['nom']) || strlen($_POST['nom']) < 4 || strlen($_POST['nom']) >20) {
          $contenu = '<div class ="alert alert-danger">Le nom doit contenir entre 1 et 20 caractères. </div>';
       }
  
  
       if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 1 || strlen($_POST['prenom'])  > 20) { 
        $contenu.= '<div class="alert alert-danger">Le prénom doit contenir entre 1 et 20 caractères.</div>';
       }

       if (!isset($_POST['societe']) || strlen($_POST['societe']) < 1 || strlen($_POST['societe'])  > 50) { 
        $contenu.= '<div class="alert alert-danger">La société doit contenir entre 1 et 20 caractères.</div>';
        }

      if (!isset($_POST['telephone'])   || !preg_match('#^[0-9]{10}$#', $_POST['telephone'])) {
        $contenu .= '<div class="alert alert-danger">Le telephone n\'est pas valide.</div>';
        }

        if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) || strlen($_POST['email']) > 50 ){ // 
          $contenu.= '<div class="alert alert-danger">L\'email n\'est pas valide</div>';

    }
    










}// fin du if(!empty($_POST))






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
                        <option selected value="choix1">Gestion d'entreprise</option>
                        <option value="choix2">Gestion Humaine</option>
                        <option value="choix3">Communication et stratégie digitale</option>
                        <option value="choix4">Autre demande</option>
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