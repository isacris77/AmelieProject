<?php


require_once("../inc/init.php");


if(!estAdmin())
{
	header("location:../connexion.php");
	exit();
}


if(isset($_GET['action']) && $_GET['action'] == "supprimer_membre" && isset($_GET['id_membre']))
{	
	if ($_GET['id_membre'] != $_SESSION['membre']['id_membre']){
		executeRequete("DELETE FROM membre WHERE id_membre=:id_membre", array(':id_membre' => $_GET['id_membre']));
	} else {
		$contenu .= '<div class="alert alert-danger">Vous ne pouvez pas supprimer votre propre profil ! </div>';
	}
	
}




$resultat = executeRequete("SELECT id_membre, pseudo, nom, prenom, email, adresse, code_postal, ville, statut FROM membre"); 
$contenu .= '<h1 class="mt-4 ptxxl"> Membres </h1>';
$contenu .=  "Nombre de membre(s) : " . $resultat->rowCount();

$contenu .=  '<table class="table">';
	
		$contenu .=  '<tr>';
			$contenu .=  '<th> id_membre </th>';
			$contenu .=  '<th> pseudo </th>';
			$contenu .=  '<th> nom </th>';
			$contenu .=  '<th> prénom </th>';
			$contenu .=  '<th> email </th>';
			$contenu .=  '<th> adresse </th>';
			$contenu .=  '<th> code postal </th>';
	    	$contenu .=  '<th> ville </th>';
			$contenu .=  '<th> statut </th>';
			$contenu .=  '<th> action </th>';
		$contenu .=  '</tr>';

	
		while ($membre = $resultat->fetch(PDO::FETCH_ASSOC))
		{
			$contenu .=  '<tr>';

				foreach ($membre as $indice => $information)
				{
					$contenu .=  '<td>' . $information . '</td>';
				}
				$contenu .=  '<td>
                <a href="ajouter_membre.php?id_membre='. $membre['id_membre'].'">modifier</a>
				<a href="?action=supprimer_membre&id_membre=' . $membre['id_membre'] . '" onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer ce membre?\'));"> supprimer </a>';

            $contenu.= '</td>';

			$contenu .=  '</tr>';
		}
$contenu .=  '</table>';


//-------------------------------------------------- Affichage ---------------------------------------------------------//
require_once("../inc/header.php");

?>
<div class="container">
<h1 class="mt-4">Gestion des Membres</h1>

<ul class="nav nav-tabs">
    <li><a href="gestion_membre.php" class="nav-link active">Affichage des membres</a></li>
    <li><a href="ajouter_membre.php" class="nav-link">	Ajouter un membre</a></li>
</ul>

<?php
echo $contenu;
?>
</div>

<?php
require_once("../inc/footer.php");



