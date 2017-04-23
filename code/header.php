<!DOCTYPE html>



<div class="w3-container w3-center w3-margin w3-border w3-hover-border-green">
	<div class="w3-display-container w3-text-white">
		<img src="road.jpg" class="w3-image" style="width:17%" >
			<div class="w3-display-middle w3-container w3-large"> 
				<h2>Carmania</h2> 
			</div>
			<?php
		
				if($mail=='')
				{
					echo '<a href="carmania_co.php"><button class="w3-display-topright w3-green w3-button">Connexion</button></a>';
		
				}
                
                else
                {
                    echo '<a href="carmania_deco.php"><button class="w3-display-topright w3-green w3-button">Déconnexion</button></a>';
					echo '<a href="carmania_profil.php"><button class="w3-display-bottomright w3-green w3-button">Profil</button></a>';
                }
                
		?>
		<div class="w3-display-left">
			<a href='carmania.php'><button class="w3-green w3-button">Accueil</button></a>
			<a href='carmania_catalogue_a.php'><button class=" w3-green w3-button">Achats</button></a>
			<a href='carmania_catalogue_l.php'><button class=" w3-green w3-button">Locations</button></a>
			<a href='carmania_partic.php'><button class=" w3-green w3-button">Vendre</button></a>
		</div>
	</div>
		
	
</div>