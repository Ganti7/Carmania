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
                    echo '<a href="carmania_deco.php"><button class="boutonConnect">Déconnexion</button></a>';
                    $query=$db->prepare('SELECT adresse_mail_utilisateur, nom_utilisateur, prenom_utilisateur,
                             ville_utilisateur, date_inscription_utilisateur FROM utilisateur WHERE adresse_mail_utilisateur=:mail');
                    $query->bindValue(':mail',$mail,PDO::PARAM_STR);
                    $query->execute();
                    $data=$query->fetch();
                   echo'<form method="post" action="carmania_profil.php" enctype="multipart/form-data">
			<fieldset><label for="FirstName">Nom : '.$data['nom_utilisateur'].'  </label><br>
			<label for="LastName">Prénom : '.$data['prenom_utilisateur'].' </label><br>
			<label for="mail">Adresse mail : </label><input class="input" type="text" name="mail" value="'.$data['adresse_mail_utilisateur'].'"><br>
                        <label for="A_Password">Ancien mot de passe :</label><input class="input" type="password" name="Password"><br>
			<label for="Password">Nouveau mot de passe :</label><input class="input" type="password" name="Password"><br>
			<label for="Confirmation">Retaper le mot de passe :</label><input class="input" type="password" name="Confirmation"><br>
			<label for="City">Ville : </label><input class="input" type="text" name="City" value="'.$data['ville_utilisateur'].'"><br>
			</fieldset>
			<p><input type="submit" value="S\'inscrire" /></p></form>';
                }
                
		?>

		

        

	</body>