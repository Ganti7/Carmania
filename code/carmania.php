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
		<h1 class= "titre" >Carmania</h1>
		
		<?php
		
		if(!isset($_POST['pseudo']))
		{
			echo '<a href="carmania_co.php"><button class="bouton bouton1">Connexion</button></a>';
		
		}
		?>

		<span  class= "test">
		</span>
			<a href="carmania_co.php"><button class="bouton_a" ><span>Achat </span></button></a>

        

	</body>
