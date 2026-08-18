<?php

namespace StoreManagerPro\Src\Repository;

use Exception;
use StoreManagerPro\Src\Core\Database;

class VenteRepository
{

    public function __construct() {}

    public static function saveVente(int $userId, int $clientId, float $montantTotal, float $montantEncaisse, string $typePaiement, array $panier): int
    {
        Database::getInstance()->beginTransaction();

        try {
            $sql = "SELECT * FROM vente WHERE clientId = :clientId";

            $client = Database::executeQuery($sql, ["clientId" => $clientId]);

            if (!$client) {
                throw new Exception('Client introuvable.');
            }
            $encoursActuel = (float)$client['encourstotal'];
            $limiteCredit = (float)$client['limitecredit'];

            $statutPaiement = ($montantEncaisse >= $montantTotal) ? 'Payé' : 'Partiel';
            $resteAPayer = 0.00;

            if ($statutPaiement === 'Partiel') {
                $resteAPayer = $montantTotal - $montantEncaisse;
                if (($encoursActuel + $resteAPayer) > $limiteCredit) {
                    throw new Exception("Vente refusée : Le client dépasse sa limite de crédit autorisée (Limite : {$limiteCredit}, Encours après vente : " . ($encoursActuel + $resteAPayer) . ").");
                }
            }

            $sql = "INSERT INTO vente (montantTotal, montantEncaisse, typePaiement, statutPaiement, utilisateur_id, client_id) VALUES (:montantTotal, :montantEncaisse, :typePaiement, :statutPaiement, :utilisateur_id, :client_id)";
            $venteId = Database::executeUpdate($sql, [
                "montantTotal" => $montantTotal,
                "montantEncaisse" => $montantEncaisse,
                "typePaiement" => $typePaiement,
                "statutPaiement" => $statutPaiement,
                "utilisateur_id" => $userId,
                "client_id" => $clientId
            ]);

            $sqlLigne = "INSERT INTO lignevente (quantite, prixUnitaire, vente_id, produit_id) VALUES (:quantite, :prixUnitaire, :vente_id, :produit_id)";

            $sqlProduit = "UPDATE produit SET stockActuel = stockActuel - :qte WHERE id = :id";

            foreach ($panier as $item) {
                $ligneId = Database::executeUpdate($sqlLigne, [
                    "quantite" => $item['qte'],
                    "prixUnitaire" => $item['produit']['prixUnitaire'],
                    "vente_id" => $venteId,
                    "produit_id" => $item['produit']['id']
                ]);

                if ($ligneId == 0) {
                    throw new Exception("Erreur lors de l'ajour dans la table ligne vente");
                }

                $ligneAffecte = Database::executeUpdate($sqlProduit, [
                    "qte" => $item['qte'],
                    "id" => $item['produit']['id']
                ]);

                if ($ligneAffecte == 0) {
                    throw new Exception("Erreur lors de la mis a jour dans la table produit");
                }
            }

            if ($statutPaiement === 'Partiel') {
                $sqlDette = "INSERT INTO dette (montantInitial, resteAPayer, estSoldee, venteId) VALUES (:montantInitial, :resteAPayer, FALSE, :venteId)";
                $detteId = Database::executeUpdate($sqlDette, [
                    "montantInitial" => $resteAPayer,
                    "resteAPayer" => $resteAPayer,
                    "venteId" => $venteId
                ]);

                if ($detteId == 0) {
                    throw new Exception("Erreur lors de l'ajout dans la table dette");
                }

                $sqlClient = "UPDATE client SET encoursTotal = encoursTotal + :resteAPayer WHERE id = :id";
                $ligneAffecte = Database::executeUpdate($sqlClient, [
                    "resteAPayer" => $resteAPayer,
                    "id" =>  $clientId
                ]);

                 if ($ligneAffecte == 0) {
                    throw new Exception("Erreur lors de la mis a jour dans la table client");
                }
            }

            Database::getInstance()->commit();
            return $venteId;
        } catch (Exception $e) {
            Database::getInstance()->rollBack();
            throw $e;
        }
    }

    public static function findAllVenteAndLigne(): array
    {
        $sql = "SELECT v.*, c.nom, c.telephone 
                FROM vente v 
                JOIN client c ON v.client_id = c.id 
                ORDER BY v.id DESC";

        $ventes = Database::query($sql, false);

        $resultat = [];

        foreach ($ventes as $vente) {
            $sqlLigne = "SELECT lv.*, p.libelle FROM lignevente lv JOIN produit p ON lv.produit_id = p.id WHERE lv.vente_id = :venteId";
            $lignes = Database::executeQuery($sqlLigne, ["venteId" => $vente["id"]]);

            $vente['lignes'] = $lignes;
            $resultat[] = $vente;
        }

        return $resultat;
    }

    public static function getStats(): array
    {
        $sql = "
            WITH ca_encaisse AS (
                SELECT COALESCE(SUM(montantpaye), 0) AS ca_encaisse_net 
                FROM paiementdette
            ),
            encours_clients AS (
                SELECT COALESCE(SUM(encourstotal), 0) AS encours_client_total 
                FROM client
            ),
            total_ventes AS (
                SELECT COUNT(*) AS commandes_enregistrees 
                FROM vente
            )
            SELECT * FROM ca_encaisse, encours_clients, total_ventes;
        ";

        $result = Database::query($sql);

        return $result ? $result : [
            'ca_encaisse_net' => 0,
            'encours_client_total' => 0,
            'commandes_enregistrees' => 0
        ];
    }
}
