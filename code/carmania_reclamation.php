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

					echo'<div class="w3-container w3-green">';
					echo '<h2>Réclamation<h2>';
					echo'</div>';
				
					if($_SESSION['level']!=1)  // si non admin
					{
						echo'<div class="w3-show-inline-block">';
						echo'<div class="w3-bar w3-light-green">';
						echo'<a href="#" class="w3-bar-item w3-button w3-dark-grey">Faire une réclamation</a>';
						echo'<a href="carmania_historique_r.php" class="w3-bar-item w3-button">Historique de vos réclamations</a>';
						echo'</div>';
						echo'</div>';
						if (empty($_POST['objet']))  // page de formulaire
						{
							echo'<form method="post" action="carmania_reclamation.php" enctype="multipart/form-data">';
							echo'<fieldset><label for="objet" class="w3-text-green">Objet :  </label><input class="input" type="text" name="objet"><br>';
							echo'<label for="reclam" class="w3-text-green">Réclamation : </label><textarea class="input" type="text" name="reclam"></textarea>';
							echo'<p><input class="w3-green w3-button" type="submit" value="Soumettre" /></p></form>';
					
						}
						else
						{
							$erreur_champ=NULL;
							$reclam=$_POST['reclam'];
							$objet=$_POST['objet'];
							$temps = date("Y/m/d");
					
							if(empty($objet) || empty($reclam)) // si champs vide
							{
						
								echo'<p class="w3-text-green">Vous n\'avez pas remplit tout mes champs</p>';
								echo'<p class="w3-text-green">Cliquez <a class="w3-text-blue" href="./carmania_reclamation.php">ici</a> pour recommencer</p>';
							}
						
							else
							{
								echo'<p class="w3-text-green">Réclamation envoyée</p>';
								echo'<p class="w3-text-green">Cliquez <a class="w3-text-blue" href="./carmania_profil.php">ici</a> pour revenir sur la page de votre profil</p>';
								$query=$db->prepare('INSERT INTO reclamation (date_ouverture, etat, objet, texte,
								adresse_mail_utilisateur)
								VALUES (:temps, :etat, :objet, :texte, :mail)' );
							
								$query->execute(array(

								':temps' => $temps,

								':etat' => "Non résolu",

								':objet' => $objet,

								':texte' => $reclam,

								':mail' => $mail

								));
							
								$query->CloseCursor();
							}
						
						}	
					}

					else   // si admin on affiche toutes les réclamations
					{
						$limite=2;    // var pour pagination
						$debut=($page-1)* $limite;  // var pour pagination
						
						//$req=$db->query("SELECT * FROM reclamation"); 
						$req=$db->prepare('SELECT SQL_CALC_FOUND_ROWS * FROM reclamation  
						LIMIT :limite OFFSET :debut'); 
						$req->bindValue('debut',$debut, PDO::PARAM_INT);
						$req->bindValue('limite',$limite, PDO::PARAM_INT);
						$req->execute();
						$resultFoundRows=$db->query('SELECT found_rows()'); // nb de tuples
						$nb_element_total=$resultFoundRows->fetchColumn(); 
						$nb_pages=ceil($nb_element_total / $limite); // pages pour pagination
						$i=1;
						$rien=1;
						echo '<form method="post" action="carmania_reclamation.php" enctype="multipart/form-data">';
						while($donnees = $req->fetch())  
						{
							$rien=0;
							echo'<div class="w3-card-4">'; 
							echo'<p class="w3-text-green"> Utilisateur : '.$donnees['adresse_mail_utilisateur'].'</p>';
							echo'<p class="w3-text-green"> Date d\'ouverture : '.$donnees['date_ouverture'].'</p>';
							echo'<p class="w3-text-green"> Etat : '.$donnees['etat'].'</p>';
							echo'<p class="w3-text-green"> Objet : '.$donnees['objet'].'</p>';
							echo'<p class="w3-text-green"> Réclamation : '.$donnees['texte'].'</p>';
							if($donnees['date_fermeture']!=NULL) // si le ticket est résolu on affiche la date de fermeture
								echo'<p class="w3-text-green"> Date de fermeture : '.$donnees['date_fermeture'].'</p>';
							else // sinon on met un bouton pour le résoudre
							{
								echo '
								<input type="submit" value="Resoudre" name="'.$i.'" class="w3-green w3-button" onclick="rec('.$donnees['reclamation_pk'].')"/>';
								

							}
								
							
							$i++;
							echo'</div>';
						}
						echo'</form>';
						if($rien==1) // si aucune réclamation a encore été faites
							echo'<p class="w3-text-green">Aucune réclamation n\'a encore été faite.</p>';
						echo'<div class="w3-center"><div class="w3-bar">'; // affichage de la pagination
						if($page >1)
							echo'<a href="carmania_reclamation.php?page='.($page-1).'" class="w3-bar-item w3-button w3-text-green">&laquo;</a>';
						else
							echo'<a href="carmania_reclamation.php?page=1" class="w3-bar-item w3-button w3-text-green">&laquo;</a>';
			
						for($j=1; $j<=$nb_pages; $j++)
							echo'<a href="carmania_reclamation.php?page='.$j.'" class="w3-button w3-text-green">'.$j.'</a>';
					
						if($page < $nb_pages)
							echo'<a href="carmania_reclamation.php?page='.($page+1).'" class="w3-bar-item w3-button w3-text-green">&raquo;</a>';
						else
							echo'<a href="carmania_reclamation.php?page='.$nb_pages.'" class="w3-bar-item w3-button w3-text-green">&raquo;</a>';
			
						echo'</div></div></div>'; // fin pagination
					}
						
						
						
						
						
				?>
						
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
			<script>
				function rec(pkr)
				{
							
					var url="carmania_maj.php?pk="+pkr;
					$.post(url, function(data)
					{
										
					});
				}
				
				
				
	
	
		</script>
				 
		