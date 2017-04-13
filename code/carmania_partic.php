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

	<body>
		
		
		

		
		<div id="boutons">
			<?php
				if($mail=='')
				{
					echo '<a href="carmania_co.php"><button class="bouton_a" ><span>Vendre mon véhicule</span></button></a>';
					echo '<a href="carmania_co.php"><button class="bouton_l" ><span>Louer mon véhicule</span></button></a>';
				}
                
                else
                {
                    echo '<a href="carmania_partic_vente.php"><button class="bouton_a" ><span>Vendre mon véhicule</span></button></a>';
					echo '<a href="carmania_partic_location.php"><button class="bouton_l" ><span>Louer mon véhicule</span></button></a>';
                }
			?>
		</div>	

        

	</body>
	</html>