<?php  
	session_start();
	include("identifiants.php");
	include("verif.php");


	if($_GET['mode']=="a")  // si on veut supprimer un vehicule à l'achat
	{
		$query=$db->prepare('DELETE FROM voiture_achat  WHERE idVehicule_achat="'.$_GET['pk'].'"');
		$query->execute();
		$query->CloseCursor();
		$query=$db->prepare('DELETE FROM camion_achat  WHERE idVehicule_achat="'.$_GET['pk'].'"');
		$query->execute();
		$query->CloseCursor();
		$query=$db->prepare('DELETE FROM vehicule_achat  WHERE idVehicule_achat="'.$_GET['pk'].'"');
		$query->execute();
		$query->CloseCursor();
	}
		
	else  // supp location
	{
		$query=$db->prepare('DELETE FROM voiture_location  WHERE idVehicule_location="'.$_GET['pk'].'"');
		$query->execute();
		$query->CloseCursor();
		$query=$db->prepare('DELETE FROM camion_location  WHERE idVehicule_location="'.$_GET['pk'].'"');
		$query->execute();
		$query->CloseCursor();
		$query=$db->prepare('DELETE FROM vehicule_location  WHERE idVehicule_location="'.$_GET['pk'].'"');
		$query->execute();
		$query->CloseCursor();
	}

?>