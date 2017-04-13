<?php

session_start();
include("functions.php");
include("identifiants.php");
include("verif.php");
include("constants.php");
include("header.php");
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
		
		if ($id!=0) erreur(ERR_IS_CO);
		?>
		
		<?php
		
		if (!isset($_POST['mail'])) //On est dans la page de formulaire

			{
		
				echo'<div class="w3-container w3-green">';
				echo '<h2>Connexion<h2>';
				echo'</div>';	
				echo '<form method="post" action="carmania_co.php"
				<label for="mail" class="w3-text-green">Adresse mail : </label><input class="input" type="text" name="mail"><br>
				<label for="Password" class="w3-text-green">Mot de passe :</label><input class="input" type="password" name="Password"><br>
				<input class="w3-green w3-button" type="submit" value="Connexion" /></form>';
				echo'<div id="centrer">';
				echo '<a href="./carmania_register.php"><button class="w3-green w3-button">Pas encore inscrit ?</button></a>';
				//<a href="./carmania_register.php">Pas encore inscrit ?</a>';
		
			}

		else
			{
				
			$message='';
			//$page='';
			if (empty($_POST['mail']) || empty($_POST['Password']) ) //Oublie d'un champ
				{
					$message = '<p class="w3-green">Une erreur s\'est produite pendant votre identification.
					Vous devez remplir tous les champs.</p>
					<p class="w3-green">Cliquez <a class="w3-text-blue" href="./carmania_co.php">ici</a> pour revenir</p>';
				}
			else //On check le mot de passe
				{
				$query=$db->prepare('SELECT adresse_mail_utilisateur, mot_de_passe , prenom_utilisateur,droit
				FROM Utilisateur WHERE adresse_mail_utilisateur = :mail');
				$query->bindValue(':mail',$_POST['mail'], PDO::PARAM_STR);
				$query->execute();
				$data=$query->fetch();
				
			
				if ($data['mot_de_passe'] ==$_POST['Password']) // Acces OK !
					{
					$_SESSION['mail'] = $data['adresse_mail_utilisateur'];
					//$page = htmlspecialchars($_POST['page']);
					$_SESSION['id'] =1;
					if($data['droit']==1)
						$_SESSION['level']=1;
					else
						$_SESSION['level']=0;
					
					header("Location: carmania.php"); // redirection
					/*
					$message = '<p>Bienvenue '.$data['prenom_utilisateur'].', 
					vous êtes maintenant connecté!</p>
					<p>Cliquez <a href="'.$page.'">ici</a> 
					pour revenir à la page précédente</p>'; 
					*/					
					}
				else // Acces pas OK !
					{
					$message = '<p class="w3-text-green">Une erreur s\'est produite 
					pendant votre identification.<br /> Le mot de passe ou le mail 
					entré n\'est pas correcte.</p><p class="w3-text-green">Cliquez <a class="w3-text-blue" href="./carmania_co.php">ici</a> 
					pour revenir à la page précédente
					<br /><br />Cliquez <a class="w3-text-blue" href="./carmania.php">ici</a> 
					pour revenir à la page d accueil</p>';
					}
    $query->CloseCursor();
				}		
    echo $message.'</div></body></html>';

			}
?>

		



        

	</body>

</html>