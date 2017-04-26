<?php // ferme les réclamations
	session_start();
	include("identifiants.php");
	include("verif.php");

	$temps = date("Y/m/d");

	$query=$db->prepare('UPDATE reclamation SET date_fermeture="'.$temps.'",etat="résolu"  WHERE reclamation_pk="'.$_GET['pk'].'"');
								
	$query->execute();
	$query->CloseCursor();
?>