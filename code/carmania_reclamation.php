<?php
session_start();
include("identifiants.php");
include("verif.php");
include("header.php");

?>

<!DOCTYPE html>

	<html class="fond">

		<head>

			<meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">

			<link rel="stylesheet" type="text/css" href="carmania.css">
			<link rel="stylesheet" type="text/css"  href="w3.css">
			
		</head>

	<body>
<div id="centrer">

<?php

	echo'<div class="w3-container w3-green">';
	echo '<h2>Réclamation<h2>';
	echo'</div>';
	if($_SESSION['level']!=1)
	{
		if (empty($_POST['objet']))
		{
			echo'<form method="post" action="carmania_reclamation.php" enctype="multipart/form-data">';
			echo'<fieldset><label for="objet" class="w3-text-green">Objet :  </label><input class="input" type="text" name="objet"><br>';
			echo'<label for="reclam" class="w3-text-green">Réclamation : </label><textarea class="input" type="text" name="reclam"></textarea>';
			echo'<p><input class="w3-green w3-button" type="submit" value="Soumettre" /></p></form>';
		
		}
		else
		{
			$erreur_champ=NULL;
			$reclam=$_POST['reclam'];
			$objet=$_POST['objet'];
			$temps = date("Y/m/d");
		
			if(empty($objet) || empty($reclam))
			{
			
				echo'<p class="w3-text-green">Vous n\'avez pas remplit tout mes champs</p>';
				echo'<p class="w3-text-green">Cliquez <a class="w3-text-blue" href="./carmania_reclamation.php">ici</a> pour recommencer</p>';
			}
			
			else
			{
				echo'<p class="w3-text-green">Réclamation envoyée</p>';
				echo'<p class="w3-text-green">Cliquez <a class="w3-text-blue" href="./carmania_profil.php">ici</a> pour revenir sur la page de votre profil</p>';
				$query=$db->prepare('INSERT INTO reclamation (date_ouverture, etat, objet, texte,
				adresse_mail_utilisateur)
				VALUES (:temps, :etat, :objet, :texte, :mail)' );
				
				$query->execute(array(

				':temps' => $temps,

				':etat' => "Non résolu",

				':objet' => $objet,

				':texte' => $reclam,

				':mail' => $mail

				));
				
				$query->CloseCursor();
			}
			
		}	
	}

	else
	{
		$req=$db->query("SELECT * FROM reclamation"); 
		$temps = date("Y/m/d");
		$i=1;
		while($donnees = $req->fetch())  // on affiche les voitures disponibles dans le catalogue
			{
				
				echo'<div class="w3-card-4">'; 
				echo'<p class="w3-text-green"> Utilisateur : '.$donnees['adresse_mail_utilisateur'].'</p>';
				echo'<p class="w3-text-green"> Date d\'ouverture : '.$donnees['date_ouverture'].'</p>';
				echo'<p class="w3-text-green"> Etat : '.$donnees['etat'].'</p>';
				echo'<p class="w3-text-green"> Objet : '.$donnees['objet'].'</p>';
				echo'<p class="w3-text-green"> Réclamation : '.$donnees['texte'].'</p>';
				if($donnees['date_fermeture']!=NULL)
					echo'<p class="w3-text-green"> Date de fermeture : '.$donnees['date_fermeture'].'</p>';
				else
				{
					echo '<form method="post" action="carmania_reclamation.php" enctype="multipart/form-data">
					<input type="submit" value="Resoudre" name="'.$i.'" class="w3-green w3-button"/></form>';
					

				}
					
				if(isset($_POST[''.$i.'']) && $_POST[''.$i.'']=='Resoudre') {
							$query=$db->prepare('UPDATE reclamation SET date_fermeture="'.$temps.'" WHERE reclamation_pk="'.$donnees['reclamation_pk'].'"');
							
				$query->execute();
				}
				$i++;
				echo'</div>';
			}	
	}
			
			
			
			
			
			
				 
		