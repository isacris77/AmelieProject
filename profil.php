<?php
require_once 'inc/init.php'; 



// 1 -  Si le visiteur n'est pas connecté, vous le redirigez vers la page de connexion
if(!estConnecte()) {
    header('location:connexion.php');  
    exit();
}


// 3 - Suppression du compte 

if(isset($_GET['action']) && $_GET['action'] == 'supprimer'){ 

    $id_membre = $_SESSION['membre'] ['id_membre'];

    $supprimer = executeRequete ("DELETE FROM membre WHERE id_membre = $id_membre");
    session_destroy(); 
    header('location:inscription.php'); 
    exit(); 


}










require_once 'inc/header.php'; 
?>
<div class="container">
<h1 class="mt-4 ptxxl ">Profil</h1>

<h2>Bonjour <?php echo $_SESSION['membre']['prenom']. ' ' . $_SESSION['membre']['nom'];   ?> ! </h2>

<?php

if(estAdmin()) {
    echo '<p>Vous êtes ADMINISTRATEUR</p>';

}
?>
<hr>
<h3>Vos coordonnées</h3>
<ul>
        <li>Email: <?php echo $_SESSION['membre']['email'];?> </li>
        <li>Adresse: <?php echo $_SESSION['membre']['adresse'];?> </li>
        <li>Code Postal: <?php echo $_SESSION['membre']['code_postal'];?> </li>
        <li>Ville: <?php echo $_SESSION['membre']['ville'];?> </li>
</ul>

<hr>


<p><a href="profil.php?action=supprimer" onclick="return (confirm('Etes vous sur de vouloir supprimer votre compte?'))">Supprimer mon compte</a></p>

</div>


<?php
require_once 'inc/footer.php'; 




