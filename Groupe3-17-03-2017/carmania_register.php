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
		
		<label for="FirstName">Nom :  </label><input class="input" type="text" name="FirstName"><br>
		<label for="LastName">Prénom : </label><input class="input" type="text" name="LastName"><br>
		<label for="mail">Adresse mail : </label><input class="input" type="text" name="mail"><br>
		<label for="Password">Mot de passe :</label><input class="input" type="password" nam="Password"><br>
		<label for="City">Ville : </label><input class="input" type="text" name="City"><br>
		



        

	</body>

</html>