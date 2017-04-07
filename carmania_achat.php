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
			
			
		}