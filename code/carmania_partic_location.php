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

		<body>
			<div id="centrer">
				<?php
		
		
					if (empty($_POST['marque']))  // page de formulaire
						
					{
						echo'<div class="w3-container w3-green">';
						echo '<h2>Fiche de votre véhicule<h2>';
						echo'</div>';
						echo'<form method="post" action="carmania_partic_location.php" enctype="multipart/form-data">
						<fieldset><label for="marque" class="w3-text-green">Marque :  </label><input class="input" type="text" name="marque"><br>
						<label for="modele" class="w3-text-green">Modèle : </label><input class="input" type="text" name="modele"><br>
						<label for="puissance" class="w3-text-green">Puissance : </label><input class="input" type="text" name="puissance"><br>
						<div><label for="carburant" class="w3-text-green">Carburant : </label><select class="w3-select w3-border" style="width: auto;" name="carburant">
								<option value="" disabled selected>Carburant</option>
									<option value="Diesel">Diesel</option>
									<option value="S95">S 95</option>
									<option value="S98">S 98</option>
							</select></label></div>
						<div><label for="transmission" class="w3-text-green">Transmission : <select class="w3-select w3-border" style="width: auto;" name="transmission">
								<option value="" disabled selected>Transmission</option>
									<option value="Manuelle">Manuelle</option>
									<option value="Automatique">Automatique</option>
							</select></label></div>
								
						<label for="empreinte_carbone" class="w3-text-green">Empreinte carbone : </label><input class="input" type="text" name="empreinte_carbone"><br>
						<div><label for="climatisation" class="w3-text-green">Climatisation : </label>
						<select class="w3-select w3-border" style="width: auto;" name="climatisation"><br>
							
								<option value="" disabled selected>Climatisation</option>
									<option value="1">Équipée</option>
									<option value="0">Non équipée</option>
							</select></div>
									
						<label for="portes" class="w3-text-green">Nombre de portes : </label><input class="input" type="text" name="portes"><br>
						<label for="couleur" class="w3-text-green">Couleur : </label><input class="input" type="text" name="couleur"><br>
						<label for="image" class="w3-text-green">Image : </label><input class="input" type="text" name="image"><br>
						<label for="prix" class="w3-text-green">Prix à la journée : </label><input class="input" type="text" name="prix"><br>
						</fieldset>
						<p><input class="w3-green w3-button" type="submit" value="Soumettre" /></p></form>';
						
					
					}
		
		
					else
					{
						$marque_erreur= NULL;
						$modele_erreur= NULL;
						$puissance_erreur= NULL;
						$erreur_champ= NULL;
						$carbone_erreur= NULL;
						$portes_erreur=NULL;
						$couleur_erreur=NULL;
						$image_erreur=NULL;
						$prix_erreur=NULL;
						$i =0;
						$marque = $_POST['marque'];
						$modele=$_POST['modele'];
						$puissance=$_POST['puissance'];
						if(isset($_POST['carburant']))
							$carburant=$_POST['carburant'];
						else
							$carburant=NULL;
						if(isset($_POST['transmission']))
							$transmission=$_POST['transmission'];
						else
							$transmission=NULL;
						$empreinte_carbone=$_POST['empreinte_carbone'];
						if(isset($_POST['climatisation']))
							$climatisation=$_POST['climatisation'];
						else
							$climatisation=NULL;
						$image=$_POST['image'];
						$prix=$_POST['prix'];
						$portes=$_POST['portes'];
						$couleur=$_POST['couleur'];
						
						// on vérifie tout les champs
						
						if(empty($marque) || empty($modele) || empty($puissance) || empty($carburant) || empty($transmission) || empty($empreinte_carbone)
							 || empty($climatisation) || empty($image) || empty($prix) || empty($portes) || empty($couleur))
						{
									 
							$erreur_champ= "Vous n'avez pas renseigné tout les champs";
							$i++;
									 
									 
						}
						if(!preg_match("#^[a-z]{3,15}$#i", $marque))
						{
							$marque_erreur= "Le format de la marque du véhicule n'est pas valide";
							$i++;
						}
						if(!preg_match("#^[a-z0-9]{3,15}#i", $modele))
						{
							$modele_erreur= "Le format du modèle du véhicule n'est pas valide";
							$i++;
						}
						if(!preg_match("#^[1-9][0-9]{1,3}$#", $puissance))
						{
							$puissance_erreur= "Le format de la puissance du véhicule n'est pas valide";
							$i++;
						}
						if(!preg_match("#^[1-9][0-9]{1,3}$#", $empreinte_carbone))
						{
							$carbone_erreur= "Le format de l'empreinte carbone du véhicule n'est pas valide";
							$i++;
						}
						
						if(!filter_var($image,FILTER_VALIDATE_URL))
						{
							$image_erreur= "Le format de l'image du véhicule n'est pas valide";
							$i++;
						}
						if(!preg_match("#^[1-9][0-9]{1,3}$#", $prix))
						{
							$prix_erreur= "Le format du prix du véhicule n'est pas valide";
							$i++;
						}
						if(!preg_match("#^[1-9]{1}$#", $portes))
						{
							$portes_erreur= "Le format du nombre de portes du véhicule n'est pas valide";
							$i++;
						}
						if(!preg_match("#^[a-z]{3,8}$#i", $couleur))
						{
							$couleur_erreur= "Le format de la couleur du véhicule n'est pas valide";
							$i++;
						}
						
						

						if ($i==0) // si tout va bien

						{
							
							echo'<p class="w3-text-green">Enregistrement réussi!</p>';

							
						
							$query=$db->prepare('INSERT INTO  vehicule_location(prix_journee, carburant, puissance, marque,
							modele, transmission,chemin_image,climatisation,empreinte_carbone,nb_disponible,nb_stock,adresse_mail_utilisateur)
							VALUES (:prix, :carburant, :puissance, :marque, :modele, :transmission, :image, :climatisation, :carbone, :dispo, :stock, :mail)' );
							
							$query->execute(array(

							':prix' => $prix,

							':carburant' => $carburant,

							':puissance' => $puissance,

							':marque' => $marque,

							':modele' => $modele,

							':transmission' => $transmission,
							
							':image' => $image,
							
							':climatisation' => $climatisation,
							
							':carbone' => $empreinte_carbone,
							
							':dispo' => 1,
							
							':stock'=> 1,
							
							':mail' => $mail,

							));
							$last_id=$db->lastInsertId();
							$query->CloseCursor();
							
							$req=$db->query('SELECT idVehicule_location FROM vehicule_location WHERE idVehicule_location="'.$last_id.'"');
							$donnees = $req->fetch();
							$req->CloseCursor();
							$query=$db->prepare('INSERT INTO voiture_location (portes, couleur , idVehicule_location )
								VALUES (:portes, :couleur, :idv)' );
								$query->execute(array(

								':portes' => $portes,

								':couleur' => $couleur,

								':idv' => $donnees['idVehicule_location'],

								

								));
								$query->CloseCursor();
							
										
							header("refresh: 2;url = carmania_partic_vehic_l.php"); // redirige sur le catalogue des vehicules proposés par l'utilisateur après 2s			
						}
						
						else // si problème rencontré
						{
							echo'<p class="w3-text-green">Mise en location interrompue</p>';

							echo'<p class="w3-text-green">Une ou plusieurs erreurs se sont produites pendant l\'ajout de votre véhicule dans le catalogue</p>';
								
							echo'<p class="w3-text-green">'.$i.' erreur(s)</p>';
							echo'<p class="w3-text-green">'.$erreur_champ.'<p>';
							echo'<p class="w3-text-green">'.$marque_erreur.'<p>';
							echo'<p class="w3-text-green">'.$modele_erreur.'<p>';
							echo'<p class="w3-text-green">'.$puissance_erreur.'<p>';
							echo'<p class="w3-text-green">'.$carbone_erreur.'<p>';
							echo'<p class="w3-text-green">'.$portes_erreur.'<p>';
							echo'<p class="w3-text-green">'.$couleur_erreur.'<p>';
							echo'<p class="w3-text-green">'.$image_erreur.'<p>';
							echo'<p class="w3-text-green">'.$prix_erreur.'<p>';
							echo'<p class="w3-text-green">Cliquez <a href="carmania_partic_location.php?modele='.$modele.'">ici</a> pour recommencer</p>';
						}
						
					}
				?>
			</div>
		</body>
	</html>