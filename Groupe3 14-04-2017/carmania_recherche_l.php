<?php
session_start();
include("identifiants.php");
include("verif.php");
//include("header.php");
/*afficher si ya rien a afficher 
afficher si var modifié*/
?>



	
		
		<?php
		
			
			$requete="SELECT * FROM vehicule_location WHERE 1=1";
			
			if($_GET['marque']=="Renault" || $_GET['marque']=="Audi" || $_GET['marque']=="Volkswagen" || $_GET['marque']=="Citroen")
				$_SESSION['marque']=$_GET['marque'];
			if($_GET['marque']=="r")
				$_SESSION['marque']=NULL;
			if($_SESSION['marque']!=NULL)
				$requete=$requete.' AND marque="'.$_SESSION['marque'].'"';
			
			if($_GET['prix']=="15" || $_GET['prix']=="20" || $_GET['prix']=="30")
				$_SESSION['prix_journee']=$_GET['prix'];
			if($_GET['prix']=="r")
				$_SESSION['prix_journee']=NULL;
			if($_SESSION['prix_journee']!=NULL)
				$requete=$requete.' AND prix_journee<'.$_SESSION['prix_journee'];
			
			if($_GET['transmission']=="Automatique" || $_GET['transmission']=="Manuelle")
				$_SESSION['transmission']=$_GET['transmission'];
			if($_GET['transmission']=="r")
				$_SESSION['transmission']=NULL;	
			if($_SESSION['transmission']!=NULL)
				$requete=$requete.' AND transmission="'.$_SESSION['transmission'].'"';
			
			$req=$db->query($requete); 
			//echo'<p class="w3-text-green">'.$_GET['marque'].'</p>';
			//echo'<p class="w3-text-green">'.$requete.'</p>';
			$rien=1;
			while($donnees = $req->fetch())  // on affiche les voitures disponibles dans le catalogue
			{
				$rien=0;
				echo'<div class="w3-card-4">'; 
				echo'<img src="'.$donnees['chemin_image'].'" class="w3-border-green w3-padding w3-bottombar"</img>';
				echo'<p class="w3-text-green"> Marque : '.$donnees['marque'].'</p>';
				echo'<p class="w3-text-green"> Modèle : '.$donnees['modele'].'</p>';
				echo'<p class="w3-text-green"> Puissance : '.$donnees['puissance'].'</p>';
				echo'<p class="w3-text-green"> Carburant : '.$donnees['carburant'].'</p>';
				echo'<p class="w3-text-green"> Transmission : '.$donnees['transmission'].'</p>';
				echo'<p class="w3-text-green"> Empreinte carbone : '.$donnees['empreinte_carbone'].'</p>';
				echo'<p class="w3-text-green"> Prix journée : '.$donnees['prix_journee'].'</p>';
				echo'<p class="w3-text-green"> Climatisation : oui</p>';
				
				
				if($donnees['nb_disponible']>0)
				{
					if($mail=='')
					{
						echo '<a href="carmania_co.php"><button class="w3-green w3-button">Louer</button></a>';
			
					}
					else
					{
						echo '<a href="carmania_location.php?modele='.$donnees['modele'].'"><button class="w3-green w3-button">Louer</button></a>';
					
					}
				}
				else
					echo '<button class="w3-green w3-button w3-disabled">Stock épuisé !</button>';
				
			
				
				echo'</div>';
				
				
				
			}
			if($rien==1)
				echo'<p class="w3-text-green">Aucune voitures ne répond à vos critères :( </p>';
			
			?>
			
