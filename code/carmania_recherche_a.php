<?php
	session_start();
	include("identifiants.php");
	include("verif.php");
	$page = (!empty($_GET['page']) ? $_GET['page'] : 1);

?>



	
		
		<?php  // script pour filtrer les véhicules et les afficher
		
			$limite=2;
			$debut=($page-1)* $limite;
			
			$requete="SELECT SQL_CALC_FOUND_ROWS * FROM vehicule_achat WHERE 1=1";
			
			// on prend le filtre de la marque
			if($_GET['marque']=="Renault" || $_GET['marque']=="Audi" || $_GET['marque']=="Volkswagen" || $_GET['marque']=="Citroen")
				$_SESSION['marque']=$_GET['marque'];
			// si l'utilisateur veut désactiver le filtre
			if($_GET['marque']=="r")
				$_SESSION['marque']=NULL;
			if($_SESSION['marque']!=NULL)
				$requete=$requete.' AND marque="'.$_SESSION['marque'].'"';
			
			// on prend le filtre du prix
			if($_GET['prix']=="20000" || $_GET['prix']=="30000" || $_GET['prix']=="70000")
				$_SESSION['prix']=$_GET['prix'];
			// si l'utilisateur veut désactiver le filtre
			if($_GET['prix']=="r")
				$_SESSION['prix']=NULL;
			if($_SESSION['prix']!=NULL)
				$requete=$requete.' AND prix_achat<"'.$_SESSION['prix'].'"';
			
			// on prend le filtre de la transmission
			if($_GET['transmission']=="Automatique" || $_GET['transmission']=="Manuelle")
				$_SESSION['transmission']=$_GET['transmission'];
			// si l'utilisateur veut désactiver le filtre
			if($_GET['transmission']=="r")
				$_SESSION['transmission']=NULL;	
			if($_SESSION['transmission']!=NULL)
				$requete=$requete.' AND transmission="'.$_SESSION['transmission'].'"';
			
			$requete=$requete.' LIMIT :limite OFFSET :debut';
			$requete=$db->prepare($requete);
			$requete->bindValue('debut',$debut, PDO::PARAM_INT);
			$requete->bindValue('limite',$limite, PDO::PARAM_INT);
			$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
			$requete->execute(); 
			$resultFoundRows=$db->query('SELECT found_rows()');
			$nb_element_total=$resultFoundRows->fetchColumn();
			$nb_pages=ceil($nb_element_total / $limite);
			
			$rien=1;
			while($donnees = $requete->fetch())  // on affiche les véhicules qui respectent le filtre
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
				echo'<p class="w3-text-green"> Prix : '.$donnees['prix_achat'].'</p>';
				echo'<p class="w3-text-green"> Climatisation : oui</p>';
				
				
				if($donnees['nb_disponible']>0) // si dispo 
				{
					if($mail=='') // si non co redirection sur page de co
					{
						echo '<a href="carmania_co.php"><button class="w3-green w3-button">Acheter</button></a>';
			
					}
					else
					{
						echo '<a href="carmania_achat.php?modele='.$donnees['modele'].'"><button class="w3-green w3-button">Acheter</button></a>';
					
					}
				
				}
				
				else // si non dispo
					echo '<button class="w3-green w3-button w3-disabled">Stock épuisé !</button>';
				if(isset($_SESSION['level']) && $_SESSION['level']==1) // si admin il peut supprimer
					echo '<a href="carmania_sup.php?pk='.$donnees['idVehicule_achat'].'&mode="a"><button class="w3-green w3-button w3-disabled">Supprimer</button></a>';
				
				echo'</div>';
				
				
				
			}
			if($rien==1)
				echo'<p class="w3-text-green">Aucune voitures ne répond à vos critères :( </p>';
			echo'<div class="w3-center"><div class="w3-bar">';
			// pagination
			if($page >1)
				
				echo'<button onclick="rec('.($page-1).')" class="w3-bar-item w3-button w3-text-green">&laquo;</button>';
			else
				
				echo'<button onclick="rec(1)" class="w3-bar-item w3-button w3-text-green">&laquo;</button>';
			for($i=1; $i<=$nb_pages; $i++)
				
				echo'<button onclick="rec('.$i.')" class="w3-bar-item w3-button w3-text-green">'.$i.'</button>';
			if($page < $nb_pages)
				
				echo'<button onclick="rec('.($page+1).')" class="w3-bar-item w3-button w3-text-green">&raquo;</button>';
			else
				
				echo'<button onclick="rec('.$nb_pages.')" class="w3-bar-item w3-button w3-text-green">&raquo;</button>';
			
			echo'</div></div></div>';
			// fin pagination
			?>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
		<script>
		function rec(p) // fonction de filtrage
			{
				var url="carmania_recherche_a.php?page="+p+"&marque=<?php$_GET['marque']?>&transmission=<?php$_GET['transmission']?>&prix=<?php$_GET['prix']?>";
				var element= document.getElementById("centrer");
				
				while(element.firstChild)
				{
					element.removeChild(element.firstChild);
				}
				
				$.post(url, function(data)
				{
					
					
					$('#centrer').html(data);
				});
			}
		</script>
				
				
				
				
				
				
				
				
				
