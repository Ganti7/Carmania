<?php
session_start();
include("identifiants.php");
include("verif.php");

?>

<!DOCTYPE html>

	<html class="fond">

		<head>

			<meta charset="UTF-8">

			<link rel="stylesheet" type="text/css" href="carmania.css">
		</head>

	<body>
		<div id="haut">
			<h1 id="logo"> Carmania </h1>
		</div>
		
		<?php
		
		if($mail=='')
		{
			echo '<p>rien</p>';
		
		}               
        else
        {
			if (empty($_POST['mail']))
			{
				echo '<a href="carmania_deco.php"><button class="boutonConnect">Déconnexion</button></a>';
				$query=$db->prepare('SELECT adresse_mail_utilisateur, nom_utilisateur, prenom_utilisateur, ville_utilisateur, date_inscription_utilisateur FROM utilisateur WHERE adresse_mail_utilisateur = :mail');
				$query->bindValue(':mail', $mail, PDO::PARAM_STR);
				$query->execute();
				$data=$query->fetch();
				echo'<form method="post" action="carmania_profil.php" enctype="multipart/form-data"><fieldset><label for="FirstName">Nom : '.$data['nom_utilisateur'].'  </label><br>';						
				echo'<label for="LastName">Prénom : '.$data['prenom_utilisateur'].' </label><br>';
						
				echo'<label for="A_Password">Ancien mot de passe :</label><input class="input" type="password" name="A_Password"><br>';
						
				echo'<label for="Password">Nouveau mot de passe :</label><input class="input" type="password" name="Password"><br>';
						
				echo'<label for="Confirmation">Retaper le mot de passe :</label><input class="input" type="password" name="Confirmation"><br>';
						
				echo'<label for="City">Ville : </label><input class="input" type="text" name="City" value="'.$data['ville_utilisateur'].'"><br></fieldset>';
						
				echo'<p><input type="submit" value="Modifier" /></p></form><a href="carmania.php"><button class="boutonConnect">Retour</button></a>';
			}
			else
			{
				$i=0;
				$mdp_erreur=NULL;
				$email_erreur=NULL;
				$confirm_erreur=NULL;
				$ville_erreur=NULL;
				$erreur_champ=NULL;
				
				$email=$_POST['mail'];
				$ancien_mdp=$_POST['A_Password'];
				$mdp=$_POST['Password'];
				$confirm=$_POST['Confirmation'];
				$ville=$_POST['City'];
				
				/*TODO : Vérifier la validité des inputs seuls*/
				
				if(empty($ancien_mdp) || empty($mdp) || empty($confirm) || empty($ville))
				{
					$erreur_champ="Vous ,'avez pas renseigné tout les champs";
					$i++;
				}
				
				if ($mdp != $confirm || empty($confirm) || empty($mdp))
				else
				{
					$query=$db->prepare('SELECT mot_de_passe FROM Utilisateur WHERE adresse_mail_utilisateur = :mail');
					$query->bindValue(':mail', $mail, PDO::PARAM_STR);
					$query->execute();
					$data=$query->fetch();
					
					if($data['mot_de_passe'] != $ancien_mdp)
					{
						//Mot de passe actuel entré faux
					}
					else
					{
						if($mdp != $confirm)
						{
							//nouveau mot de passe et confirmation non identique
						}
						else // procède au changement
						{
							$query=$db->prepare('UPDATE Utilisateur SET mot_de_passe = :mdp, ville = :ville WHERE adresse_mail_utilisateur = :mail');
							$query->bindValue(':mail', $mail, PDO::PARAM_STR);
							$query->bindValue(':mdp', $mdp, PDO::PARAM_STR);
							$query->bindValue(':ville', $ville, PDO::PARAM_STR);
							$query->execute();
							header("Location: carmania.php");
						}
					}
				}
			}
            
        }
                
		?>

		

        

	</body>