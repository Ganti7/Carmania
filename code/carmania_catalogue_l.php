<?php
session_start();
include("identifiants.php");
include("verif.php");
include("header.php");
?>

<!DOCTYPE html>

	<html class="fond">

		<head>

			<meta charset="UTF-8">

			<link rel="stylesheet" type="text/css" href="carmania.css">
		</head>

	<body>
		
		
		<?php
			$req=$db->query("SELECT * FROM vehicule_location"); 
			
			while($donnees = $req->fetch())  // on affiche les voitures disponibles dans le catalogue
			{
				
				
				echo'<div>'; 
				echo'<img src="'.$donnees['chemin_image'].'"</img>';
				echo'<p> Marque : '.$donnees['marque'].'</p>';
				echo'<p> Modèle : '.$donnees['modele'].'</p>';
				echo'<p> Puissance : '.$donnees['puissance'].'</p>';
				echo'<p> Carburant : '.$donnees['carburant'].'</p>';
				echo'<p> Transmission : '.$donnees['transmission'].'</p>';
				echo'<p> Empreinte carbone : '.$donnees['empreinte_carbone'].'</p>';
				echo'<p> Prix journée : '.$donnees['prix_journee'].'</p>';
				echo'<p> Climatisation : oui</p>';
				
				if($mail=='')
				{
					echo '<a href="carmania_co.php"><button class="boutonConnect">Louer</button></a>';
			
				}
				else
				{
					echo '<a href="carmania_achat.php"><button class="boutonConnect">Louer</button></a>';
					
				}
				
				
				
				echo'</div>';
				
				
			}
			?>
			
		
</body>

</html>