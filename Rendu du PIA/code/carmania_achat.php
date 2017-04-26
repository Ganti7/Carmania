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
			
				if (isset($_GET['modele']) && isset($_GET['id']))    // on vérifie si les arguments dans l'url son présent
				{
					$req=$db->query('SELECT * FROM vehicule_achat WHERE modele="'.$_GET['modele'].'" AND idVehicule_achat="'.$_GET['id'].'"');  
					if(!$donnees = $req->fetch()) // on vérifie si les arguments sont bon, n'ont pas été modifié
						echo'<p class="w3-text-green">Il y a eu une erreur Cliquez <a href="carmania_catalogue_a.php">ici</a> pour revenir au catalogue</p>';
					else
					{	
				
						if (empty($_POST['num_carte']))   // formulaire
						{
				
							echo'<div class="w3-container w3-green">';
							echo '<h2>Achat<h2>';
							echo'</div>';
							echo'<form method="post" action="carmania_achat.php?modele='.$_GET['modele'].'&id='.$_GET['id'].'" enctype="multipart/form-data">
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
							$id=$_GET['id'];
							$i=0;
							$erreur_champ= NULL;
							$crypt_erreur=NULL;
							$date_erreur=NULL;
							$num_carte_erreur=NULL;
							$prenom_erreur=NULL;
							$nom_erreur=NULL;
							$adresse_erreur=NULL;
							$temps = date("Y/m/d");
							$adresse = $_POST['adresse'];
							$prenom=$_POST['LastName'];
							$nom=$_POST['FirstName'];
							$num_carte=$_POST['num_carte'];
							$date_exp=$_POST['date_exp'];
							$cryptogramme=$_POST['cryptogramme'];
				
					
							if(empty($prenom) || empty($nom) || empty($adresse) || empty($num_carte) || empty($date_exp) || empty($cryptogramme)) // si tout les champs son remplis
							{
								$erreur_champ= "Vous n'avez pas renseigné tout les champs";
								$i++;
						
							}
						
							if(!preg_match("#^[a-z]{3,15}$#i", $prenom))  // format 
							{
								$prenom_erreur= "Le format de votre prénom n'est pas valide";
								$i++;
							}
							if(!preg_match("#^[a-z]{3,15}$#i", $nom))
							{
								$nom_erreur= "Le format de votre nom n'est pas valide";
								$i++;
							}
							if(!preg_match("#^[1-9]{1,3} [a-z]{3,20}#i", $adresse))
							{
								$adresse_erreur= "Le format de votre adresse n'est pas valide";
								$i++;
							}
							if(!preg_match("#^[0-9]{16}$#", $num_carte))
							{
								$num_carte_erreur= "Le format du numéro de votre carte de crédit n'est pas valide";
								$i++;
							}
							if(!preg_match("#^[0-9]{2}\/[0-9]{2}$#", $date_exp))
							{
								$date_erreur= "Le format de la date de votre carte de crédit n'est pas valide";
								$i++;
							}
							if(!preg_match("#^[0-9]{3}$#", $cryptogramme))
							{
								$crypt_erreur= "Le format du cryptogramme de votre carte de crédit n'est pas valide";
								$i++;
							}
							if ($i==0) // si tout va bien
							{
								
							    // décremente la disponibilité
								$query=$db->prepare('UPDATE  vehicule_achat SET nb_disponible=nb_disponible -1 WHERE modele ="'.$modele.'" AND idVehicule_achat="'.$id.'"');
								$query->execute();
								$query->CloseCursor();
								
								// historique
								
								
								$query=$db->prepare('INSERT INTO commande (carburant, puissance , marque, modele, transmission, chemin_image,
								climatisation, empreinte_carbone,prix_achat,date_achat,adresse_mail_utilisateur)
								VALUES (:carburant, :puissance, :marque, :modele, :transmission, :chemin_image,
								:climatisation, :empreinte_carbone, :prix, :date_achat, :mail)' );
								$query->execute(array(

								'carburant' => $donnees['carburant'],

								':puissance' => $donnees['puissance'],

								':marque' => $donnees['marque'],
								
								':modele' => $donnees['modele'],
								
								':transmission' => $donnees['transmission'],
								
								':chemin_image' => $donnees['chemin_image'],
								
								':climatisation' => $donnees['climatisation'],
								
								':empreinte_carbone' => $donnees['empreinte_carbone'],
								
								':prix' => $donnees['prix_achat'],
								
								':date_achat' => $temps,
								
								':mail' => $mail,
								
		

								));
								if($donnees['adresse_mail_utilisateur']!=NULL)
								{
									
									$last_id=$db->lastInsertId();
									$query->CloseCursor();
									
									$query=$db->prepare('UPDATE commande SET adresse_mail_vendeur="'.$donnees['adresse_mail_utilisateur'].'" WHERE idCommande ="'.$last_id.'"');
									$query->execute();
								}
								
								echo'<p class="w3-text-green">Merci de votre achat !</p>';
								echo'<p class="w3-text-green">Cliquez <a class="w3-text-blue" href="carmania_catalogue_a.php">ici</a> pour revenir au catalogue</p>'; 
						
								
							}
					
							else // si il y a un problème dans le formulaire
						
							{
								echo'<p class="w3-text-green">Achat interrompue</p>';

								echo'<p class="w3-text-green">Une ou plusieurs erreurs se sont produites pendant l\'achat</p>';
								
								echo'<p class="w3-text-green">'.$i.' erreur(s)</p>';
								echo'<p class="w3-text-green">'.$erreur_champ.'<p>';
								echo'<p class="w3-text-green">'.$crypt_erreur.'<p>';
								echo'<p class="w3-text-green">'.$date_erreur.'<p>';
								echo'<p class="w3-text-green">'.$num_carte_erreur.'<p>';
								echo'<p class="w3-text-green">'.$prenom_erreur.'<p>';
								echo'<p class="w3-text-green">'.$nom_erreur.'<p>';
								echo'<p class="w3-text-green">'.$adresse_erreur.'<p>';
								echo'<p class="w3-text-green">Cliquez <a href="carmania_achat.php?modele='.$modele.'&id='.$id.'">ici</a> pour recommencer</p>';
							}
					
					
					
					
				
				
				
				
				
		
						}
					}
				}
				else // si les arguments dans l'url sont absents
				{
					echo'<p class="w3-text-green">Il y a eu une erreur Cliquez <a href="carmania_catalogue_a.php">ici</a> pour revenir au catalogue</p>';
				}
			
			?>
		
		</body>
		
	</html>
		
		
			