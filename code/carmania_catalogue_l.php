
<?php
	session_start();
	include("identifiants.php");
	include("verif.php");


	include("header.php");

	$_SESSION['marque']=NULL;
	$_SESSION['transmission']=NULL;
	$_SESSION['prix_journee']=NULL;
	$page = (!empty($_GET['page']) ? $_GET['page'] : 1);
?>



	<html>

		<head>

			<meta name="viewport" content="width=device-width, initial-scale=1">

			<link rel="stylesheet" type="text/css" href="carmania.css">
			<link rel="stylesheet" type="text/css"  href="w3.css">
		</head>

		<body class="fond">
			<div class="w3-sidebar w3-bar-block w3-animate-left w3-green" style="display:none" id="mySidebar"> <!-- barre de filtre situé a gauche -->
				<button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
				<button class="w3-button w3-block w3-left-align" onclick="myAccFunc('modele')">
					Modèle <i class="fa fa-caret-down"></i>
				</button>
				<div id="modele" class="w3-hide w3-white w3-card-2">
				
					<button id="Renault" onclick="recherche('Renault')" href="#" class="w3-bar-item w3-button">Renault</button>
					<button id="Volkswagen" onclick="recherche('Volkswagen')" href="#" class="w3-bar-item w3-button">Volkswagen</button>
					<button id="Audi" onclick="recherche('Audi')" href="#" class="w3-bar-item w3-button">Audi</button>
					<button id="Citroen" onclick="recherche('Citroen')" href="#" class="w3-bar-item w3-button">Citroën</button>
				</div>
				<button class="w3-button w3-block w3-left-align" onclick="myAccFunc('transmission')">
					Transmission<i class="fa fa-caret-down"></i>
				</button>
				<div id="transmission" class="w3-hide w3-white w3-card-2">
				
					<button id="Manuelle"  onclick="recherche('Manuelle')" href="#" class="w3-bar-item w3-button">Manuelle</button>
					<button id="Automatique" onclick="recherche('Automatique')"  href="#" class="w3-bar-item w3-button">Automatique</button>
				
				</div>
				<button class="w3-button w3-block w3-left-align" onclick="myAccFunc('prix')">
					Prix<i class="fa fa-caret-down"></i>
				</button>
				<div id="prix" class="w3-hide w3-white w3-card-2">
				
					<button id="15"  onclick="recherche('15')" href="#" class="w3-bar-item w3-button"><15</button>
					<button id="20" onclick="recherche('20')"  href="#" class="w3-bar-item w3-button"><20</button>
					<button id="30" onclick="recherche('30')"  href="#" class="w3-bar-item w3-button"><30</button>
				
				</div>
			</div>
			<div class="color">
				<button class="w3-button w3-xlarge w3-green" onclick="w3_open()">☰</button>
			
			</div> <!-- fin barre filtre -->
		
			<div class="fond">
		
				<?php
					$limite=2;    // var pour pagination
					$debut=($page-1)* $limite;    // var pour pagination
					$req=$db->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM vehicule_location LIMIT :limite OFFSET :debut");
					$req->bindValue('debut',$debut, PDO::PARAM_INT);
					$req->bindValue('limite',$limite, PDO::PARAM_INT);
					$req->execute();
					$resultFoundRows=$db->query('SELECT found_rows()');  // nb de tuples
					$nb_element_total=$resultFoundRows->fetchColumn();
					$nb_pages=ceil($nb_element_total / $limite); // pages pour pagination
			
					echo'<div id="centrer">';
			
					while($donnees = $req->fetch())  // on affiche les voitures disponibles dans le catalogue
					{
				
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
				
				
						if($donnees['nb_disponible']>0)   // si vehicule dispo
						{
							if($mail=='')    // si non connecté on redirige sur la page de connexion
							{
								echo '<a href="carmania_co.php"><button class="w3-green w3-button">Louer</button></a>';
			
							}
							else  // sinon on redirige sur la page d'achat
							{
								echo '<a href="carmania_location.php?modele='.$donnees['modele'].'&prix='.$donnees['prix_journee'].'&id='.$donnees['idVehicule_location'].'"><button class="w3-green w3-button">Louer</button></a>';
					
							}
						}
						else     // on affiche un bouton épuisé si véhicule non dispo
							echo '<button class="w3-green w3-button w3-disabled">Stock épuisé !</button>';
						if(isset($_SESSION['level']) && $_SESSION['level']==1) // si admin bouton pour supprimer le véhicule
						{ 
							echo '<a href="carmania_partic_vehic_l.php?page='.$page.'"><button class="w3-green w3-button" onclick="sup('.$donnees['idVehicule_location'].')">Supprimer</button></a>';
						}
						echo'</div>';
				
				
				
					}
					echo'<div class="w3-center"><div class="w3-bar">';       // affichage de la pagination
					if($page >1)      
						echo'<a href="carmania_catalogue_l.php?page='.($page-1).'" class="w3-bar-item w3-button w3-text-green">&laquo;</a>';
					else
						echo'<a href="carmania_catalogue_l.php?page=1" class="w3-bar-item w3-button w3-text-green">&laquo;</a>';
			
					for($i=1; $i<=$nb_pages; $i++)
						echo'<a href="carmania_catalogue_l.php?page='.$i.'" class="w3-button w3-text-green">'.$i.'</a>';
			
					if($page < $nb_pages)
						echo'<a href="carmania_catalogue_l.php?page='.($page+1).'" class="w3-bar-item w3-button w3-text-green">&raquo;</a>';
					else
						echo'<a href="carmania_catalogue_l.php?page='.$nb_pages.'" class="w3-bar-item w3-button w3-text-green">&raquo;</a>';
			
					echo'</div></div></div>';    // fin pagination
				?>
			
			
			
			</div>
		
		</body>
 

	</html>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<script>
		function w3_open()   // fonction pour ouvrir menu filtrage
		{
				
			document.getElementById("mySidebar").style.display = "block";}
		function w3_close()   // ferme menu filtrage
		{
			document.getElementById("mySidebar").style.display = "none";
		}
		function myAccFunc(id)    // affichage sous menu descendant
		{
			var x = document.getElementById(id);
			if (x.className.indexOf("w3-show") == -1) 
			{
				x.className += " w3-show";
				x.previousElementSibling.className += " w3-blue";
			} 
			else 
			{ 
				x.className = x.className.replace(" w3-show", "");
				x.previousElementSibling.className= 
				x.previousElementSibling.className.replace(" w3-blue", "");
			}
		}
		function recherche(id)    // fonction qui appelle script php pour filtrer 
		{
			var x = document.getElementById(id);
			var tab=['Renault','Citroen','Volkswagen','Audi'];
			var tab2=['Manuelle','Automatique'];
			var tab3=['15','20','30'];
				
			if(id=="Renault" || id=="Citroen" || id=="Volkswagen" || id=="Audi")   
			{
				if (x.className.indexOf("deja") == -1) 
				{
					x.className += " deja";
					x.className += " w3-green";
					var url="carmania_recherche_l.php?marque="+id+"&transmission=&prix=";
				}
				else
				{
					x.className = x.className.replace(" deja", "");
					x.className = x.className.replace(" w3-green","");
					var url='carmania_recherche_l.php?marque=r&transmission=&prix=';
				}
				
				for(var i=0;i<tab.length;i++)
				{
					var m=tab[i];
						
					if(m!=id)
					{
						var y= document.getElementById(m);
						if(y.className.indexOf("deja")!=-1)
						{
							y.className=y.className.replace(" deja", "");
							y.className = y.className.replace(" w3-green","");
						}
					}
				}
			}
					
			if(id=="Automatique" || id=="Manuelle")
			{	
				if (x.className.indexOf("deja") == -1) 
				{
					x.className += " deja";
					x.className += " w3-green";
					var url="carmania_recherche_l.php?marque=&transmission="+id+"&prix=";
				}
				else
				{
					x.className = x.className.replace(" deja", "");
					x.className = x.className.replace(" w3-green","");
					var url='carmania_recherche_l.php?marque=&transmission=r&prix=';
				}
				for(var i=0;i<tab2.length;i++)
				{
					var m=tab2[i];
						
					if(m!=id)
					{
						var y= document.getElementById(m);
						if(y.className.indexOf("deja")!=-1)
						{
							y.className=y.className.replace(" deja", "");
							y.className = y.className.replace(" w3-green","");
						}
					}
				}
			}
			if(id=="15" || id=="20" || id=="30")   
			{
				if (x.className.indexOf("deja") == -1) 
				{
					x.className += " deja";
					x.className += " w3-green";
					var url="carmania_recherche_l.php?marque=&transmission=&prix="+id;
				}
				else
				{
					x.className = x.className.replace(" deja", "");
					x.className = x.className.replace(" w3-green","");
					var url='carmania_recherche_l.php?marque=r&transmission=&prix=r';
				}
				
				for(var i=0;i<tab3.length;i++)
				{
					var m=tab3[i];
						
					if(m!=id)
					{
						var y= document.getElementById(m);
						if(y.className.indexOf("deja")!=-1)
						{
							y.className=y.className.replace(" deja", "");
							y.className = y.className.replace(" w3-green","");
						}
					}
				}
			}
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
		function sup(idv)
		{  // function qui appelle script php pour supprimer annonce
					
					var url="carmania_sup.php?pk="+idv+"&mode=l";
					$.post(url, function(data)
					{
						
					});
		}
	</script>
		