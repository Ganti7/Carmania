<!DOCTYPE html>

<div id='header'>
		<div id='banniere'>
			<h1 id='logo'> Carmania </h1>
		</div>
		<div id='boutonsGauche'>
					<a href='carmania.php'><button class='boutonsHeader' id='boutonAccueil'>Accueil</button></a>
					<a href='carmania_catalogue_a.php'><button class='boutonsHeader' id='boutonAchats'>Achats</button></a>
					<a href='carmania.php'><button class='boutonsHeader' id='boutonLocations'>Locations</button></a>
		</div>
	
	<?php
		
		if($mail=='')
		{
			echo '<a href="carmania_co.php"><button id="boutonConnect">Connexion</button></a>';
		
		}
                
                else
                {
                    echo '<a href="carmania_deco.php"><button id="boutonConnect">Déconnexion</button></a>';
					echo '<a href="carmania_profil.php"><button id="boutonProfil">Profil</button></a>';
                }
                
		?>
</div>