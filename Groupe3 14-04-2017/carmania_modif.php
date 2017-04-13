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

	<body id="centrer">
		
		
		<?php
		
		
                
        if (empty($_POST['Password']))
        {
                    
            $query=$db->prepare('SELECT adresse_mail_utilisateur, nom_utilisateur, prenom_utilisateur, mot_de_passe,
                    ville_utilisateur, date_inscription_utilisateur FROM utilisateur WHERE adresse_mail_utilisateur=:mail');
            $query->bindValue(':mail',$mail,PDO::PARAM_STR);
            $query->execute();
            $data=$query->fetch();
			$query->CloseCursor();
			//$data_mdp=$data['mot_de_passe'];
			echo'<div class="w3-container w3-green">';
			echo'<h1>Profil</h1>';
			echo'</div>';
			echo'<form method="post" action="carmania_modif.php" enctype="multipart/form-data">
			<fieldset><label for="FirstName" class="w3-text-green">Nom : '.$data['nom_utilisateur'].'  </label><br>
			<label for="LastName" class="w3-text-green">Prénom : '.$data['prenom_utilisateur'].' </label><br>
			<label for="mail" class="w3-text-green">Adresse mail : '.$data['adresse_mail_utilisateur'].'</label><br>
            <label for="A_Password" class="w3-text-green">Ancien mot de passe :</label><input class="input" type="password" name="A_Password"><br>
			<label for="Password" class="w3-text-green">Nouveau mot de passe :</label><input class="input" type="password" name="Password"><br>
			<label for="Confirmation" class="w3-text-green">Retaper le mot de passe :</label><input class="input" type="password" name="Confirmation"><br>
			<label for="City" class="w3-text-green">Ville : </label><input class="input" type="text" name="City" value="'.$data['ville_utilisateur'].'"><br>
			<input class="input" type="hidden" name="mdp" value="'.$data['mot_de_passe'].'"><br>
			<input class="input" type="hidden" name="mail" value="'.$data['adresse_mail_utilisateur'].'"><br>
			</fieldset>
			<p><input class="w3-green w3-button" type="submit" value="Modifier" /></p></form>';
        }
        

		else
		{
			$mdp_erreur= NULL;
			$a_mdp_erreur= NULL;
			//$email_erreur1= NULL;
			//$email_erreur2= NULL;
            $erreur_champ= NULL;
			$i =0;
			$d_mdp=$_POST['mdp'];
			$a_mdp=$_POST['A_Password'];
			$n_mdp=$_POST['Password'];
			$confirm=$_POST['Confirmation'];
			$email=$_POST['mail'];
			$ville=$_POST['City'];
		
			if(empty($a_mdp) || empty($n_mdp) || empty($confirm) || empty($ville))
            {
                         
                $erreur_champ= "Vous n'avez pas renseigné tout les champs";
                $i++;
                         
                         
            }
			
			if ($n_mdp != $confirm)
			{
				$mdp_erreur= "Votre nouveau mot de passe et la confirmation diffèrent";
				$i++;
			}
			
			if ($a_mdp != $d_mdp)
			{
				$a_mdp_erreur= "Votre ancien mot de passe ne correspond pas";
				$i++;
			}
			
			/*$req=$db->prepare('SELECT COUNT(*) AS nbr FROM utilisateur WHERE adresse_mail_utilisateur=:mail');
			$req->bindValue(':mail',$email, PDO::PARAM_STR);
			$req->execute();
			$mail_free=($req->fetchColumn()==0)?1:0;
			$req->CloseCursor();*/
		
			/*if(!$mail_free)
			{
				$email_erreur1= "Votre adresse email est déjà utilisée par un membre";
				$i++;
				
				
			}
			
			if(!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
			{
				$email_erreur2= "Votre adresse E-mail n'a pas un format valide";
                $i++; 	
			}*/
			
			if($i==0)
			{
				echo'<h1>Modification terminée</h1>';
				echo'<p>'.$n_mdp.'</p>';
				echo'<p>'.$email.'</p>';
				
				$query=$db->prepare('UPDATE  utilisateur SET mot_de_passe="'.$n_mdp.'", ville_utilisateur="'.$ville.'" WHERE adresse_mail_utilisateur ="'.$email.'"');
				$query->execute();
				echo'<p>Cliquez <a href="carmania_profil.php">ici</a> pour revenir sur la page de votre profil</p>'; 
				
				
			}
			else
			{
				echo'<h1>Modification interrompue</h1>';

				echo'<p>Une ou plusieurs erreurs se sont produites pendant l\'incription</p>';

				echo'<p>'.$i.' erreur(s)</p>';
				//echo'<p>'.$email_erreur1.'<p>';
				//echo'<p>'.$email_erreur2.'<p>';
				echo'<p>'.$a_mdp_erreur.'<p>';
				echo'<p>'.$mdp_erreur.'<p>';
                echo'<p>'.$erreur_champ.'<p>';
				echo'<p>Cliquez <a href="./carmania_modif.php">ici</a> pour recommencer</p>';
			}

		
		}	
		
			
		?>

		

        

	</body>