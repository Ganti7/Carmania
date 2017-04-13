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

	<body id="centrer">
		
		
		<?php
		
		$req=$db->query('SELECT * FROM vehicule_achat WHERE adresse_mail_utilisateur="'.$mail.'"');
		/*$donnees = $req->fetch();
		$date_deb=$donnees['date_debut'];
		$date_fin=$donnees['date_fin'];*/
		$rien=0;
		echo'<div class="w3-container w3-green">';
		echo'<h1>Historique</h1>';
		echo'</div>';
		echo'<div class="w3-show-inline-block">';
		echo'<div class="w3-bar w3-light-green">';
		echo'<a href="#" class="w3-bar-item w3-button w3-dark-grey">Mes véhicules mis en vente</a>';
		echo'<a href="carmania_partic_vehic_l.php" class="w3-bar-item w3-button">Mes véhicules mis en location</a>';
		echo'</div>';
		echo'</div>';
		


		
		//$req->CloseCursor();
		
		//if($donnees==NULL)
			//echo'<p class="w3-text-green"> Vous n\'avez pas encore loué de véhicule.</p>';
		//else
		//{
			//$req=$db->query('SELECT * FROM vehicule_location WHERE idVehicule_location="'.$donnees['idVehicule_location'].'"'); 
			while($donnees = $req->fetch())  // on affiche les voitures disponibles dans le catalogue
			{
				
				$rien=1;
				
				//$requete=$db->query('SELECT * FROM vehicule_achat WHERE idVehicule_achat="'.$donnees['idVehicule_achat'].'"'); 
				//$attr=$requete->fetch();
				echo'<div>'; 
				echo'<img src="'.$donnees['chemin_image'].'"</img>';
				echo'<p> Marque : '.$donnees['marque'].'</p>';
				echo'<p> Modèle : '.$donnees['modele'].'</p>';
				echo'<p> Puissance : '.$donnees['puissance'].'</p>';
				echo'<p> Carburant : '.$donnees['carburant'].'</p>';
				echo'<p> Transmission : '.$donnees['transmission'].'</p>';
				echo'<p> Empreinte carbone : '.$donnees['empreinte_carbone'].'</p>';
				echo'<p> Prix : '.$donnees['prix_achat'].'</p>';
				if($attr['climatisation']==1)
					echo'<p> Climatisation : oui</p>';
				else
					echo'<p> Climatisation : non</p>';
				
				/*echo'<p> Début de la location : '.$donnees['date_debut'].'</p>';
				echo'<p> Fin de la location : '.$donnees['date_fin'].'</p>';*/
				
				if($donnees['nb_disponible']==0)
				{
					$requete=$db->query('SELECT * FROM achete WHERE idVehicule_achat="'.$donnees['idVehicule_achat'].'"'); 
					$attr=$requete->fetch();
					echo'<p> Acheté le : '.$attr['date_achat'].'</p>';
					echo'<p> Par : '.$attr['adresse_mail_utilisateur'].'</p>';
				}
					
			
		
					$requete->CloseCursor();
			}
		//}
		if($rien==0)
			echo'<p class="w3-text-green"> Vous n\'avez pas encore mis de véhicule en vente.</p>';
		
		$req->CloseCursor();
		
		?>
		
		</body>
		
		</html>