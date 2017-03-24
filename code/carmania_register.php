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
		<h1>Carmania</h1>
		<div>
		
		<?php
		if ($id!=0) erreur(ERR_IS_CO);
		
		if (empty($_POST['mail']))
			
		{
		
			echo '<h2>Inscription<h2>';
			echo'<form method="post" action="carmania_register.php" enctype="multipart/form-data">
			<fieldset><label for="FirstName">Nom :  </label><input class="input" type="text" name="FirstName"><br>
			<label for="LastName">Prénom : </label><input class="input" type="text" name="LastName"><br>
			<label for="mail">Adresse mail : </label><input class="input" type="text" name="mail"><br>
			<label for="Password">Mot de passe :</label><input class="input" type="password" name="Password"><br>
			<label for="Confirmation">Retaper le mot de passe :</label><input class="input" type="password" name="Confirmation"><br>
			<label for="City">Ville : </label><input class="input" type="text" name="City"><br>
			</fieldset>
			<p><input type="submit" value="S\'inscrire" /></p></form>';
			
		
		}
		/*?>
        </div>
		
		<?php*/
		
		else
		{
			$mdp_erreur= NULL;
			$email_erreur1= NULL;
			$email_erreur2= NULL;
			$i =0;
			$temps = time();
			$prenom=$_POST['LastName'];
			$nom=$_POST['FirstName'];
			$mdp=$_POST['Password'];
			$confirm=$_POST['Confirmation'];
			$email=$_POST['mail'];
			$ville=$_POST['City'];
			
			// Verification du mdp
			
			
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
					
				
			}
			
			

			if ($i==0)

			{

				echo'<h1>Inscription terminée</h1>';

				echo'<p>Bienvenue '.stripslashes(htmlspecialchars($_POST['mail'])).' vous êtes maintenant inscrit sur le forum</p>

				<p>Cliquez <a href="./carmania.php">ici</a> pour revenir à la page d accueil</p>';
			
				$query=$db->prepare('INSERT INTO utilisateur (adresse_mail_utilisateur, mot_de_passe, nom_utilisateur, prenom_utilisateur,
				ville_utilisateur, date_inscription_utilisateur)
				VALUES (:email, :mdp, :nom, :prenom, :ville, :temps)' );
				$query->bindValue(':email', $email, PDO::PARAM_STR);
				$query->bindValue(':mdp', $mdp, PDO::PARAM_INT);
				$query->bindValue(':nom', $nom, PDO::PARAM_STR);
				$query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
				$query->bindValue(':ville', $ville, PDO::PARAM_STR);
				$query->bindValue(':temps', $temps, PDO::PARAM_INT);
				
				$_SESSION['mail']=$email;
				$query->CloseCursor();
			}
			
			
			else
			{
				
				echo'<h1>Inscription interrompue</h1>';

				echo'<p>Une ou plusieurs erreurs se sont produites pendant l incription</p>';

				echo'<p>'.$i.' erreur(s)</p>';
				echo'<p>'.$email_erreur1.'<p>';
				echo'<p>'.$email_erreur2.'<p>';
				echo'<p>'.$mdp_erreur.'<p>';
				echo'<p>Cliquez <a href="./carmania_register.php">ici</a> pour recommencer</p>';
				
			}
		}
			?>
				
				
				

	</body>

</html>

