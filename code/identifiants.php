<?php
date_default_timezone_set('Europe/Paris'); // pour résoudre des erreurs sur linux
try  // co à al base de données
{ 
$db = new PDO('mysql:host=localhost;dbname=carmania', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>
