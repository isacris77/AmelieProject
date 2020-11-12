<style>
.cadre{
  position:absolute;


  width:600px;
  height:400px;

   border-radius:2px;
  overflow:hidden;
  background:red;
  color:white;

}

.centre{
  position:absolute;
  top:50%;
  left:0;
  right:0;
  margin-top:-25px

}

.carousel{
  position:relative;
  width:100%;
  height:45px;
  text-align:center;
  font-size:18px;
  line-height:25px;

}

.carousel .preTxt{ 
  position:absolute;
  top:0;
  right:47%;
  height:45px;
  text-shadow:2px 2px 2px pink;
  }


 .carousel .changeHidden{
   position:absolute;
   top:0;
   left:55%;
  text-align:left;
  height:45px;
   overflow:hidden;
 }

 .carousel .changeHidden .contenant{
   position:relative;
  animation: carousel 8s ease-in-out infinite;
 }

.carousel .changeHidden .element{
  display:block;
  font-weight:700;
  text-shadow:2px 2px 2px pink;

}

@keyframes carousel{
  0%, 20%{
    transform:translateY(0);
  }
  25%, 45%{
    transform:translateY(-45px);
  }
  50%, 70%{
    transform:translateY(-90px);
  }
  75%, 95%{
    transform:translateY(-135px);
  }
  100%{
    transform:translateY(-180px);
  }
}




</style>
                        <div class="cadre">
                          <div class="centre">
                            <div class="carousel">
                              <div class="preTxt">Mes valeurs: </div>
                              <div class="changeHidden">
                                <div class="contenant">
                                  <div class="element"><img src="Images/Icon httpsicons8.comiconsetbusinessios/family.png" alt="icon de famille"> Famille / Amitié -> Je tire mes forces de ces valeurs.</div>
                                  <div class="element"><img src="Images/Icon httpsicons8.comiconsetbusinessios/justice.png" alt="icon de la justice"> Justice</div>
                                  <div class="element"><img src="Images/Icon httpsicons8.comiconsetbusinessios/helping-hand-25.png" alt="">   Honnêteté</div>
                                  <div class="element"><img src="Images/Icon httpsicons8.comiconsetbusinessios/handshake.png" alt="icon poignée de main"> Respect</div>
                                  <div class="element"><img src="Images/Icon httpsicons8.comiconsetbusinessios/don de soi.png" alt="Image d'un coeur sur la main"> Don de soi</div>
                                  <div class="element"><img src="Images/Icon httpsicons8.comiconsetbusinessios/family.png" alt="icon de famille"> Famille / Amitié -> Je tire mes forces de ces valeurs.</div>
                                </div>
                              </div>
                            </div>
                          
                          </div>

                        
                        </div>

<?php 
// page de connexion
                        if (!empty($_POST)) {

if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 1 || strlen($_POST['prenom'])  > 20) { 
   $contenu.= '<div class="alert alert-danger">Le prénom doit contenir entre 1 et 20 caractères.</div>';
 }


if (!isset($_POST['nom']) || strlen($_POST['nom']) < 1 || strlen($_POST['nom'])  > 20) { 
       $contenu.= '<div class="alert alert-danger">Le nom doit contenir entre 1 et 20 caractères.</div>';
     }

if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) || strlen($_POST['email']) > 20 ){ 

       $contenu.= '<div class="alert alert-danger">L\'email n\'est pas valide</div>';
 } 
 
 if (!isset($_POST['password']) || strlen($_POST['password']) < 4 || strlen($_POST['mdp'])  > 50) { 
   $contenu.= '<div class="alert alert-danger">Le mot de passe doit contenir entre 4 et 20 caractères.</div>';
 } 


 if (empty($contenu)) {

      $resultat = executeRequete("SELECT * from membre WHERE email = :email", array(':email' => $_POST['email']));
      
      if($resultat->rowCount() > 0){
       $contenu .= '<div class="alert alert-danger">Vous avez déja un compte, veuillez vous connecter</div>';
      } else{
          $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);
          

          $succes=executeRequete("INSERT INTO membre (prenom, nom, email, password) VALUES (:prenom, :nom, :email, :password)",
          array(
              ':prenom' => $_POST['prenom'],
              ':nom' => $_POST['nom'],
              ':email' => $_POST['email'],
              ':password' => $mdp

          ));

          $contenu .= '<div class="alert alert-success">Votre inscription est confirmée. Veuillez-vous connecter </div>';

      }
    
   
 } //fin du empty contenu


} //fin du !empty post


