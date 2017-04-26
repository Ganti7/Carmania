<?php
	session_start();
	include("identifiants.php");
	include("verif.php");
	include("header.php");
	$page = (!empty($_GET['page']) ? $_GET['page'] : 1);
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
		
		
				$limite=2;    // var pour pagination
				$debut=($page-1)* $limite;  // var pour pagination
				$rien=0;
				echo'<div class="w3-container w3-green">';
				echo'<h1>Historique</h1>';
				echo'</div>';
				echo'<div class="w3-show-inline-block">';
				echo'<div class="w3-bar w3-light-green">';
				echo'<a href="#" class="w3-bar-item w3-button w3-dark-grey">Historique d\'achats</a>';
				echo'<a href="carmania_historique_l.php" class="w3-bar-item w3-button">Historique de location</a>';
				echo'</div>';
				echo'</div>';
		

				if($level!=1)  // si non admin on affiche historique propre a l'utilsateur
				{
					//$req=$db->query('SELECT * FROM achete WHERE adresse_mail_utilisateur="'.$mail.'"');
					$req=$db->prepare('SELECT SQL_CALC_FOUND_ROWS * FROM commande WHERE adresse_mail_utilisateur="'.$mail.'" AND prix_achat<>"NULL"
					LIMIT :limite OFFSET :debut'); 
					$req->bindValue('debut',$debut, PDO::PARAM_INT);
					$req->bindValue('limite',$limite, PDO::PARAM_INT);
					$req->execute();
					$resultFoundRows=$db->query('SELECT found_rows()'); // nb de tuples
					$nb_element_total=$resultFoundRows->fetchColumn(); 
					$nb_pages=ceil($nb_element_total / $limite); // pages pour pagination
			
				
					while($donnees = $req->fetch())  
					{
						$rien=1;
					
						//$requete=$db->query('SELECT * FROM vehicule_achat WHERE idVehicule_achat="'.$donnees['idVehicule_achat'].'"'); 
						//$attr=$requete->fetch();
						echo'<div class="w3-card-4">'; 
						echo'<img src="'.$donnees['chemin_image'].'"</img>';
						echo'<p class="w3-text-green"> Marque : '.$donnees['marque'].'</p>';
						echo'<p class="w3-text-green"> Modèle : '.$donnees['modele'].'</p>';
						echo'<p class="w3-text-green"> Puissance : '.$donnees['puissance'].'</p>';
						echo'<p class="w3-text-green"> Carburant : '.$donnees['carburant'].'</p>';
						echo'<p class="w3-text-green"> Transmission : '.$donnees['transmission'].'</p>';
						echo'<p class="w3-text-green"> Empreinte carbone : '.$donnees['empreinte_carbone'].'</p>';
						echo'<p class="w3-text-green"> Prix : '.$donnees['prix_achat'].'</p>';
						if($donnees['climatisation']==1)
							echo'<p class="w3-text-green"> Climatisation : oui</p>';
						else
							echo'<p class="w3-text-green"> Climatisation : non</p>';
					
							//$requete->CloseCursor();
							echo'</div>';
					}
			
					if($rien==0)
						echo'<p class="w3-text-green"> Vous n\'avez pas encore acheté de véhicule.</p>';
					$req->CloseCursor();
				}
		
				else  // sinon on affiche toutes les commandes faites sur le site
				{
					//$req=$db->query('SELECT * FROM achete');
					//$req=$db->prepare('SELECT SQL_CALC_FOUND_ROWS * FROM achete  
					//LIMIT :limite OFFSET :debut'); 
					$req=$db->prepare('SELECT SQL_CALC_FOUND_ROWS * FROM commande WHERE prix_achat<>"NULL"
					LIMIT :limite OFFSET :debut'); 
					$req->bindValue('debut',$debut, PDO::PARAM_INT);
					$req->bindValue('limite',$limite, PDO::PARAM_INT);
					$req->execute();
					$resultFoundRows=$db->query('SELECT found_rows()'); // nb de tuples
					$nb_element_total=$resultFoundRows->fetchColumn(); 
					$nb_pages=ceil($nb_element_total / $limite); // pages pour pagination
					while($donnees = $req->fetch())  
					{
						$rien=1;
					
						//$requete=$db->query('SELECT * FROM vehicule_achat WHERE idVehicule_achat="'.$donnees['idVehicule_achat'].'"'); 
						//$attr=$requete->fetch();
						echo'<div class="w3-card-4">'; 
						echo'<img src="'.$donnees['chemin_image'].'"</img>';
						echo'<p class="w3-text-green"> Marque : '.$donnees['marque'].'</p>';
						echo'<p class="w3-text-green"> Modèle : '.$donnees['modele'].'</p>';
						echo'<p class="w3-text-green"> Puissance : '.$donnees['puissance'].'</p>';
						echo'<p class="w3-text-green"> Carburant : '.$donnees['carburant'].'</p>';
						echo'<p class="w3-text-green"> Transmission : '.$donnees['transmission'].'</p>';
						echo'<p class="w3-text-green"> Empreinte carbone : '.$donnees['empreinte_carbone'].'</p>';
						echo'<p class="w3-text-green"> Prix : '.$donnees['prix_achat'].'</p>';
						if($donnees['climatisation']==1)
							echo'<p class="w3-text-green"> Climatisation : oui</p>';
						else
							echo'<p class="w3-text-green"> Climatisation : non</p>';
						if($donnees['adresse_mail_vendeur']!=NULL)
							echo'<p class="w3-text-green"> Vendu par : '.$donnees['adresse_mail_vendeur'].'</p>';
						else
							echo'<p class="w3-text-green"> Vendu par : Carmania </p>';
						echo'<p class="w3-text-green"> Acheté le : '.$donnees['date_achat'].'</p>';
						echo'<p class="w3-text-green"> Par : '.$donnees['adresse_mail_utilisateur'].'</p>';
						//$requete->CloseCursor();
						echo'</div>';
					}
			
					if($rien==0)
						echo'<p class="w3-text-green"> Personne n\'a acheté de véhicule pour l\'instant..</p>';
					$req->CloseCursor();
				}
				echo'<div class="w3-center"><div class="w3-bar">'; // affichage de la pagination
				if($page >1)
					echo'<a href="carmania_historique_a.php?page='.($page-1).'" class="w3-bar-item w3-button w3-text-green">&laquo;</a>';
				else
					echo'<a href="carmania_historique_a.php?page=1" class="w3-bar-item w3-button w3-text-green">&laquo;</a>';
			
				for($j=1; $j<=$nb_pages; $j++)
					echo'<a href="carmania_historique_a.php?page='.$j.'" class="w3-button w3-text-green">'.$j.'</a>';
			
				if($page < $nb_pages)
					echo'<a href="carmania_historique_a.php?page='.($page+1).'" class="w3-bar-item w3-button w3-text-green">&raquo;</a>';
				else
					echo'<a href="carmania_historique_a.php?page='.$nb_pages.'" class="w3-bar-item w3-button w3-text-green">&raquo;</a>';
			
				echo'</div></div></div>'; // fin pagination
		
			?>
		
		</body>
		
	</html>