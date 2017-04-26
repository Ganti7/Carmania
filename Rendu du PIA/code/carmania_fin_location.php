
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

			<?php

				echo'<p class="w3-text-green">Merci de votre achat !</p>';
				$debut=$_GET['jour']+1;      // la location commence le lendemain
				$date_deb=date('Y-m-d',strtotime('+ 1 days'));   // debut location demain
				$date_fin=date('Y-m-d',strtotime('+'.$debut.'days'));  // fin=debut + nb jours rentré par l'utilisateur
				$query=$db->prepare('UPDATE  vehicule_location SET nb_disponible=nb_disponible -1 WHERE modele ="'.$_GET['modele'].'" AND idVehicule_location="'.$_GET['id'].'"'); // on décrémente la disponibilité
				$query->execute();
				$query->CloseCursor();
				$req=$db->query('SELECT * FROM vehicule_location WHERE modele="'.$_GET['modele'].'" AND idVehicule_location="'.$_GET['id'].'"');
				$donnees=$req->fetch();
				$req->CloseCursor();
				
				$query=$db->prepare('INSERT INTO commande (carburant, puissance , marque, modele, transmission, chemin_image,
								climatisation, empreinte_carbone,prix_journee,date_debut,date_fin,adresse_mail_utilisateur)
								VALUES (:carburant, :puissance, :marque, :modele, :transmission, :chemin_image,
								:climatisation, :empreinte_carbone, :prix, :date_debut, :date_fin, :mail)' );
								$query->execute(array(

								'carburant' => $donnees['carburant'],

								':puissance' => $donnees['puissance'],

								':marque' => $donnees['marque'],
								
								':modele' => $donnees['modele'],
								
								':transmission' => $donnees['transmission'],
								
								':chemin_image' => $donnees['chemin_image'],
								
								':climatisation' => $donnees['climatisation'],
								
								':empreinte_carbone' => $donnees['empreinte_carbone'],
								
								':prix' => $donnees['prix_journee'],
								
								':date_debut' => $date_deb,
								
								':date_fin' => $date_fin, 
								
								':mail' => $mail,
								
		

								));
				if($donnees['adresse_mail_utilisateur']!=NULL)
				{
									
					$last_id=$db->lastInsertId();
					$query->CloseCursor();
									
					$query=$db->prepare('UPDATE commande SET adresse_mail_vendeur="'.$donnees['adresse_mail_utilisateur'].'" WHERE idCommande ="'.$last_id.'"');
					$query->execute();
				}
				$query->CloseCursor();
				echo'<p class="w3-text-green">Cliquez <a class="w3-text-blue" href="carmania_catalogue_l.php">ici</a> pour revenir au catalogue</p>';
	
	
	
			?>
	
		</body>
	</html>