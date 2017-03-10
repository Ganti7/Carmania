#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE User(
        name_user             Varchar (25) ,
        mail_adress_user      Varchar (30) ,
        firstname_user        Varchar (30) ,
        city_user             Varchar (25) ,
        inscription_date_user Date ,
        pk_user               int (11) Auto_increment  NOT NULL ,
        PRIMARY KEY (pk_user ) ,
        UNIQUE (mail_adress_user )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Vehicule
#------------------------------------------------------------

CREATE TABLE Vehicule(
        immatriculation   Varchar (25) NOT NULL ,
        carburant         Varchar (25) ,
        power             Int ,
        marque            Varchar (25) ,
        modele            Varchar (60) ,
        transmission      Varchar (25) ,
        image_path        Varchar (200) ,
        climatisation     Bool ,
        empreinte_carbone Int ,
        disponible        Bool ,
        pk_user           Int ,
        PRIMARY KEY (immatriculation )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Voiture
#------------------------------------------------------------

CREATE TABLE Voiture(
        portes          Int ,
        couleur         Char (25) ,
        immatriculation Varchar (25) NOT NULL ,
        PRIMARY KEY (immatriculation )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Camion
#------------------------------------------------------------

CREATE TABLE Camion(
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
        nom    Char (25) ,
        prenom Char (25) ,
        id     int (11) Auto_increment  NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Reclamation
#------------------------------------------------------------

CREATE TABLE Reclamation(
        date_ouverture Date ,
        reclamation_pk int (11) Auto_increment  NOT NULL ,
        etat           Varchar (25) ,
        objet          Varchar (25) ,
        texte          Varchar (280) ,
        date_fermeture Date ,
        pk_user        Int ,
        PRIMARY KEY (reclamation_pk )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: loue
#------------------------------------------------------------

CREATE TABLE loue(
        date_debut      Date ,
        date_fin        Date ,
        pk_user         Int NOT NULL ,
        immatriculation Varchar (25) NOT NULL ,
        PRIMARY KEY (pk_user ,immatriculation )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gere
#------------------------------------------------------------

CREATE TABLE gere(
        id              Int NOT NULL ,
        immatriculation Varchar (25) NOT NULL ,
        PRIMARY KEY (id ,immatriculation )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: administre
#------------------------------------------------------------

CREATE TABLE administre(
        reclamation_pk Int NOT NULL ,
        id             Int NOT NULL ,
        PRIMARY KEY (reclamation_pk ,id )
)ENGINE=InnoDB;

ALTER TABLE Vehicule ADD CONSTRAINT FK_Vehicule_pk_user FOREIGN KEY (pk_user) REFERENCES User(pk_user);
ALTER TABLE Voiture ADD CONSTRAINT FK_Voiture_immatriculation FOREIGN KEY (immatriculation) REFERENCES Vehicule(immatriculation);
ALTER TABLE Camion ADD CONSTRAINT FK_Camion_immatriculation FOREIGN KEY (immatriculation) REFERENCES Vehicule(immatriculation);
ALTER TABLE Reclamation ADD CONSTRAINT FK_Reclamation_pk_user FOREIGN KEY (pk_user) REFERENCES User(pk_user);
ALTER TABLE loue ADD CONSTRAINT FK_loue_pk_user FOREIGN KEY (pk_user) REFERENCES User(pk_user);
ALTER TABLE loue ADD CONSTRAINT FK_loue_immatriculation FOREIGN KEY (immatriculation) REFERENCES Vehicule(immatriculation);
ALTER TABLE gere ADD CONSTRAINT FK_gere_id FOREIGN KEY (id) REFERENCES admin(id);
ALTER TABLE gere ADD CONSTRAINT FK_gere_immatriculation FOREIGN KEY (immatriculation) REFERENCES Vehicule(immatriculation);
ALTER TABLE administre ADD CONSTRAINT FK_administre_reclamation_pk FOREIGN KEY (reclamation_pk) REFERENCES Reclamation(reclamation_pk);
ALTER TABLE administre ADD CONSTRAINT FK_administre_id FOREIGN KEY (id) REFERENCES admin(id);