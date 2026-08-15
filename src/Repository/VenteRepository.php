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
            $client = $this->findByKey("id", $clientId);

            if (!$client) {
                throw new Exception('Client introuvable.');
            }

            $encoursActuel = (float)$client['encoursTotal'];
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
                $stmtDette = $this->db->prepare("INSERT INTO dette (montantInitial, resteAPayer, estSoldee, client_id) VALUES (?, ?, FALSE, ?)");
                $stmtDette->execute([$resteAPayer, $resteAPayer, $clientId]);

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
}
