PRAGMA foreign_keys = ON;

CREATE TABLE Role (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    libelle TEXT NOT NULL
);

CREATE TABLE Utilisateur (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    motDePasse TEXT NOT NULL,
    role_id INTEGER NOT NULL,
    FOREIGN KEY (role_id) REFERENCES Role(id)
);

CREATE TABLE Client (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    telephone TEXT,
    adresse TEXT,
    encoursTotal REAL DEFAULT 0.0
);

CREATE TABLE Fournisseur (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    telephone TEXT,
    soldeCompte REAL DEFAULT 0.0
);

CREATE TABLE Produit (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    libelle TEXT NOT NULL,
    prixUnitaire REAL NOT NULL,
    stockActuel INTEGER NOT NULL DEFAULT 0,
    seuilAlerteRupture INTEGER DEFAULT 5
);

CREATE TABLE Vente (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    dateVente TEXT NOT NULL, -- Format ISO8601 (YYYY-MM-DD HH:MM:SS)
    montantTotal REAL NOT NULL,
    montantEncaisse REAL NOT NULL,
    typePaiement TEXT NOT NULL,
    statutPaiement TEXT NOT NULL,
    utilisateur_id INTEGER NOT NULL,
    client_id INTEGER NOT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(id),
    FOREIGN KEY (client_id) REFERENCES Client(id)
);

CREATE TABLE LigneVente (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    quantite INTEGER NOT NULL,
    prixUnitaire REAL NOT NULL,
    vente_id INTEGER NOT NULL,
    produit_id INTEGER NOT NULL,
    FOREIGN KEY (vente_id) REFERENCES Vente(id) ON DELETE CASCADE,
    FOREIGN KEY (produit_id) REFERENCES Produit(id)
);

CREATE TABLE Dette (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    montantInitial REAL NOT NULL,
    resteAPayer REAL NOT NULL,
    dateEcheance TEXT,
    estSoldee BOOLEAN NOT NULL DEFAULT 0,
    client_id INTEGER NOT NULL,
    FOREIGN KEY (client_id) REFERENCES Client(id)
);

CREATE TABLE PaiementDette (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    montantPaye REAL NOT NULL,
    datePaiement TEXT NOT NULL,
    methodePaiement TEXT NOT NULL,
    dette_id INTEGER NOT NULL,
    FOREIGN KEY (dette_id) REFERENCES Dette(id) ON DELETE CASCADE
);

CREATE TABLE Approvisionnement (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    dateApprovisionnement TEXT NOT NULL,
    coutTotal REAL NOT NULL,
    referenceBon TEXT,
    utilisateur_id INTEGER NOT NULL,
    fournisseur_id INTEGER NOT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(id),
    FOREIGN KEY (fournisseur_id) REFERENCES Fournisseur(id)
);

CREATE TABLE LigneApprovisionnement (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    quantiteCommandee INTEGER NOT NULL,
    prixAchatUnitaire REAL NOT NULL,
    approvisionnement_id INTEGER NOT NULL,
    produit_id INTEGER NOT NULL,
    FOREIGN KEY (approvisionnement_id) REFERENCES Approvisionnement(id) ON DELETE CASCADE,
    FOREIGN KEY (produit_id) REFERENCES Produit(id)
);