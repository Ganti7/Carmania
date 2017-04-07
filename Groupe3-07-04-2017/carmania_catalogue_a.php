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
			$req=$db->query("SELECT * FROM vehicule_achat"); 
			
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
				echo'<p> Prix : '.$donnees['prix_achat'].'</p>';
				echo'<p> Climatisation : oui</p>';
				
				if($mail=='')
				{
					echo '<a href="carmania_co.php"><button class="boutonConnect">Acheter</button></a>';
			
				}
				else
				{
					echo '<a href="carmania_achat.php"><button class="boutonConnect">Acheter</button></a>';
					
				}
				
				
				
				echo'</div>';
				
				
			}
			?>
			
		
</body>

</html>