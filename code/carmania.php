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
			echo '<a href="carmania_co.php"><button class="boutonConnect">Connexion</button></a>';
		
		}
                
                else
                {
                    echo '<a href="carmania_deco.php"><button class="boutonConnect">Déconnexion</button></a>';
                }
                
		?>

		<span  class= "test">
		</span>
		<div id="boutons">
			<a href="carmania_profil.php"><button class="bouton_a" ><span>Achat </span></button></a>
			<a href="carmania_co.php"><button class="bouton_l" ><span>Location</span></button></a>
		</div>	

        

	</body>