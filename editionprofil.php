<?php


require_once 'inc/init.php';

//---------------------------------TRAITEMENT PHP-------------------
if(isset($_SESSION['id_membre'])) {
    $requser = $bdd->prepare("SELECT * FROM espace_membre WHERE id_membre = ?");
    $requser->execute(array($_SESSION['id_membre']));
    $user = $requser->fetch();
    if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) {
       $newpseudo = htmlspecialchars($_POST['newpseudo']);
       $insertpseudo = $bdd->prepare("UPDATE espace_membre SET pseudo = ? WHERE id_membre = ?");
       $insertpseudo->execute(array($newpseudo, $_SESSION['id_membre']));
       header('Location: profil.php?id='.$_SESSION['id_membre']);
    }
    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['email']) {
       $newmail = htmlspecialchars($_POST['newmail']);
       $insertmail = $bdd->prepare("UPDATE espace_membre SET email = ? WHERE id_membre = ?");
       $insertmail->execute(array($newmail, $_SESSION['id_membre']));
       header('Location: profil.php?id='.$_SESSION['id_membre']);
    }
    if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
       $mdp1 = sha1($_POST['newmdp1']);
       $mdp2 = sha1($_POST['newmdp2']);
       if($mdp1 == $mdp2) {
          $insertmdp = $bdd->prepare("UPDATE espace_membre SET mdp = ? WHERE id_membre = ?");
          $insertmdp->execute(array($mdp1, $_SESSION['id_membre']));
          header('Location: profil.php?id='.$_SESSION['id_membre']);
       } else {
          $msg = "Vos deux mdp ne correspondent pas !";
       }
    }


//---------------------------------AFFICHAGE-------------------
require_once 'inc/header.php';

?>

<!-- essai -->
<div style="align-center">
         <h2 class="ptxxxl">Edition de mon profil</h2>
         <div style="align-left">
            <form method="POST" action="" enctype="multipart/form-data">
               <label>Pseudo :</label>
               <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /><br /><br />
               <label>Mail :</label>
               <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['email']; ?>" /><br /><br />
               <label>Mot de passe :</label>
               <input type="password" name="newmdp1" placeholder="Mot de passe"/><br /><br />
               <label>Confirmation - mot de passe :</label>
               <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br /><br />
               <input type="submit" value="Mettre à jour mon profil !" />
            </form>
            <?php if(isset($msg)) { echo $msg; } ?>
         </div>
      </div>
  
<?php   
}
else {
   header("Location: connexion.php");
}

require_once 'inc/footer.php';        