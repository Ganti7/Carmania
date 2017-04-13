<?php
session_start();
include("identifiants.php");
include("verif.php");


include("header.php");

$_SESSION['marque']=NULL;
$_SESSION['transmission']=NULL;
$_SESSION['prix']=NULL;
?>



	<html>

		<head>

			<meta name="viewport" content="width=device-width, initial-scale=1">

			<link rel="stylesheet" type="text/css" href="carmania.css">
			<link rel="stylesheet" type="text/css"  href="w3.css">
		</head>

	<body class="fond">
		<div class="w3-sidebar w3-bar-block w3-animate-left w3-green" style="display:none" id="mySidebar">
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
				
				<button id="20000"  onclick="recherche('20000')" href="#" class="w3-bar-item w3-button"><20000</button>
				<button id="30000" onclick="recherche('30000')"  href="#" class="w3-bar-item w3-button"><30000</button>
				<button id="70000" onclick="recherche('70000')"  href="#" class="w3-bar-item w3-button"><70000</button>
				
			</div>
		</div>
		<div class="color">
			<button class="w3-button w3-xlarge w3-green" onclick="w3_open()">☰</button>
			
		</div>
		
	<div class="fond">
		
		<?php
			$req=$db->query("SELECT * FROM vehicule_achat"); 
			
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
				echo'<p class="w3-text-green"> Prix : '.$donnees['prix_achat'].'</p>';
				echo'<p class="w3-text-green"> Climatisation : oui</p>';
				
				
				if($donnees['nb_disponible']>0)
				{
					if($mail=='')
					{
						echo '<a href="carmania_co.php"><button class="w3-green w3-button">Acheter</button></a>';
			
					}
					else
					{
						echo '<a href="carmania_achat.php?modele='.$donnees['modele'].'"><button class="w3-green w3-button">Acheter</button></a>';
					
					}
				
				}
				
				else
					echo '<button class="w3-green w3-button w3-disabled">Stock épuisé !</button>';
				
				echo'</div>';
				
				
				
			}
			echo'</div>';
			
			?>
			
		</div>
		
</body>
 

</html>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
		<script>
			function w3_open() {
				
				document.getElementById("mySidebar").style.display = "block";}
			function w3_close() {document.getElementById("mySidebar").style.display = "none";}
			function myAccFunc(id) 
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
			function recherche(id)
			{
				var x = document.getElementById(id);
				var tab=['Renault','Citroen','Volkswagen','Audi'];
				var tab2=['Manuelle','Automatique'];
				var tab3=['20000','30000','70000'];
				
				if(id=="Renault" || id=="Citroen" || id=="Volkswagen" || id=="Audi")   
				{
					if (x.className.indexOf("deja") == -1) 
					{
						x.className += " deja";
						x.className += " w3-green";
						var url="carmania_recherche_a.php?marque="+id+"&transmission=&prix=";
					}
					else
					{
						x.className = x.className.replace(" deja", "");
						x.className = x.className.replace(" w3-green","");
						var url='carmania_recherche_a.php?marque=r&transmission=&prix=';
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
						var url="carmania_recherche_a.php?marque=&transmission="+id+"&prix=";
					}
					else
					{
						x.className = x.className.replace(" deja", "");
						x.className = x.className.replace(" w3-green","");
						var url='carmania_recherche_a.php?marque=&transmission=r&prix=';
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
				if(id=="20000" || id=="30000" || id=="70000")   
				{
					if (x.className.indexOf("deja") == -1) 
					{
						x.className += " deja";
						x.className += " w3-green";
						var url="carmania_recherche_a.php?marque=&transmission=&prix="+id;
					}
					else
					{
						x.className = x.className.replace(" deja", "");
						x.className = x.className.replace(" w3-green","");
						var url='carmania_recherche_a.php?marque=r&transmission=&prix=r';
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
		</script>
		