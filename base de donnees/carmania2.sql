#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Utilisateur
#------------------------------------------------------------

CREATE TABLE Utilisateur(
        pk_utilisateur               int (11) Auto_increment  NOT NULL ,
        adresse_mail_utilisateur     Varchar (30) ,
        mot_de_passe                 Varchar (12) ,
        nom_utilisateur              Varchar (25) ,
        prenom_utilisateur           Varchar (30) ,
        ville_utilisateur            Varchar (25) ,
        date_inscription_utilisateur Date ,
        PRIMARY KEY (pk_utilisateur ) ,
        UNIQUE (adresse_mail_utilisateur )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Vehicule_location
#------------------------------------------------------------

CREATE TABLE Vehicule_location(
        immatriculation   Varchar (25) NOT NULL ,
        carburant         Varchar (25) ,
        puissance         Int ,
        marque            Varchar (25) ,
        modele            Varchar (60) ,
        transmission      Varchar (25) ,
        chemin_image      Varchar (200) ,
        climatisation     Bool ,
        empreinte_carbone Int ,
        disponible        Bool ,
        PRIMARY KEY (immatriculation )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Voiture_location
#------------------------------------------------------------

CREATE TABLE Voiture_location(
        portes          Int ,
        couleur         Char (25) ,
        immatriculation Varchar (25) NOT NULL ,
        PRIMARY KEY (immatriculation )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Camion_location
#------------------------------------------------------------

CREATE TABLE Camion_location(
        poids           Int ,
        volume          Int ,
        hauteur         Varchar (25) ,
        immatriculation Varchar (25) NOT NULL ,
        PRIMARY KEY (immatriculation )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: admin
#------------------------------------------------------------

CREATE TABLE admin(
        id     int (11) Auto_increment  NOT NULL ,
        nom    Char (25) ,
        prenom Char (25) ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Reclamation
#------------------------------------------------------------

CREATE TABLE Reclamation(
        reclamation_pk int (11) Auto_increment  NOT NULL ,
        date_ouverture Date ,
        etat           Varchar (25) ,
        objet          Varchar (25) ,
        texte          Varchar (280) ,
        date_fermeture Date ,
        pk_utilisateur Int ,
        PRIMARY KEY (reclamation_pk )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Vehicule_achat
#------------------------------------------------------------

CREATE TABLE Vehicule_achat(
        idVehicule        int (11) Auto_increment  NOT NULL ,
        carburant         Varchar (25) ,
        puissance         Int ,
        marque            Varchar (25) ,
        modele            Varchar (60) ,
        transmission      Varchar (25) ,
        chemin_image      Varchar (200) ,
        climatisation     Bool ,
        empreinte_carbone Int ,
        nb_disponible     Int ,
        PRIMARY KEY (idVehicule )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Camion_achat
#------------------------------------------------------------

CREATE TABLE Camion_achat(
        poids      Int ,
        volume     Int ,
        hauteur    Varchar (25) ,
        idVehicule Int NOT NULL ,
        PRIMARY KEY (idVehicule )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Voiture_achat
#------------------------------------------------------------

CREATE TABLE Voiture_achat(
        portes     Int ,
        couleur    Char (25) ,
        idVehicule Int NOT NULL ,
        PRIMARY KEY (idVehicule )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: achete
#------------------------------------------------------------

CREATE TABLE achete(
        date_achat     Date ,
        pk_utilisateur Int NOT NULL ,
        idVehicule     Int NOT NULL ,
        PRIMARY KEY (pk_utilisateur ,idVehicule )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: loue
#------------------------------------------------------------

CREATE TABLE loue(
        date_debut      Date ,
        date_fin        Date ,
        pk_utilisateur  Int NOT NULL ,
        immatriculation Varchar (25) NOT NULL ,
        PRIMARY KEY (pk_utilisateur ,immatriculation )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gere
#------------------------------------------------------------

CREATE TABLE gere(
        id              Int NOT NULL ,
        immatriculation Varchar (25) NOT NULL ,
        idVehicule      Int NOT NULL ,
        PRIMARY KEY (id ,immatriculation ,idVehicule )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: administre
#------------------------------------------------------------

CREATE TABLE administre(
        reclamation_pk Int NOT NULL ,
        id             Int NOT NULL ,
        PRIMARY KEY (reclamation_pk ,id )
)ENGINE=InnoDB;

ALTER TABLE Voiture_location ADD CONSTRAINT FK_Voiture_location_immatriculation FOREIGN KEY (immatriculation) REFERENCES Vehicule_location(immatriculation);
ALTER TABLE Camion_location ADD CONSTRAINT FK_Camion_location_immatriculation FOREIGN KEY (immatriculation) REFERENCES Vehicule_location(immatriculation);
ALTER TABLE Reclamation ADD CONSTRAINT FK_Reclamation_pk_utilisateur FOREIGN KEY (pk_utilisateur) REFERENCES Utilisateur(pk_utilisateur);
ALTER TABLE Camion_achat ADD CONSTRAINT FK_Camion_achat_idVehicule FOREIGN KEY (idVehicule) REFERENCES Vehicule_achat(idVehicule);
ALTER TABLE Voiture_achat ADD CONSTRAINT FK_Voiture_achat_idVehicule FOREIGN KEY (idVehicule) REFERENCES Vehicule_achat(idVehicule);
ALTER TABLE achete ADD CONSTRAINT FK_achete_pk_utilisateur FOREIGN KEY (pk_utilisateur) REFERENCES Utilisateur(pk_utilisateur);
ALTER TABLE achete ADD CONSTRAINT FK_achete_idVehicule FOREIGN KEY (idVehicule) REFERENCES Vehicule_achat(idVehicule);
ALTER TABLE loue ADD CONSTRAINT FK_loue_pk_utilisateur FOREIGN KEY (pk_utilisateur) REFERENCES Utilisateur(pk_utilisateur);
ALTER TABLE loue ADD CONSTRAINT FK_loue_immatriculation FOREIGN KEY (immatriculation) REFERENCES Vehicule_location(immatriculation);
ALTER TABLE gere ADD CONSTRAINT FK_gere_id FOREIGN KEY (id) REFERENCES admin(id);
ALTER TABLE gere ADD CONSTRAINT FK_gere_immatriculation FOREIGN KEY (immatriculation) REFERENCES Vehicule_location(immatriculation);
ALTER TABLE gere ADD CONSTRAINT FK_gere_idVehicule FOREIGN KEY (idVehicule) REFERENCES Vehicule_achat(idVehicule);
ALTER TABLE administre ADD CONSTRAINT FK_administre_reclamation_pk FOREIGN KEY (reclamation_pk) REFERENCES Reclamation(reclamation_pk);
ALTER TABLE administre ADD CONSTRAINT FK_administre_id FOREIGN KEY (id) REFERENCES admin(id);
