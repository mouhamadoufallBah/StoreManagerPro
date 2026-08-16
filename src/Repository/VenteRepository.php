<?php

namespace StoreManagerPro\Src\Repository;

use Exception;

class VenteRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('vente');
    }

    public function saveVente(int $userId, int $clientId, float $montantTotal, float $montantEncaisse, string $typePaiement, array $panier): int
    {
        $this->db->beginTransaction();

        try {
            $client = $this->findByKey("id", $clientId, "client", true);

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

            $stmt = $this->db->prepare("INSERT INTO vente (montantTotal, montantEncaisse, typePaiement, statutPaiement, utilisateur_id, client_id) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$montantTotal, $montantEncaisse, $typePaiement, $statutPaiement, $userId, $clientId]);
            $venteId = (int)$this->db->lastInsertId();

            $stmtLigne = $this->db->prepare("INSERT INTO lignevente (quantite, prixUnitaire, vente_id, produit_id) VALUES (?, ?, ?, ?)");
            $stmtStock = $this->db->prepare("UPDATE produit SET stockActuel = stockActuel - ? WHERE id = ?");

            foreach ($panier as $item) {
                $stmtLigne->execute([$item['qte'], $item['produit']['prixUnitaire'], $venteId, $item['produit']['id']]);
                $stmtStock->execute([$item['qte'], $item['produit']['id']]);
            }

            if ($statutPaiement === 'Partiel') {
                $stmtDette = $this->db->prepare("INSERT INTO dette (montantInitial, resteAPayer, estSoldee, venteId) VALUES (?, ?, FALSE, ?)");
                $stmtDette->execute([$resteAPayer, $resteAPayer, $venteId]);

                $stmtClientUpdate = $this->db->prepare("UPDATE client SET encoursTotal = encoursTotal + ? WHERE id = ?");
                $stmtClientUpdate->execute([$resteAPayer, $clientId]);
            }

            $this->db->commit();
            return $venteId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function findAllVenteAndLigne(): array
    {
        $sql = "SELECT v.*, c.nom, c.telephone 
                FROM vente v 
                JOIN client c ON v.client_id = c.id 
                ORDER BY v.id DESC";

        $stmt = $this->db->query($sql);
        $ventes = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $resultat = [];

        $stmtLignes = $this->db->prepare("
            SELECT lv.*, p.libelle 
            FROM lignevente lv 
            JOIN produit p ON lv.produit_id = p.id 
            WHERE lv.vente_id = ?
        ");

        foreach ($ventes as $vente) {
            $stmtLignes->execute([$vente['id']]);
            $lignes = $stmtLignes->fetchAll(\PDO::FETCH_ASSOC);

            $vente['lignes'] = $lignes;
            $resultat[] = $vente;
        }

        return $resultat;
    }
}
