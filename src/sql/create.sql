CREATE TABLE Categorie (nom varchar(255) NOT NULL, parent varchar(255), PRIMARY KEY (nom), FOREIGN KEY(parent) REFERENCES Categorie(nom));
CREATE TABLE Favori ("id-utilisateur" integer(10) NOT NULL, "id-produit" integer(10) NOT NULL, PRIMARY KEY ("id-utilisateur", "id-produit"), FOREIGN KEY("id-utilisateur") REFERENCES Utilisateur(id), FOREIGN KEY("id-produit") REFERENCES Produit(id));
CREATE TABLE Message (id integer(10) NOT NULL, Contenu varchar(65565) NOT NULL, "Date" date DEFAULT CURRENT_DATE NOT NULL, emetteur integer(10) NOT NULL, recepteur integer(10) NOT NULL, PRIMARY KEY (id, emetteur, recepteur), FOREIGN KEY(emetteur) REFERENCES Utilisateur(id), FOREIGN KEY(recepteur) REFERENCES Utilisateur(id));
CREATE TABLE Produit (id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, intitule varchar(255) NOT NULL, description varchar(65565) NOT NULL, prix float(10) NOT NULL, photo varchar(255) NOT NULL, categorie varchar(255) NOT NULL, "vendu-par" integer(10) NOT NULL, FOREIGN KEY(categorie) REFERENCES Categorie(nom), FOREIGN KEY("vendu-par") REFERENCES Utilisateur(id));
CREATE TABLE Utilisateur (id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT, nom varchar(255) NOT NULL, prenom varchar(255) NOT NULL, email varchar(255) NOT NULL, "mot-de-passe" varchar(255) NOT NULL);
CREATE INDEX Utilisateur_id ON Utilisateur (id);

