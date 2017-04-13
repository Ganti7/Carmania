<?php
function erreur($err='')
{
   $mess=($err!='')? $err:'Une erreur inconnue s\'est produite';
   exit('<p>'.$mess.'</p>
   <p>Cliquez <a href="carmania.php">ici</a> pour revenir à la page d\'accueil</p>
   </div></body></html>');
   
}


function verifmdp($mdp,$confirm,$i)
{
    if ($mdp != $confirm || empty($confirm) || empty($mdp))
        {
				
        	//$mdp_erreur = "Votre mot de passe et votre confirmation diffèrent, ou sont vides";
		$i++;
	}
    
    
}
?>

