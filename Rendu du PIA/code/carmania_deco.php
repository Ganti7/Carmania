<?php
	session_start();
	session_destroy();
	include("identifiants.php");
	include("verif.php");
	include("constants.php");
	include("functions.php");
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
		
				//if(!isset($page)) $page =$_SERVER["HTTP_REFERER"];
		
				if ($id==0) erreur(ERR_IS_NOT_CO); // si deco alors que déjà deco alors -> erreur
			?>
		
		<?php
			header("Location: carmania.php"); // redirection
			
		?>

	

	</body>

</html>