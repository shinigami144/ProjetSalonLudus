DROP DATABASE IF EXISTS SalonVirtuel;
CREATE DATABASE IF NOT EXISTS SalonVirtuel;

USE SalonVirtuel;

DROP TABLE IF EXISTS ImageGagnee;
DROP TABLE IF EXISTS ImageAGagner;
DROP TABLE IF EXISTS Fichier;
DROP TABLE IF EXISTS StockageInfoStand;
DROP TABLE IF EXISTS StockageInfoSalon;
DROP TABLE IF EXISTS AdminStand;
DROP TABLE IF EXISTS AdminSalon;
DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Stand;
DROP TABLE IF EXISTS Salon;
DROP TABLE IF EXISTS SuperAdmin;
DROP TABLE IF EXISTS Pays;


CREATE TABLE IF NOT EXISTS `pays` (
	idPays smallint(5) unsigned NOT NULL AUTO_INCREMENT,
	codePays int(3) NOT NULL,
	alpha2Pays varchar(2) NOT NULL,
	alpha3Pays varchar(3) NOT NULL,
	nom_en_gb varchar(45) NOT NULL,
	nom_fr_fr varchar(45) NOT NULL,
	PRIMARY KEY (idPays),
	UNIQUE KEY alpha2 (alpha2Pays),
	UNIQUE KEY alpha3 (alpha3Pays),
	UNIQUE KEY code_unique (codePays)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs AUTO_INCREMENT=242 ;

CREATE TABLE IF NOT EXISTS SuperAdmin(
	idSuperAdmin int not null primary key AUTO_INCREMENT,
	mailSuperAdmin varchar(255) not null,
	mdpSuperAdmin varchar(255) not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

CREATE TABLE IF NOT EXISTS Salon(
	idSalon int not null primary key AUTO_INCREMENT,
	nomSalon varchar(255) not null,
	imageSalon varchar(255),
	pitchSalon varchar(500),
	descriptionSalon varchar(2000),
	dateDebutSalon date not null,
	dateFinSalon date not null,
	ouvertureSalon varchar(5) not null,
	fermetureSalon varchar(5) not null,
	villeSalon varchar(500),
	regionSalon varchar(255),
	idPaysSalon smallint(5) unsigned,
	stockInfoSalon int not null,
	idSuperAdmin int,
	FOREIGN KEY(idSuperAdmin) REFERENCES SuperAdmin(idSuperAdmin),
	FOREIGN KEY(idPaysSalon) REFERENCES Pays(idPays)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

CREATE TABLE IF NOT EXISTS Stand(
	idStand int not null primary key AUTO_INCREMENT,
	nomStand varchar(255) not null,
	imageStand varchar(255),
	pitchStand varchar(500),
	adresseStand varchar(500),
	codePostalStand varchar(10),
	villeStand varchar(500),
	idPaysStand smallint(5) unsigned,
	descriptionStand varchar(2000),
	siteStand varchar(1000),
	ouvertureStand varchar(5) not null,
	fermetureStand varchar(5) not null,
	ouvertStand int not null,
	stockInfoStand int not null,
	idSalon int not null,
	acceptationStand int not null,
	nouvPropositionStand int,
	FOREIGN KEY(idSalon) REFERENCES Salon(idSalon),
	FOREIGN KEY(idPaysStand) REFERENCES Pays(idPays),
	FOREIGN KEY(nouvPropositionStand) REFERENCES Stand(idStand)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

CREATE TABLE IF NOT EXISTS Utilisateur(
	idUtilisateur int not null primary key AUTO_INCREMENT,
	mailUtilisateur varchar(255) not null,
	mdpUtilisateur varchar(255) not null,
	nomUtilisateur varchar(255) not null,
	prenomUtilisateur varchar(255) not null,
	adresseUtilisateur varchar(500),
	codePostalUtilsateur varchar(10),
	villeUtilisateur varchar(500),
	idPaysUtilsateur smallint(5) unsigned,
	telUtilisateur varchar(13),
	verificationUtilisateur varchar(6),
	photoUtilisateur varchar(255),
	descriptionUtilisateur varchar(1000),
	entrepriseUtilisateur varchar(255),
	idStandFdA int,
	positionFdA int,
	FOREIGN KEY(idStandFdA) REFERENCES Stand(idStand),
	FOREIGN KEY(idPaysUtilsateur) REFERENCES Pays(idPays)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

CREATE TABLE IF NOT EXISTS AdminSalon(
	idUtilisateur int not null,
	idSalon int not null,
	droitASalon int not null,
	PRIMARY KEY(idUtilisateur, idSalon),
	FOREIGN KEY(idUtilisateur) REFERENCES Utilisateur(idUtilisateur),
	FOREIGN KEY(idSalon) REFERENCES Salon(idSalon)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

CREATE TABLE IF NOT EXISTS AdminStand(
	idUtilisateur int not null,
	idStand int not null,
	droitAStand int not null,
	lienAStand varchar(500) not null,
	PRIMARY KEY(idUtilisateur, idStand),
	FOREIGN KEY(idUtilisateur) REFERENCES Utilisateur(idUtilisateur),
	FOREIGN KEY(idStand) REFERENCES Stand(idStand)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

CREATE TABLE IF NOT EXISTS StockageInfoSalon(
	idUtilisateur int not null,
	idSalon int not null,
	PRIMARY KEY(idUtilisateur, idSalon),
	FOREIGN KEY(idUtilisateur) REFERENCES Utilisateur(idUtilisateur),
	FOREIGN KEY(idSalon) REFERENCES Salon(idSalon)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

CREATE TABLE IF NOT EXISTS StockageInfoStand(
	idUtilisateur int not null,
	idStand int not null,
	PRIMARY KEY(idUtilisateur, idStand),
	FOREIGN KEY(idUtilisateur) REFERENCES Utilisateur(idUtilisateur),
	FOREIGN KEY(idStand) REFERENCES Stand(idStand)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

CREATE TABLE IF NOT EXISTS Fichier(
	idFichier int not null primary key AUTO_INCREMENT,
	nomFichier varchar(255) not null,
	lienFIchier varchar(255) not null,
	idStand int not null,
	FOREIGN KEY(idStand) REFERENCES Stand(idStand)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

CREATE TABLE IF NOT EXISTS ImageAGagner(
	idImage int not null primary key AUTO_INCREMENT,
	lienImage varchar(255) not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

CREATE TABLE IF NOT EXISTS ImageGagnee(
	idUtilisateur int not null,
	idImage int not null,
	PRIMARY KEY(idUtilisateur, idImage),
	FOREIGN KEY(idUtilisateur) REFERENCES Utilisateur(idUtilisateur),
	FOREIGN KEY(idImage) REFERENCES ImageAGagner(idImage)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;