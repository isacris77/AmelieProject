<?php
require_once 'inc/init.php';



//---------------------------------TRAITEMENT PHP-------------------


if (!empty($_POST)) {

  //validation du formulaire:

//nom
  if(!isset($_POST['nom']) || strlen($_POST['nom']) < 4 || strlen($_POST['nom']) >20) {
          $contenu = '<div class ="alert alert-danger">Le nom doit contenir entre 1 et 20 caractères. </div>';
       }
//prenom
       if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 1 || strlen($_POST['prenom'])  > 20) { 
        $contenu = '<div class="alert alert-danger">Le prénom doit contenir entre 1 et 20 caractères.</div>';
       }
//societe
       if (!isset($_POST['societe']) || strlen($_POST['societe']) < 1 || strlen($_POST['societe'])  > 50) { 
        $contenu = '<div class="alert alert-danger">La société doit contenir entre 1 et 20 caractères.</div>';
        }
//telephone
      if (!isset($_POST['telephone']) || !preg_match('#^[0-9]{10}$#', $_POST['telephone'])) {
        $contenu  = '<div class="alert alert-danger">Le telephone n\'est pas valide.</div>';
        }

//email
        if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) || strlen($_POST['email']) > 50 ){ // 
          $contenu = '<div class="alert alert-danger">L\'email n\'est pas valide</div>';

         }
//adresse
         if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 4 || strlen($_POST['adresse'])  > 50) { 
          $contenu = '<div class="alert alert-danger">L\'adresse doit contenir entre 4 et 50 caractères.</div>';
        }
//ville
        if (!isset($_POST['ville']) || strlen($_POST['ville']) < 1 || strlen($_POST['ville'])  > 20) { 
          $contenu = '<div class="alert alert-danger">La ville doit contenir entre 1 et 20 caractères.</div>';
        }
//CP 
        if (!isset($_POST['cp']) || !preg_match('#^[0-9]{5}$#', $_POST['cp'])) {
          $contenu = '<div class="alert alert-danger">Le code postal n\'est pas valide.</div>';
        }
//demande
        if(!isset($_POST['demande']) || ($_POST['demande'] != 'Gestion d\'entreprise' &&  $_POST['demande'] != 'Gestion Humaine' && $_POST['demande'] != 'Communication et strategie digitale' && $_POST['demande'] != 'Autre demande')){
          $contenu = '<div class="alert alert-danger">Votre demande n\'est pas valide.</div>';

        }
//message
        
        if (!isset($_POST['message']) || strlen($_POST['message']) < 6 || strlen($_POST['message'])  > 255) { 
          $contenu = '<div class="alert alert-danger">Votre message doit comprendre entre 6 et 255 caractères.</div>';
          } 
       
          

      

          // si aucun message d'erreur on valide et envoyez le formulaire en BDD

          if (empty($contenu)) {

 
 // on prépare la reqûete.

            $resultat = $bdd->prepare('INSERT INTO contact (nom, prenom, societe, telephone, email, adresse, ville, cp, demande, message) VALUES(:nom, :prenom, :societe, :telephone, :email, :adresse, :ville, :cp, :demande, :message)');

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
        <?php
         echo $contenu;
        
        ?>
  <div class="container">

    <div class="row justify-content-between bg-light">
       <div class="localisation cold-md-6 ptm">

         <table>
        <tr>
          <td><img src="Images\icon\marker.png" alt=""></td>
          <td class="font-weight-bold"> Localisation :</td>
          <td>Montpellier, France</td>
        </tr>
        
        <tr>
          <td><img src="Images\icon\homeoffice.png" alt=""></td>
          <td class="font-weight-bold">Téletravail :</td>
          <td>Missions majoritairement à distance</td>
        </tr>
         </table>

    
          <hr class="my-4">
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d92442.6837966916!2d3.8041216710727115!3d43.61000057056439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12b6af0725dd9db1%3A0xad8756742894e802!2sMontpellier!5e0!3m2!1sfr!2sfr!4v1605722238823!5m2!1sfr!2sfr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
      
       </div>

       <form id="contact" class="form col-md-5" method="post" action="mecontacter.php" >  
            <div class=" divform ptm" >

                <div class="row mbs">
                  <div class=" col-md-6 ">
                     <label for="nom">Votre nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" autofocus>
                  </div>
                  
                  <div class=" col-md-6 ">
                     <label for="prenom">Votre prénom </label>
                    <input type="text" class="form-control" id="prenom" name="prenom" >
                  </div>
                </div>

                <div class="row mbs">
                  <div class=" col-md-6 ">
                  <label for="societe">Nom de votre société</label>
                 <input type="text" class="form-control" id="societe" name="societe" >
                  </div>
                  
                  <div class=" col-md-6 ">
                  <label for="telephone">Téléphone</label>
                 <input type="text" class="form-control" id="telephone" name="telephone">
                  </div>
                </div>

                
              
                <div class="mbs">
                 <label for="email">E-mail : </label>
                 <input type="email" class="form-control" id="email" name="email"  >
                </div>

                <hr class="my-4">
             
                <div class="mbs">
                   <label for="adresse">Adresse</label>
                    <input type="text" class="form-control" id="adresse" name="adresse">
                </div>
                   
                <div class="row mbs">
                  <div class=" col-md-6 ">
                  <label for="ville">Ville</label>
                     <input type="text" class="form-control" id="ville" name="ville">
                  </div>
                  
                  <div class=" col-md-6 ">
                  <label for="cp">Code postal</label>
                      <input type="text" class="form-control" id="cp" name="cp">
                  </div>
                </div>

                <hr class="my-4">
               
                

                <div class="mbs">
                    <label for="demande">Votre demande concerne:</label>
                    <select id="demande" class="form-control" name="demande">
                        <option selected value="Gestion d\'entreprise">Gestion d'entreprise</option>
                        <option value="Gestion humaine">Gestion Humaine</option>
                        <option value="Communication et strategie digitale">Communication et stratégie digitale</option>
                        <option value="Autre demande">Autre demande</option>
                    </select>
                </div> 

                <div>
                 <p>Votre Message</p>
                <textarea class="col" name="message" id="message"  rows="5"></textarea>
                </div>
                <hr class="my-4">
               
               
                <input type="submit" ></input>

                </div>
               
                 
              
              
           
           </div>           
        </form>
  </div>
    
</div>


<?php
require_once 'inc/footer.php';