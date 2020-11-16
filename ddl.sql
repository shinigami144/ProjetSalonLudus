DROP DATABASE IF EXISTS SalonVirtuel;
CREATE DATABASE IF NOT EXISTS SalonVirtuel;

USE SalonVirtuel;

DROP TABLE IF EXISTS Fichier;
DROP TABLE IF EXISTS StockageInfo;
DROP TABLE IF EXISTS AdminStand;
DROP TABLE IF EXISTS AdminSalon;
DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Stand;
DROP TABLE IF EXISTS Salon;
DROP TABLE IF EXISTS SuperAdmin;


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
	regionSalon varchar(255),
	paysSalon varchar(255),
	stockInfoSalon int not null,
	idSuperAdmin int not null,
	FOREIGN KEY(idSuperAdmin) REFERENCES SuperAdmin(idSuperAdmin)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

CREATE TABLE IF NOT EXISTS Stand(
	idStand int not null primary key AUTO_INCREMENT,
	nomStand varchar(255) not null,
	imageStand varchar(255),
	pitchStand varchar(500),
	descriptionStand varchar(2000),
	ouvertureStand varchar(5) not null,
	fermetureSalon varchar(5) not null,
	ouvertStand int not null,
	stockInfoStand int not null,
	idSalon int not null,
	FOREIGN KEY(idSalon) REFERENCES Salon(idSalon)
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
	paysUtilsateur varchar(255),
	telUtilisateur varchar(13),
	verificationUtilisateur varchar(6),
	photoUtilisateur varchar(255),
	descriptionUtilisateur varchar(1000),
	entrepriseUtilisateur varchar(255),
	idStandRDV int,
	FOREIGN KEY(idStandRDV) REFERENCES Stand(idStand)
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

CREATE TABLE IF NOT EXISTS StockageInfo(
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