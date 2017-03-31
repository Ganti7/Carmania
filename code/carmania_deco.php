<?php
session_start();
session_destroy();
include("identifiants.php");
include("verif.php");
include("constants.php");
include("functions.php");
?>



<!DOCTYPE html>

	<html class="fond">

		<head>

			<meta charset="UTF-8">

			<link rel="stylesheet" type="text/css" href="carmania.css">
		</head>

	<body>
		<h1>Carmania</h1>
		<?php
		
		if(!isset($page)) $page =$_SERVER["HTTP_REFERER"];
		?>
		
		<?php
		
		if ($id==0) erreur(ERR_IS_NOT_CO);
		?>
		
		<?php
					header("Location: carmania.php"); // redirection
                    echo '<p>Vous êtes à présent déconnecté <br />
                    Cliquez <a href="'.htmlspecialchars($_SERVER['HTTP_REFERER']).'">ici</a> 
                    pour revenir à la page précédente.<br />
                    Cliquez <a href="./index.php">ici</a> pour revenir à la page principale</p>';
                    echo '</div></body></html>';
                
		
						
    
			
?>

		



        

	</body>

</html>