<?php


require_once 'inc/init.php';

//---------------------------------TRAITEMENT PHP-------------------
if(isset($_GET['id_membre']) AND $_GET['id_membre'] > 0) {
    $getid = intval($_GET['id-membre']);
    $requser = $bdd->prepare('SELECT * FROM espace_membre WHERE id_membre = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
 



//---------------------------------AFFICHAGE-------------------
require_once 'inc/header.php';

?>

<!-- essai -->
<div style="align-center">
         <h2>Profil de <?php echo $userinfo['pseudo']; ?></h2>
         <br /><br />
         Pseudo = <?php echo $userinfo['pseudo']; ?>
         <br />
         Mail = <?php echo $userinfo['email']; ?>
         <br />
         <?php
         if(isset($_SESSION['id_membre']) AND $userinfo['id_membre'] == $_SESSION['id_membre']) {
         ?>
         <br />
         <a href="editionprofil.php">Editer mon profil</a>
         <a href="deconnexion.php">Se déconnecter</a>
         <?php
         }
         ?>
      </div>


 <?php 
}
   
require_once 'inc/footer.php';        