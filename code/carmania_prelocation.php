<?php
	session_start();
	include("identifiants.php");
	include("verif.php");
	include("header.php");
	include("functions.php");

?>

<!DOCTYPE html>

	<html class="fond">

		<head>

			<meta name="viewport" content="width=device-width, initial-scale=1">

			<link rel="stylesheet" type="text/css" href="carmania.css">
			<link rel="stylesheet" type="text/css"  href="w3.css">
		</head>

		<body id="centrer">
		
			
			<?php  // on affiche les prix de la location et un bouton confirmer ou retour
				echo'<div class="w3-container w3-green">';
				echo '<h2>Location<h2>';
				echo'</div>';
				echo'<p class="w3-text-green"> Prix : '.$_GET['prix']*$_GET['jour'].' €</p>
				<a href="carmania_fin_location.php?modele='.$_GET['modele'].'&jour='.$_GET['jour'].'&id='.$_GET['id'].'"><button class="w3-green w3-button">Continuer</button></a>
				<a href="carmania_location.php?modele='.$_GET['modele'].'&prix='.$_GET['prix'].'"><button class="w3-green w3-button">Retour</button></a>';
		?>