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
		//if ($id!=0) erreur(ERR_IS_CO);
		
		if (empty($_POST['marque']))
			
		{
			echo'<div class="w3-container w3-green">';
			echo '<h2>Fiche de votre véhicule<h2>';
			echo'</div>';
			echo'<form method="post" action="carmania_partic_vente.php" enctype="multipart/form-data">
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
		/*?>
        </div>
		
		<?php*/
		
		else
		{
			$mdp_erreur= NULL;
			$email_erreur1= NULL;
			$email_erreur2= NULL;
            $erreur_champ= NULL;
			$i =0;
			$marque = $_POST['marque'];
			$modele=$_POST['modele'];
			$puissance=$_POST['puissance'];
			$carburant=$_POST['carburant'];
			$transmission=$_POST['transmission'];
			$empreinte_carbone=$_POST['empreinte_carbone'];
			$climatisation=$_POST['climatisation'];
			$image=$_POST['image'];
			$prix=$_POST['prix'];
			$portes=$_POST['portes'];
			$couleur=$_POST['couleur'];
			
			// Verification du mdp                       
                        
                        //verifmdp($mdp,$confirm,$i);
                        
            /*if(empty($prenom) || empty($nom) || empty($ville))
            {
                         
                $erreur_champ= "Vous n'avez pas renseigné tout les champs";
                $i++;
                         
                         
            }
			
            if ($mdp != $confirm || empty($confirm) || empty($mdp))
			{
				
				$mdp_erreur = "Votre mot de passe et votre confirmation diffèrent, ou sont vides";
				$i++;
			}
                
                
			$query=$db->prepare('SELECT COUNT(*) AS nbr FROM utilisateur WHERE adresse_mail_utilisateur=:mail');
			$query->bindValue(':mail',$email, PDO::PARAM_STR);
			$query->execute();
			$mail_free=($query->fetchColumn()==0)?1:0;
			$query->CloseCursor();
			
			
			// Verification du mail
			if(!$mail_free)
			{
				$email_erreur1= "Votre adresse email est déjà utilisée par un membre";
				$i++;
				
				
			}
			
			if(!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email) || empty($email))
			{
				$email_erreur2= "Votre adresse E-mail n'a pas un format valide";
                                $i++; 	
			}*/
			
			

			if ($i==0)

			{
				
				echo'<h1>Enregistrement réussi</h1>';

				
			
				$query=$db->prepare('INSERT INTO  vehicule_lcoation(prix_journee, carburant, puissance, marque,
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
				
				$query->CloseCursor();
				$req=$db->query('SELECT idVehicule_location FROM vehicule_location WHERE adresse_mail_utilisateur="'.$mail.'"');
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
				//echo'<p>'.$prix.' et '.$carburant.' et '.$puissance.' et '.$marque.' et '.$modele.' et '.$transmission.' et '.$image.' et '.$climatisation.' et '.$empreinte_carbone.' et '.$mail.'</p>';
							
				//header("refresh: 2;url = carmania.php"); // redirige sur carmania.php après 2s			
			}
			
			
			
		}
			?>
			</div>
			</body>
	</html>