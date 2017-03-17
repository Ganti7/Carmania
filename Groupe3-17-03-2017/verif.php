<?php

$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;

$pseudo=(isset($_SESSION['mail']))?$_SESSION['mail']:'';

?>