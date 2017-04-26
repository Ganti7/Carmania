<?php
	// var de session
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;

	$mail=(isset($_SESSION['mail']))?$_SESSION['mail']:'';
	$level=(isset($_SESSION['level']))?$_SESSION['level']:'0';
	//$_SESSION['level']=0;
?>