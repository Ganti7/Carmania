<?php
try
{
$db = new PDO('mysql:host=localhost;dbname=carmania', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>
