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
				echo'<h1>Mes véhicules</h1>';
				echo'</div>';
				echo'<div class="w3-show-inline-block">';
				echo'<div class="w3-bar w3-light-green">';
				echo'<a href="carmania_partic_vehic_a.php" class="w3-bar-item w3-button">Mes véhicules mis en vente</a>';
				echo'<a href="carmania_historique_a" class="w3-bar-item w3-button w3-dark-grey">Mes véhicules mis en location</a>';
				echo'</div>';
				echo'</div>';
		


				
				//$req=$db->query('SELECT * FROM vehicule_location WHERE adresse_mail_utilisateur="'.$mail.'"');
				$req=$db->prepare('SELECT SQL_CALC_FOUND_ROWS * FROM vehicule_location WHERE adresse_mail_utilisateur="'.$mail.'" 
				LIMIT :limite OFFSET :debut'); 
				$req->bindValue('debut',$debut, PDO::PARAM_INT);
				$req->bindValue('limite',$limite, PDO::PARAM_INT);
				$req->execute();
				$resultFoundRows=$db->query('SELECT found_rows()'); // nb de tuples
				$nb_element_total=$resultFoundRows->fetchColumn(); 
				$nb_pages=ceil($nb_element_total / $limite); // pages pour pagination
				$i=1;
				
				while($donnees = $req->fetch())  // on affiche les véhicules achetés
				{
					
					$rien=1;
					
					
					echo'<div class="w3-card-4">'; 
					echo'<img src="'.$donnees['chemin_image'].'"</img>';
					echo'<p class="w3-text-green"> Marque : '.$donnees['marque'].'</p>';
					echo'<p class="w3-text-green"> Modèle : '.$donnees['modele'].'</p>';
					echo'<p class="w3-text-green"> Puissance : '.$donnees['puissance'].'</p>';
					echo'<p class="w3-text-green"> Carburant : '.$donnees['carburant'].'</p>';
					echo'<p class="w3-text-green"> Transmission : '.$donnees['transmission'].'</p>';
					echo'<p class="w3-text-green"> Empreinte carbone : '.$donnees['empreinte_carbone'].'</p>';
					echo'<p class="w3-text-green"> Prix : '.$donnees['prix_journee'].'</p>';
					if($donnees['climatisation']==1)
						echo'<p class="w3-text-green"> Climatisation : oui</p>';
					else
						echo'<p class="w3-text-green"> Climatisation : non</p>';
					
					
					
					if($donnees['nb_disponible']==0) // si le véhicule a été acheté
					{
						$requete=$db->query('SELECT * FROM commande WHERE adresse_mail_vendeur="'.$mail.'" AND prix_journee="'.$donnees['prix_journee'].'"
						 AND marque="'.$donnees['marque'].'" AND modele="'.$donnees['modele'].'"');  
						$attr=$requete->fetch();
						echo'<p class="w3-text-green"> Loué du : '.$attr['date_debut'].' au : '.$attr['date_fin'].'</p>';
						echo'<p class="w3-text-green"> Par : '.$attr['adresse_mail_utilisateur'].'</p>';
						$requete->CloseCursor();
					}
						
					else   // sinon bouton pour supprimer l'annonce
						echo '<a href="carmania_partic_vehic_a.php?page='.$page.'"><button class="w3-green w3-button" onclick="sup('.$donnees['idVehicule_achat'].')">Supprimer</button></a>';
			
					$i++;
					echo'</div>';		
			
						
				}
				
				if($rien==0)
					echo'<p class="w3-text-green"> Vous n\'avez pas encore mis de véhicule en location.</p>';
			
				echo'<div class="w3-center"><div class="w3-bar">'; // affichage de la pagination
				if($page >1)
					echo'<a href="carmania_partic_vehic_l.php?page='.($page-1).'" class="w3-bar-item w3-button w3-text-green">&laquo;</a>';
				else
					echo'<a href="carmania_partic_vehic_l.php?page=1" class="w3-bar-item w3-button w3-text-green">&laquo;</a>';
			
				for($j=1; $j<=$nb_pages; $j++)
					echo'<a href="carmania_partic_vehic_l.php?page='.$j.'" class="w3-button w3-text-green">'.$j.'</a>';
			
				if($page < $nb_pages)
					echo'<a href="carmania_partic_vehic_l.php?page='.($page+1).'" class="w3-bar-item w3-button w3-text-green">&raquo;</a>';
				else
					echo'<a href="carmania_partic_vehic_l.php?page='.$nb_pages.'" class="w3-bar-item w3-button w3-text-green">&raquo;</a>';
			
				echo'</div></div></div>'; // fin pagination
				$req->CloseCursor();
		
			?>
		
		</body>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
			<script>
				function sup(idv)   // function qui appelle script php pour supprimer annonce
				{
				
					var url="carmania_sup.php?pk="+idv+"&mode=l";
					$.post(url, function(data)
					{
						
					});
				}
	
	
	
	
	
		</script>
		</html>