<?php
session_start();
include("identifiants.php");
include("verif.php");
include("header.php");
//$modele=$_GET['modele'];
?>

<!DOCTYPE html>

	<html class="fond">

		<head>

			<meta charset="UTF-8">

			<link rel="stylesheet" type="text/css" href="carmania.css">
		</head>

	<body>
		
		
		<?php
		if (empty($_POST['num_carte']))
		{
			$modele=$_GET['modele'];
			echo'<p>'.$modele.'</p>';
		
		echo '<h2>Inscription<h2>';
		echo'<form method="post" action="carmania_achat.php" enctype="multipart/form-data">
		<fieldset><label for="FirstName">Nom :  </label><input class="input" type="text" name="FirstName"><br>
		<label for="LastName">Prénom : </label><input class="input" type="text" name="LastName"><br>
		<label for="adresse">Adresse de facturation : </label><input class="input" type="text" name="adresse"><br>
		<label for="num_carte">Numéro de carte bleue :</label><input class="input" type="text" name="num_carte"><br>
		<label for="date_exp">Date d\'expiration :</label><input class="input" type="text" name="date_exp"><br>
		<label for="cryptogramme">Cryptogramme : </label><input class="input" type="text" name="cryptogramme"><br>
		<label for="modele"></label>'.$_GET['modele'].'<input class="input" type="hidden" name="modele"><br>
		</fieldset>
		<p><input type="submit" value="Acheter" /></p></form>';
		
		}
		
		
		else
		{
			$modele=$_POST['modele'];
			echo'<p>'.$modele.'</p>';
			$i=0;
            $erreur_champ= NULL;
			$adresse = $_POST['adresse'];
			$prenom=$_POST['LastName'];
			$nom=$_POST['FirstName'];
			$num_carte=$_POST['num_carte'];
			$date_exp=$_POST['date_exp'];
			$cryptogramme=$_POST['cryptogramme'];
			
			
		
			
			
			
			if(empty($prenom) || empty($nom) || empty($adresse) || empty($num_carte) || empty($date_exp) || empty($cryptogramme))
			{
				$erreur_champ= "Vous n'avez pas renseigné tout les champs";
				$i++;
			}
			
			if ($i==0)
			{
				echo'<h1>Merci de votre achat !</h1>';
				
				
				
				$query=$db->prepare('UPDATE  vehicule_achat SET nb_disponible= nb_disponible - 1 WHERE modele ="'.$modele.'"');
				$query->execute();
				echo'<p>Cliquez <a href="carmania_catalogue_a.php">ici</a> 
					pour revenir au catalogue</p>'; 
				
				
				
				
			}
			
			else
			
			{
				echo'<h1>Achat interrompue</h1>';

				echo'<p>Une ou plusieurs erreurs se sont produites pendant l\'incription</p>';
				
				echo'<p>'.$i.' erreur(s)</p>';
				echo'<p>'.$erreur_champ.'<p>';
				echo'<p>Cliquez <a href="carmania_achat.php?modele='.$modele.'">ici</a> pour recommencer</p>';
			}
			
			
			
			
			
			
			
			
			
	
		}