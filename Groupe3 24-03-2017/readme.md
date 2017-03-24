Sofiane :
  - Modification de la page carmania_co.php:
         Quand un utilisateur se connectait le site web le déconnectait aussitôt, rajout d'une variable de session qui retient  
         si l'utilisateur est connecté ou pas, la variable est supprimé quand le navigateur est fermé.
         La page redirige désormais vers une page d'inscription.
 - Création de la page d'inscription :
         La page d'inscription contient un formulaire à remplir par l'utilisateur (nom,prénom,ville,mot de passe, email), la page 
         vérifie si l'input mail est remplit, si il n'est pas déjà pris et si le mot de passe correspond au champ où l'utilisateur
         doit le retaper.
         Si tout est en ordre la page redirige vers la page d'accueil. Pour l'instant les données ne sont toujours pas ajouté dans 
         base de données.
 - Préparation de la page carmania_deco :
          La page permettra de déconnecter l'utilisateur. Pour l'instant pas au point.

Axel : 
  - Optimisation de la BDD, modfication de la table vehicule_location afin de faciliter les requêtes
          Ajout de stock de voitures disponibles à la location, et possédées par l'entreprise.
  - Divers renommages dans la BDD
  - Correction du dictionnaire de données
  - Ajout des attributs prix_journée et prix dans les tables vehicule_location et vehicule_achat. 
  - Mise à jour du dictionnaire de données reflètant les changements apportés.
  
 Alexandre :
  - Modification du CSS et de l'ergonomie, au niveau de la page d'accueil
          Les pages s'adaptent désormais à la taille de l'écran de l'utilisateur, déplacements des boutons de catalogue, style
          ajouté dans la page comme un logo.
  
  - Mise à jour du scrum:
          Ajout de ce qui à déjà été fait dans le scrum du projet.
  - Creation bouton location sur la page principale
          Le bouton location permettra de consulter le catalogue des voitures disponibles à la location.
  - Nettoyage fichier CSS
