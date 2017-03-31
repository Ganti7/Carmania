<?php

session_start();

		

		
include("functions.php");
include("identifiants.php");
include("verif.php");
include("constants.php");
?>



<!DOCTYPE html>

	<html class="fond">

		<head>

			<meta charset="UTF-8">

			<link rel="stylesheet" type="text/css" href="carmania.css">
		</head>

	<body>
		<h1>Carmania</h1>
		
		
		<?php
		
		if ($id!=0) erreur(ERR_IS_CO);
		?>
		
		<?php
		
		if (!isset($_POST['mail'])) //On est dans la page de formulaire

			{
		
			
				echo '<form method="post" action="carmania_co.php"
				<label for="mail">Adresse mail : </label><input class="input" type="text" name="mail"><br>
				<label for="Password">Mot de passe :</label><input class="input" type="password" name="Password"><br>
				<input type="submit" value="Connexion" />
				<a href="./carmania_register.php">Pas encore inscrit ?</a>';
		
			}

		else
			{
				
			$message='';
			//$page='';
			if (empty($_POST['mail']) || empty($_POST['Password']) ) //Oublie d'un champ
				{
					$message = '<p>une erreur s\'est produite pendant votre identification.
					Vous devez remplir tous les champs</p>
					<p>Cliquez <a href="./carmania_co.php">ici</a> pour revenir</p>';
				}
			else //On check le mot de passe
				{
				$query=$db->prepare('SELECT adresse_mail_utilisateur, mot_de_passe , prenom_utilisateur
				FROM Utilisateur WHERE adresse_mail_utilisateur = :mail');
				$query->bindValue(':mail',$_POST['mail'], PDO::PARAM_STR);
				$query->execute();
				$data=$query->fetch();
				
			
				if ($data['mot_de_passe'] ==$_POST['Password']) // Acces OK !
					{
					$_SESSION['mail'] = $data['adresse_mail_utilisateur'];
					//$page = htmlspecialchars($_POST['page']);
					$_SESSION['id'] =1;
					$message = '<p>Bienvenue '.$data['prenom_utilisateur'].', 
					vous êtes maintenant connecté!</p>
					<p>Cliquez <a href="'.$page.'">ici</a> 
					pour revenir à la page précédente</p>';  
					}
				else // Acces pas OK !
					{
					$message = '<p>Une erreur s\'est produite 
					pendant votre identification.<br /> Le mot de passe ou le mail 
					entré n\'est pas correcte.</p><p>Cliquez <a href="./carmania_co.php">ici</a> 
					pour revenir à la page précédente
					<br /><br />Cliquez <a href="./carmania.php">ici</a> 
					pour revenir à la page d accueil</p>';
					}
    $query->CloseCursor();
				}		
    echo $message.'</div></body></html>';

			}
?>

		



        

	</body>

</html>