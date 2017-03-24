#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Utilisateur
#------------------------------------------------------------

CREATE TABLE Utilisateur(
        adresse_mail_utilisateur     Varchar (30) NOT NULL ,
        mot_de_passe                 Varchar (12) NOT NULL ,
        nom_utilisateur              Varchar (25) NOT NULL ,
        prenom_utilisateur           Varchar (30) NOT NULL ,
        ville_utilisateur            Varchar (25) ,
        date_inscription_utilisateur Date ,
        PRIMARY KEY (adresse_mail_utilisateur )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Vehicule_location
#------------------------------------------------------------

CREATE TABLE Vehicule_location(
        idVehicule_location int (11) Auto_increment  NOT NULL ,
        prix_journee        DECIMAL (15,3)  ,
        carburant           Varchar (25) ,
        puissance           Int ,
        marque              Varchar (25) ,
        modele              Varchar (60) ,
        transmission        Varchar (25) ,
        chemin_image        Varchar (200) ,
        climatisation       Bool ,
        empreinte_carbone   Int ,
        nb_disponible       Int ,
        nb_stock            Int ,
        PRIMARY KEY (idVehicule_location )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Voiture_location
#------------------------------------------------------------

CREATE TABLE Voiture_location(
        portes              Int ,
        couleur             Char (25) ,
        idVehicule_location Int NOT NULL ,
        PRIMARY KEY (idVehicule_location )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Camion_location
#------------------------------------------------------------

CREATE TABLE Camion_location(
        poids               Int ,
        volume              Int ,
        hauteur             Varchar (25) ,
        idVehicule_location Int NOT NULL ,
        PRIMARY KEY (idVehicule_location )
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
        reclamation_pk           int (11) Auto_increment  NOT NULL ,
        date_ouverture           Date ,
        etat                     Varchar (25) ,
        objet                    Varchar (25) ,
        texte                    Varchar (280) ,
        date_fermeture           Date ,
        adresse_mail_utilisateur Varchar (30) ,
        PRIMARY KEY (reclamation_pk )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Vehicule_achat
#------------------------------------------------------------

CREATE TABLE Vehicule_achat(
        idVehicule_achat  int (11) Auto_increment  NOT NULL ,
        prix_achat        DECIMAL (15,3)  ,
        carburant         Varchar (25) ,
        puissance         Int ,
        marque            Varchar (25) ,
        modele            Varchar (60) ,
        transmission      Varchar (25) ,
        chemin_image      Varchar (200) ,
        climatisation     Bool ,
        empreinte_carbone Int ,
        nb_disponible     Int ,
        PRIMARY KEY (idVehicule_achat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Camion_achat
#------------------------------------------------------------

CREATE TABLE Camion_achat(
        poids            Int ,
        volume           Int ,
        hauteur          Varchar (25) ,
        idVehicule_achat Int NOT NULL ,
        PRIMARY KEY (idVehicule_achat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Voiture_achat
#------------------------------------------------------------

CREATE TABLE Voiture_achat(
        portes           Int ,
        couleur          Char (25) ,
        idVehicule_achat Int NOT NULL ,
        PRIMARY KEY (idVehicule_achat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: achete
#------------------------------------------------------------

CREATE TABLE achete(
        date_achat               Date ,
        adresse_mail_utilisateur Varchar (30) NOT NULL ,
        idVehicule_achat         Int NOT NULL ,
        PRIMARY KEY (adresse_mail_utilisateur ,idVehicule_achat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: loue
#------------------------------------------------------------

CREATE TABLE loue(
        date_debut               Date ,
        date_fin                 Date ,
        adresse_mail_utilisateur Varchar (30) NOT NULL ,
        idVehicule_location      Int NOT NULL ,
        PRIMARY KEY (adresse_mail_utilisateur ,idVehicule_location )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gere
#------------------------------------------------------------

CREATE TABLE gere(
        id                  Int NOT NULL ,
        idVehicule_location Int NOT NULL ,
        idVehicule_achat    Int NOT NULL ,
        PRIMARY KEY (id ,idVehicule_location ,idVehicule_achat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: administre
#------------------------------------------------------------

CREATE TABLE administre(
        reclamation_pk Int NOT NULL ,
        id             Int NOT NULL ,
        PRIMARY KEY (reclamation_pk ,id )
)ENGINE=InnoDB;

ALTER TABLE Voiture_location ADD CONSTRAINT FK_Voiture_location_idVehicule_location FOREIGN KEY (idVehicule_location) REFERENCES Vehicule_location(idVehicule_location);
ALTER TABLE Camion_location ADD CONSTRAINT FK_Camion_location_idVehicule_location FOREIGN KEY (idVehicule_location) REFERENCES Vehicule_location(idVehicule_location);
ALTER TABLE Reclamation ADD CONSTRAINT FK_Reclamation_adresse_mail_utilisateur FOREIGN KEY (adresse_mail_utilisateur) REFERENCES Utilisateur(adresse_mail_utilisateur);
ALTER TABLE Camion_achat ADD CONSTRAINT FK_Camion_achat_idVehicule_achat FOREIGN KEY (idVehicule_achat) REFERENCES Vehicule_achat(idVehicule_achat);
ALTER TABLE Voiture_achat ADD CONSTRAINT FK_Voiture_achat_idVehicule_achat FOREIGN KEY (idVehicule_achat) REFERENCES Vehicule_achat(idVehicule_achat);
ALTER TABLE achete ADD CONSTRAINT FK_achete_adresse_mail_utilisateur FOREIGN KEY (adresse_mail_utilisateur) REFERENCES Utilisateur(adresse_mail_utilisateur);
ALTER TABLE achete ADD CONSTRAINT FK_achete_idVehicule_achat FOREIGN KEY (idVehicule_achat) REFERENCES Vehicule_achat(idVehicule_achat);
ALTER TABLE loue ADD CONSTRAINT FK_loue_adresse_mail_utilisateur FOREIGN KEY (adresse_mail_utilisateur) REFERENCES Utilisateur(adresse_mail_utilisateur);
ALTER TABLE loue ADD CONSTRAINT FK_loue_idVehicule_location FOREIGN KEY (idVehicule_location) REFERENCES Vehicule_location(idVehicule_location);
ALTER TABLE gere ADD CONSTRAINT FK_gere_id FOREIGN KEY (id) REFERENCES admin(id);
ALTER TABLE gere ADD CONSTRAINT FK_gere_idVehicule_location FOREIGN KEY (idVehicule_location) REFERENCES Vehicule_location(idVehicule_location);
ALTER TABLE gere ADD CONSTRAINT FK_gere_idVehicule_achat FOREIGN KEY (idVehicule_achat) REFERENCES Vehicule_achat(idVehicule_achat);
ALTER TABLE administre ADD CONSTRAINT FK_administre_reclamation_pk FOREIGN KEY (reclamation_pk) REFERENCES Reclamation(reclamation_pk);
ALTER TABLE administre ADD CONSTRAINT FK_administre_id FOREIGN KEY (id) REFERENCES admin(id);
