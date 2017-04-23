<?php
	session_start();
	include("identifiants.php");
	include("verif.php");
	include("header.php");

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
		
		
                    // on affiche les informations de l'utilisateur
				$query=$db->prepare('SELECT adresse_mail_utilisateur, nom_utilisateur, prenom_utilisateur, 
						ville_utilisateur, date_inscription_utilisateur FROM utilisateur WHERE adresse_mail_utilisateur=:mail');
				$query->bindValue(':mail',$mail,PDO::PARAM_STR);
				$query->execute();
				$data=$query->fetch();
				$query->CloseCursor();
				
				echo'<div class="w3-container w3-green">';
				echo'<h1>Profil</h1>';
				echo'</div>';
				echo'<form method="post" action="carmania_profil.php" enctype="multipart/form-data">
				<fieldset><label for="FirstName" class="w3-text-green">Nom : '.$data['nom_utilisateur'].'  </label><br>
				<label for="LastName" class="w3-text-green">Prénom : '.$data['prenom_utilisateur'].' </label><br>
				<label for="mail" class="w3-text-green">Adresse mail : '.$data['adresse_mail_utilisateur'].'</label><br>
				
				<label for="City" class="w3-text-green">Ville : '.$data['ville_utilisateur'].'</label><br>
				
				<input class="input" type="hidden" name="mail" value="'.$data['adresse_mail_utilisateur'].'"><br>
				</fieldset></form>';
				echo'<div class="w3-display-container" style="height:150px;">';
				if($_SESSION['level']!=1) // si pas admin on affiche un bouton modifier et mes véhicules
				{
					
					echo '<a href="carmania_modif.php"><button class="w3-green w3-button w3-display-left">Modifier</button></a>';
					echo '<a href="carmania_partic_vehic_a.php"><button class="w3-green w3-button w3-display-middle">Mes véhicules</button></a>';
					
				}
				
					
					echo'<a href="carmania_reclamation.php"><button class="w3-green w3-button w3-display-topmiddle">Réclamation</button></a>';
					
					echo '<a href="carmania_historique_a.php"><button class="w3-green w3-button w3-display-right">Historique</button></a>';
				
				echo'</div>';
				
			?>

		

        

	</body>