<!DOCTYPE html>

<div id='header'>
		<div id='banniere'>
			<h1 id='logo'> Carmania </h1>
			<div id='boutonsGauche'>
					<a href='carmania.php'><button class='boutonsHeader' id='boutonAccueil'>Accueil</button></a>
					<a href='carmania_catalogue_a.php'><button class='boutonsHeader' id='boutonAchats'>Achats</button></a>
					<a href='carmania.php'><button class='boutonsHeader' id='boutonLocations'>Locations</button></a>
			</div>
		</div>
	
	<?php
	if(!isset($_POST['pseudo']))
	{
		echo '<div id="boutonsDroits"><a href="carmania_co.php"><button id="boutonConnect">Connexion</button></a></div>';
		
	}
	?>
</div>