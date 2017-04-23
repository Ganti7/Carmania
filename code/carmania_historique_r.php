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

	<body>
		<div id="centrer">

			<?php
				$limite=2;    // var pour pagination
				$debut=($page-1)* $limite;  // var pour pagination
				echo'<div class="w3-container w3-green">';
				echo '<h2>Réclamation<h2>';
				echo'</div>';
				echo'<div class="w3-show-inline-block">';
				echo'<div class="w3-bar w3-light-green">';
				
				echo'<a href="carmania_reclamation.php" class="w3-bar-item w3-button">Faire une réclamation</a>';
				echo'<a href="#" class="w3-bar-item w3-button w3-dark-grey">Historique de vos réclamations</a>';
				echo'</div>';
				echo'</div>';
				
				//$req=$db->query('SELECT * FROM reclamation WHERE adresse_mail_utilisateur="'.$mail.'"'); 
				
				$req=$db->prepare('SELECT SQL_CALC_FOUND_ROWS * FROM reclamation WHERE adresse_mail_utilisateur="'.$mail.'" 
				LIMIT :limite OFFSET :debut'); 
				$req->bindValue('debut',$debut, PDO::PARAM_INT);
				$req->bindValue('limite',$limite, PDO::PARAM_INT);
				$req->execute();
				$resultFoundRows=$db->query('SELECT found_rows()'); // nb de tuples
				$nb_element_total=$resultFoundRows->fetchColumn(); 
				$nb_pages=ceil($nb_element_total / $limite); // pages pour pagination
				$i=1;
				$rien=1;
				echo '<form method="post" action="carmania_historique_r.php" enctype="multipart/form-data">';
				while($donnees = $req->fetch())  // on affiche toutes les réclamation faites par l'utilisateur
				{
					$rien=0;
					echo'<div id="re" class="w3-card-4">'; 
							
					echo'<p class="w3-text-green"> Date d\'ouverture : '.$donnees['date_ouverture'].'</p>';
					echo'<p class="w3-text-green"> Etat : '.$donnees['etat'].'</p>';
					echo'<p class="w3-text-green"> Objet : '.$donnees['objet'].'</p>';
					echo'<p class="w3-text-green"> Réclamation : '.$donnees['texte'].'</p>';
					if($donnees['date_fermeture']!=NULL)  // si la réclamation a été résolu on affiche la date de fermeture
						echo'<p class="w3-text-green"> Date de fermeture : '.$donnees['date_fermeture'].'</p>';
					else // sinon on met un bouton qui permet de fermer le ticket
					{
						echo '<input type="submit" value="Resoudre" name="'.$i.'" class="w3-green w3-button" onclick="rec('.$donnees['reclamation_pk'].')"/>';
					
					}
						
					$i++;
					echo'</div>';
				}	
						
				$req->CloseCursor();
				if($rien==1) // si l'utilisateur n'a pas fait de réclamation
					echo'<p class="w3-text-green">Vous n\'avez fait aucune réclamation à ce jour.</p>';
			
				echo'</form>';
				echo'<div class="w3-center"><div class="w3-bar">'; // affichage de la pagination
				if($page >1)
					echo'<a href="carmania_historique_r.php?page='.($page-1).'" class="w3-bar-item w3-button w3-text-green">&laquo;</a>';
				else
					echo'<a href="carmania_historique_r.php?page=1" class="w3-bar-item w3-button w3-text-green">&laquo;</a>';
			
				for($j=1; $j<=$nb_pages; $j++)
					echo'<a href="carmania_historique_r.php?page='.$j.'" class="w3-button w3-text-green">'.$j.'</a>';
			
				if($page < $nb_pages)
					echo'<a href="carmania_historique_r.php?page='.($page+1).'" class="w3-bar-item w3-button w3-text-green">&raquo;</a>';
				else
					echo'<a href="carmania_historique_r.php?page='.$nb_pages.'" class="w3-bar-item w3-button w3-text-green">&raquo;</a>';
			
				echo'</div></div></div>'; // fin pagination
	
	
			?>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
		<script>
			function rec(pkr) // fonction qui ferme un ticket
			{
				
				var url="carmania_maj.php?pk="+pkr;
				$.post(url, function(data)
				{
					
					
					
				});
			}
	
	
	
	
	
		</script>
	