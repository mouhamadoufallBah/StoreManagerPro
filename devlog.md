# 📓 Journal de Développement (DEVLOG)
**Nom & Prénom** : Mouhamadou Fall Bah  
**Projet** : StoreManager Pro (ERP PHP/POO)

## 1. Suivi Chronologique des Phases

### 🌃 [Vendredi - Phase 1] : Conception & BDD Fallback
- **Heure de réalisation** : 19h00 - 20h30
- **Ce qui a été fait** : Realisation du diagramme de clase et de use case
- **Difficultés / Obstacles** : Les difficulte que j'ai eu etait plutot au niveau de l'outils(plaintUml) il arrivait des moment ou tout les cas s'entremeler et jai decouvert que la cause etait le fait que j'utiliser les extend comme ca '<.' aulieu de '<..' 

- **Heure de réalisation** : 20h30 - 22h00
- **Ce qui a été fait** : Realisation du schema sql et sqlite
- **Difficultés / Obstacles** : j'ai eu un peu de mal a cerner le sqlite au debut car je pensais que je devais seulement creer le schema et le lier avec l'extension database dans vscode. jai tape cette commande pour creer le fichier erp.db"sqlite3 /home/moohamad/Bureau/StoreManagerPro/doc/erp.db < /home/moohamad/Bureau/StoreManagerPro/doc/schema_sqlite.sql" cette commande creer le fichier erp.db puis lit et execute les requette pour creer les table. Je note que jai installer sqlite3 et aussi on peus manipuler la base de donne via le terminal. Ce qui le differencie avec les sgbd sqlite n'as pas besoin de server.

- **Heure de réalisation** : 22h22 - 23h00
- **Ce qui a été fait** : Implementation de Database Singleton avec fallback automatique   PostgreSQL vers SQLite
- **Difficultés / Obstacles** : Le probleme qui m'as plus pris le temps cette de comprendre dabord le concept comment ca marche et c'etait quoi le but. pour pourquoi on utiliser certaine mot comme static dans cette classe. Le notion du fallback m'etait nouveau aussi mais maitenant j'ai compris qu'il nous permet juste si on arrive pas a ce connecter sur la bd distant il utilse le sqlite dans notre cas

### ☀️ [Samedi - Phase 2] : POO, Repositories & Ventes POS
- **Heure de réalisation** :  09h - 11h
- **Ce qui a été fait** : creation des entites POO avec encapsulation et methodes metier
- **Difficultés / Obstacles** : Je n'ai pas rencoontrer d'obstacle dans cette partie mais j'ai compris que l'encapsulation c'est le fait de rendre les attritbut private non modifiable la ou on instancie les objet mais on creer des methode public pour qui pourrons modifier l'etat de l'objet. Je me suis pose aussi pourqu'on tantot on utilise this tantot self et dans mes recherche j'ai vu que this faisais reference a l'objet a un instant T et self c'est la classe qui n'apartient a aucun objet.

- **Heure de réalisation** :  11h - 13h
- **Ce qui a été fait** : mise en place des classes Repository avec requetes preparees PDO
- **Difficultés / Obstacles** : Le probleme que j'ai rencontrer dans cette partie c'est comment ecrire mes 3 fichier sans me repeter sur l'ecriture des requtte et l'execution. Precedement dans le projet gestion note poo j'avais une classe database qu'on pouvait instancier et dedans j'avais toute les methode qui permettait de communiquer avec la base mais avec l'approche singleton je pouvais pas metre ses fonction dans la classe Database car il aurait plus de responsabilite que prevu. C'est dans cette optique que jai decouvert la notion d'heritage qui me permettrait de regrouper tout les code redondant Dans BaseRepository et les autre class Repository vont heriter de ses attribut et methode.
j'ai vu aussi si la classe paarent et enfant on des methode qui se ressemble on pouvais preciser lequel on fait appel si c'est le parent on le precede par parent:: sinon on met this

- **Heure de réalisation** :  14h - 17h
- **Ce qui a été fait** : implementation de VenteService avec transaction SQL et controle de limite de credit
- **Difficultés / Obstacles** : Le premiere probleme rencontrait apres avoir recuperer le code procedural du gestion de panier est qu'on peut pas utiliser define car c'est une fonction et jai decouvert le mot cle const et ce dernier apartient a la classe pour l'utiliser a l'interieur on est obliger d'utiliser self::CONSTANTE et en dehors on met le NomDuClase::CONSTANT. jai decouvert aussi deux nouvelle concepte que j'arrive toujours pas a dicerner qui sont injection de dependance et inversion de controlle.Dans mes recherches, j'ai vu qu'inversion de controlle c'est le fait de ne pas laisser une classe gerer tout elle meme de deleguer certaine processe a d'autre classe et injection de dependance qui est le fait de faire passer une autre classe en parametre dans le constructeur. J'arrive pas a voir la differnce entre ces deux notion. Je l'ai utiliser dans venteService en injectant VenteRepository car je voulais utiliser la methode saveVente.