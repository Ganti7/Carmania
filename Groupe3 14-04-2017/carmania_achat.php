<?php
session_start();
include("identifiants.php");
include("verif.php");
include("header.php");
include("functions.php");
date_default_timezone_set('Europe/Paris');
//$_SESSION['modele']=$_GET['modele'];
//$modele=$_GET['modele'];
?>

<!DOCTYPE html>

	<html class="fond">

		<head>

			<meta name="viewport" content="width=device-width, initial-scale=1">

			<link rel="stylesheet" type="text/css" href="carmania.css">
			<link rel="stylesheet" type="text/css"  href="w3.css">
		</head>

	<body id="centrer">
		
		
		<?php
		
		if (isset($_GET['modele']))
		{
			
			
			if (empty($_POST['num_carte']))
			{
			
				echo'<div class="w3-container w3-green">';
				echo '<h2>Achat<h2>';
				echo'</div>';
				echo'<form method="post" action="carmania_achat.php?modele='.$_GET['modele'].'" enctype="multipart/form-data">
				<fieldset><label for="FirstName" class="w3-text-green">Nom :  </label><input class="input" type="text" name="FirstName"><br>
				<label for="LastName" class="w3-text-green">Prénom : </label><input class="input" type="text" name="LastName"><br>
				<label for="adresse" class="w3-text-green">Adresse de facturation : </label><input class="input" type="text" name="adresse"><br>
				<label for="num_carte" class="w3-text-green">Numéro de carte bleue :</label><input class="input" type="text" name="num_carte"><br>
				<label for="date_exp" class="w3-text-green">Date d\'expiration :</label><input class="input" type="text" name="date_exp"><br>
				<label for="cryptogramme" class="w3-text-green">Cryptogramme : </label><input class="input" type="text" name="cryptogramme"><br>
				
				</fieldset>
				<p><input class="w3-green w3-button" type="submit" value="Acheter" /></p></form>';
				
			}
		
		
			else
			{
				$modele=$_GET['modele'];
				//echo'<p>'.$_SESSION['modele'].'</p>';
				$i=0;
				$erreur_champ= NULL;
				$crypt_erreur=NULL;
				$date_erreur=NULL;
				$num_carte_erreur=NULL;
				$temps = date("Y/m/d");
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
				
				if(!preg_match("#[0-9]{12}#", $num_carte))
				{
					$num_carte_erreur= "Le format du numéro de votre carte de crédit n'est pas valide";
					$i++;
				}
				if(!preg_match("#[0-9]{2}/[0-9]{2}#", $date_exp))
				{
					$date_erreur= "Le format de la date de votre carte de crédit n'est pas valide";
					$i++;
				}
				if(!preg_match("#[0-9]{3}#", $cryptogramme))
				{
					$crypt_erreur= "Le format du cryptogramme de votre carte de crédit n'est pas valide";
					$i++;
				}
				if ($i==0)
				{
					echo'<p class="w3-text-green>Merci de votre achat !</p>';
					
					//echo'<p>'.$_SESSION['modele'].'</p>';
					//$req=$db->query('SELECT * FROM vehicule_achat WHERE modele ="'.$modele.'"'); 
					//$donnees = $req->fetch();
					//echo'<p>'.$donnees['carburant'].'</p>';
					
					$query=$db->prepare('UPDATE  vehicule_achat SET nb_disponible=nb_disponible -1 WHERE modele ="'.$modele.'"');
					$query->execute();
					$query->CloseCursor();
					$req=$db->query('SELECT idVehicule_achat FROM vehicule_achat WHERE modele="'.$modele.'"');
					$donnees = $req->fetch();
					
					$req->CloseCursor();
					$query=$db->prepare('INSERT INTO achete (date_achat, adresse_mail_utilisateur , idVehicule_achat )
					VALUES (:temps, :mail, :idv)' );
					$query->execute(array(

					':temps' => $temps,

					':mail' => $mail,

					':idv' => $donnees['idVehicule_achat'],

					

					));
					$query->CloseCursor();
					
					echo'<p class="w3-text-green">Cliquez <a class="x3-text-blue" href="carmania_catalogue_a.php">ici</a> pour revenir au catalogue</p>'; 
					
					
					
					
				}
			
				else
				
				{
					echo'<p class="w3-text-green">Achat interrompue</p>';

					echo'<p class="w3-text-green">Une ou plusieurs erreurs se sont produites pendant l\'incription</p>';
					
					echo'<p class="w3-text-green">'.$i.' erreur(s)</p>';
					echo'<p class="w3-text-green">'.$erreur_champ.'<p>';
					echo'<p class="w3-text-green">'.$crypt_erreur.'<p>';
					echo'<p class="w3-text-green">'.$date_erreur.'<p>';
					echo'<p class="w3-text-green">'.$num_carte_erreur.'<p>';
					echo'<p class="w3-text-green">Cliquez <a href="carmania_achat.php?modele='.$modele.'">ici</a> pour recommencer</p>';
				}
			
			
			
			
			
			
			
			
			
	
			}
		}
		else
		{
			echo'<p class="w3-text-green">Il y a eu une erreur Cliquez <a href="carmania_catalogue_a.php">ici</a> pour revenir au catalogue</p>';
		}
		
		?>
		
		</body>
		
	</html>
		
		
			