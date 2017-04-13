<?php
session_start();
include("identifiants.php");
include("verif.php");
include("header.php");
$_SESSION['i']=0;
//$_SESSION['level']=NULL;

?>

<!DOCTYPE html>

	<html class="fond">

		<head>

			<meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">

			<link rel="stylesheet" type="text/css" href="carmania.css">
			<link rel="stylesheet" type="text/css"  href="w3.css">
			
		</head>

	<body>
		
		
		

		
		<div id="boutons">
			<a href="carmania_catalogue_a.php"><button class="bouton_a" ><span>Achat </span></button></a>
			<a href="carmania_catalogue_l.php"><button class="bouton_l" ><span>Location</span></button></a>
			
		</div>	

        

	</body>
	
	<?php //session_destroy();
	?>
	