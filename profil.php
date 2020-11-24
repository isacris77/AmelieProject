<?php
require_once 'inc/init.php'; 
/* Exercice:
 1 - Si le visiteur accÃ¨de Ã  cette page et qu'il n'est pas connectÃ©, vous le redirigez vers la page de connexion
 2 - Dans cette page, vous affichez toutes les informations de son profil. faire le HTML qu'on veut. Par ailleurs, ajoutez un message de bienvenue juste aprÃ¨s le <h1> : " bonjour [prenom] [nom] ! "
 3 - Ajoutez un lien "supprimer mon compte" . vous supprimez (quand on clique dessus) le membre en BDD aprÃ¨s avoir demandÃ© confirmation de la suppression en javascript.
 une fois le profil supprimÃ©, vous dÃ©truisez la session et redirigez le membre sur la page d'inscription
*/


// 1 - 
if(!estConnecte()) {
    header('location:connexion.php'); // on envoie dans le header du texte http qui transite entre serveur et client le "message" 'location:connexion.php'. Celui-ci spÃ©cifie au navigateur qui doit demander la page connexion.php
    exit();
}

// 2 - affichage des infos 
//debug($_SESSION); // des lors que l'on fait un session start() (il est dans init.php), les donnÃ©es stockÃ©es dans cette session sur le serveur sont disponibles partout sur le site. Iic il s'agit d'un tableau multidimensionnel ce pk nous ecrivons $_SESSION['membre']['ville'] pour acceder Ã  la ville du membre

// 3 - Suppression du compte 

if(isset($_GET['action']) && $_GET['action'] == 'supprimer'){ // le Isset est necessaire car si "action" n'existe pas dans l'url, donc dans $_get, la condition s'arrete immÃ©diatement dans regarder si action contient "supprimer". Dans le cas contraire (si on ne met pas isset), nous aurions une erreur "undefined index"

    $id_membre = $_SESSION['membre'] ['id_membre']; // je vais chercher on id_membre dans la session car je suis connectÃ©

    $supprimer = executeRequete ("DELETE FROM membre WHERE id_membre = $id_membre");
    session_destroy(); 
    header('location:inscription.php'); 
    exit(); // on quitte le script


}










require_once 'inc/header.php'; 
?>
<h1 class="mt-4">Profil</h1>

<h2>Bonjour <?php echo $_SESSION['membre']['prenom']. ' ' . $_SESSION['membreun']['nom'];   ?> ! </h2>

<?php

if(estAdmin()) {
    echo '<p>Vous Ãªtes ADMINISTRATEUR</p>';

}
?>
<hr>
<h3>Vos coordonnÃ©es</h3>
<ul>
        <li>Email: <?php echo $_SESSION['membre']['email'];?> </li>
        <li>Adresse: <?php echo $_SESSION['membre']['adresse'];?> </li>
        <li>Code Postal: <?php echo $_SESSION['membre']['code_postal'];?> </li>
        <li>Ville: <?php echo $_SESSION['membre']['ville'];?> </li>
</ul>

<hr>


<p><a href="profil.php?action=supprimer" onclick="return (confirm('Etes vous sur de vouloir supprimer votre compte?'))">Supprimer mon compte</a></p>
<!-- confirme retourne true quand on valide : return true dÃ©clenche le lien. en revanche quand on annule, confirm retourne false: return false bloque le lien (Ã©quivaut Ã  e.preventDefault()) -->




<?php
require_once 'inc/footer.php'; 




