CREATE DATABASE Store_manager_pro;

CREATE TABLE Role (
    id SERIAL PRIMARY KEY,
    libelle VARCHAR(100) NOT NULL
);

CREATE TABLE Utilisateur (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    motDePasse VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    CONSTRAINT fk_utilisateur_role FOREIGN KEY (role_id) REFERENCES "Role"(id)
);

CREATE TABLE Client (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    telephone VARCHAR(50),
    adresse TEXT,
    encoursTotal NUMERIC(12, 2) DEFAULT 0.00
);

CREATE TABLE Fournisseur (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    telephone VARCHAR(50),
    soldeCompte NUMERIC(12, 2) DEFAULT 0.00
);

CREATE TABLE Produit (
    id SERIAL PRIMARY KEY,
    libelle VARCHAR(200) NOT NULL,
    prixUnitaire NUMERIC(12, 2) NOT NULL,
    stockActuel INT NOT NULL DEFAULT 0,
    seuilAlerteRupture INT DEFAULT 5
);

CREATE TABLE Vente (
    id SERIAL PRIMARY KEY,
    dateVente TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    montantTotal NUMERIC(12, 2) NOT NULL,
    montantEncaisse NUMERIC(12, 2) NOT NULL,
    typePaiement VARCHAR(50) NOT NULL,
    statutPaiement VARCHAR(50) NOT NULL,
    utilisateur_id INT NOT NULL,
    client_id INT NOT NULL,
    CONSTRAINT fk_vente_utilisateur FOREIGN KEY (utilisateur_id) REFERENCES "Utilisateur"(id),
    CONSTRAINT fk_vente_client FOREIGN KEY (client_id) REFERENCES "Client"(id)
);

CREATE TABLE LigneVente (
    id SERIAL PRIMARY KEY,
    quantite INT NOT NULL,
    prixUnitaire NUMERIC(12, 2) NOT NULL,
    vente_id INT NOT NULL,
    produit_id INT NOT NULL,
    CONSTRAINT fk_lignevente_vente FOREIGN KEY (vente_id) REFERENCES "Vente"(id) ON DELETE CASCADE,
    CONSTRAINT fk_lignevente_produit FOREIGN KEY (produit_id) REFERENCES "Produit"(id)
);

CREATE TABLE Dette (
    id SERIAL PRIMARY KEY,
    montantInitial NUMERIC(12, 2) NOT NULL,
    resteAPayer NUMERIC(12, 2) NOT NULL,
    dateEcheance DATE,
    estSoldee BOOLEAN NOT NULL DEFAULT FALSE,
    client_id INT NOT NULL,
    CONSTRAINT fk_dette_client FOREIGN KEY (client_id) REFERENCES "Client"(id)
);

CREATE TABLE PaiementDette (
    id SERIAL PRIMARY KEY,
    montantPaye NUMERIC(12, 2) NOT NULL,
    datePaiement TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    methodePaiement VARCHAR(50) NOT NULL,
    dette_id INT NOT NULL,
    CONSTRAINT fk_paiementdette_dette FOREIGN KEY (dette_id) REFERENCES "Dette"(id) ON DELETE CASCADE
);

CREATE TABLE Approvisionnement (
    id SERIAL PRIMARY KEY,
    dateApprovisionnement TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    coutTotal NUMERIC(12, 2) NOT NULL,
    referenceBon VARCHAR(100),
    utilisateur_id INT NOT NULL,
    fournisseur_id INT NOT NULL,
    CONSTRAINT fk_appro_utilisateur FOREIGN KEY (utilisateur_id) REFERENCES "Utilisateur"(id),
    CONSTRAINT fk_appro_fournisseur FOREIGN KEY (fournisseur_id) REFERENCES "Fournisseur"(id)
);

CREATE TABLE LigneApprovisionnement (
    id SERIAL PRIMARY KEY,
    quantiteCommandee INT NOT NULL,
    prixAchatUnitaire NUMERIC(12, 2) NOT NULL,
    approvisionnement_id INT NOT NULL,
    produit_id INT NOT NULL,
    CONSTRAINT fk_ligneappro_appro FOREIGN KEY (approvisionnement_id) REFERENCES "Approvisionnement"(id) ON DELETE CASCADE,
    CONSTRAINT fk_ligneappro_produit FOREIGN KEY (produit_id) REFERENCES "Produit"(id)
);