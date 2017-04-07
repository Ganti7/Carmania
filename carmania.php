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
		<?php include 'header.php';?>

		<div id="boutons">
			<a href="carmania_catalogue_a.php"><button class="bouton_a" ><span>Achat </span></button></a>
			<a href="carmania_catalogue_l.php"><button class="bouton_l" ><span>Location</span></button></a>
		</div>	

        

	</body>