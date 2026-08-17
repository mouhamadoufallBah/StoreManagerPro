PRAGMA foreign_keys = ON;

CREATE TABLE role (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    libelle TEXT NOT NULL
);

CREATE TABLE utilisateur (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    motdepasse TEXT NOT NULL,
    role_id INTEGER NOT NULL,
    CONSTRAINT fk_utilisateur_role FOREIGN KEY (role_id) REFERENCES role(id)
);

CREATE TABLE client (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    telephone TEXT,
    adresse TEXT,
    encourstotal NUMERIC(12,2) DEFAULT 0.00,
    limitecredit NUMERIC(8,2)
);

CREATE TABLE fournisseur (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    telephone TEXT,
    soldecompte NUMERIC(12,2) DEFAULT 0.00,
    adresse TEXT
);

CREATE TABLE produit (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    libelle TEXT NOT NULL,
    prixunitaire NUMERIC(12,2) NOT NULL,
    stockactuel INTEGER DEFAULT 0 NOT NULL,
    seuilalerterupture INTEGER DEFAULT 5
);

CREATE TABLE approvisionnement (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    dateapprovisionnement DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    couttotal NUMERIC(12,2) NOT NULL,
    referencebon TEXT,
    utilisateur_id INTEGER NOT NULL,
    fournisseur_id INTEGER NOT NULL,
    CONSTRAINT fk_appro_fournisseur FOREIGN KEY (fournisseur_id) REFERENCES fournisseur(id),
    CONSTRAINT fk_appro_utilisateur FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id)
);

CREATE TABLE ligneapprovisionnement (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    quantitecommandee INTEGER NOT NULL,
    prixachatunitaire NUMERIC(12,2) NOT NULL,
    approvisionnement_id INTEGER NOT NULL,
    produit_id INTEGER NOT NULL,
    quantiterecu NUMERIC(8,2),
    CONSTRAINT fk_ligneappro_appro FOREIGN KEY (approvisionnement_id) REFERENCES approvisionnement(id) ON DELETE CASCADE,
    CONSTRAINT fk_ligneappro_produit FOREIGN KEY (produit_id) REFERENCES produit(id)
);

CREATE TABLE vente (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    datevente DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    montanttotal NUMERIC(12,2) NOT NULL,
    montantencaisse NUMERIC(12,2) NOT NULL,
    typepaiement TEXT NOT NULL,
    statutpaiement TEXT NOT NULL,
    utilisateur_id INTEGER NOT NULL,
    client_id INTEGER NOT NULL,
    CONSTRAINT fk_vente_client FOREIGN KEY (client_id) REFERENCES client(id),
    CONSTRAINT fk_vente_utilisateur FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id)
);

CREATE TABLE lignevente (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    quantite INTEGER NOT NULL,
    prixunitaire NUMERIC(12,2) NOT NULL,
    vente_id INTEGER NOT NULL,
    produit_id INTEGER NOT NULL,
    CONSTRAINT fk_lignevente_produit FOREIGN KEY (produit_id) REFERENCES produit(id),
    CONSTRAINT fk_lignevente_vente FOREIGN KEY (vente_id) REFERENCES vente(id) ON DELETE CASCADE
);

CREATE TABLE dette (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    montantinitial NUMERIC(12,2) NOT NULL,
    resteapayer NUMERIC(12,2) NOT NULL,
    dateecheance TEXT,
    estsoldee BOOLEAN DEFAULT 0 NOT NULL,
    venteid INTEGER,
    CONSTRAINT dette_venteid_fkey FOREIGN KEY (venteid) REFERENCES vente(id)
);

CREATE TABLE paiementdette (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    montantpaye NUMERIC(12,2) NOT NULL,
    datepaiement DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    methodepaiement TEXT NOT NULL,
    dette_id INTEGER NOT NULL,
    CONSTRAINT fk_paiementdette_dette FOREIGN KEY (dette_id) REFERENCES dette(id) ON DELETE CASCADE
);