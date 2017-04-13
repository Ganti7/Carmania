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
		
		
		
		$rien=0;
		echo'<div class="w3-container w3-green">';
		echo'<h1>Historique</h1>';
		echo'</div>';
		echo'<div class="w3-show-inline-block">';
		echo'<div class="w3-bar w3-light-green">';
		echo'<a href="#" class="w3-bar-item w3-button w3-dark-grey">Historique d\'achats</a>';
		echo'<a href="carmania_historique_l" class="w3-bar-item w3-button">Historique de location</a>';
		echo'</div>';
		echo'</div>';
		

		if($_SESSION['level']!=1)
		{
			$req=$db->query('SELECT * FROM achete WHERE adresse_mail_utilisateur="'.$mail.'"');
			
				
			while($donnees = $req->fetch())  // on affiche les voitures disponibles dans le catalogue
			{
				$rien=1;
					
				$requete=$db->query('SELECT * FROM vehicule_achat WHERE idVehicule_achat="'.$donnees['idVehicule_achat'].'"'); 
				$attr=$requete->fetch();
				echo'<div>'; 
				echo'<img src="'.$attr['chemin_image'].'"</img>';
				echo'<p class="w3-text-green"> Marque : '.$attr['marque'].'</p>';
				echo'<p class="w3-text-green"> Modèle : '.$attr['modele'].'</p>';
				echo'<p class="w3-text-green"> Puissance : '.$attr['puissance'].'</p>';
				echo'<p class="w3-text-green"> Carburant : '.$attr['carburant'].'</p>';
				echo'<p class="w3-text-green"> Transmission : '.$attr['transmission'].'</p>';
				echo'<p class="w3-text-green"> Empreinte carbone : '.$attr['empreinte_carbone'].'</p>';
				echo'<p class="w3-text-green"> Prix : '.$attr['prix_achat'].'</p>';
				if($attr['climatisation']==1)
					echo'<p class="w3-text-green"> Climatisation : oui</p>';
				else
					echo'<p class="w3-text-green"> Climatisation : non</p>';
			
					$requete->CloseCursor();
			}
			
			if($rien==0)
				echo'<p class="w3-text-green"> Vous n\'avez pas encore acheté de véhicule.</p>';
			$req->CloseCursor();
		}
		
		else
		{
			$req=$db->query('SELECT * FROM achete');
			while($donnees = $req->fetch())  // on affiche les voitures disponibles dans le catalogue
				{
					$rien=1;
					
					$requete=$db->query('SELECT * FROM vehicule_achat WHERE idVehicule_achat="'.$donnees['idVehicule_achat'].'"'); 
					$attr=$requete->fetch();
					echo'<div>'; 
					echo'<img src="'.$attr['chemin_image'].'"</img>';
					echo'<p class="w3-text-green"> Marque : '.$attr['marque'].'</p>';
					echo'<p class="w3-text-green"> Modèle : '.$attr['modele'].'</p>';
					echo'<p class="w3-text-green"> Puissance : '.$attr['puissance'].'</p>';
					echo'<p class="w3-text-green"> Carburant : '.$attr['carburant'].'</p>';
					echo'<p class="w3-text-green"> Transmission : '.$attr['transmission'].'</p>';
					echo'<p class="w3-text-green"> Empreinte carbone : '.$attr['empreinte_carbone'].'</p>';
					echo'<p class="w3-text-green"> Prix : '.$attr['prix_achat'].'</p>';
					if($attr['climatisation']==1)
						echo'<p class="w3-text-green"> Climatisation : oui</p>';
					else
						echo'<p class="w3-text-green"> Climatisation : non</p>';
					if($attr['adresse_mail_utilisateur']!=NULL)
						echo'<p class="w3-text-green"> Vendu par : '.$attr['adresse_mail_utilisateur'].'</p>';
					else
						echo'<p class="w3-text-green"> Vendu par : Carmania </p>';
					echo'<p class="w3-text-green"> Acheté le : '.$donnees['date_achat'].'</p>';
					echo'<p class="w3-text-green"> Par : '.$donnees['adresse_mail_utilisateur'].'</p>';
						$requete->CloseCursor();
				}
			
			if($rien==0)
				echo'<p class="w3-text-green"> Personne n\'a acheté de véhicule pour l\'instant..</p>';
			$req->CloseCursor();
		}
		
		?>
		
		</body>
		
		</html>