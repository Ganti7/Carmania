<?php

//if(!isset($page)) $page =$_SERVER["HTTP_REFERER"];

//$page=(isset($_SESSION['page']))?$_SESSION['page']:$_SERVER["HTTP_REFERER"];
//$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;

$mail=(isset($_SESSION['mail']))?$_SESSION['mail']:'';

?>