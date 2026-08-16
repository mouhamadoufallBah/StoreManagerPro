<?php

namespace StoreManagerPro\Src\Repository;

class DetteRepository extends BaseRepository
{

    public function __construct()
    {
        return parent::__construct('dette');
    }

    public function findAllDetteWithDetail(): array
    {
        $sql = "SELECT d.*, v.client_id, c.nom, c.telephone, lv.id as ligneid,lv.produit_id,lv.quantite,
                lv.prixunitaire, p.libelle, pd.datepaiement, pd.id as paiement_id, pd.montantpaye,
                pd.methodepaiement
                FROM dette d
                inner join vente v on v.id = d.venteid
                inner join client c on c.id = v.client_id
                inner join lignevente lv on lv.vente_id = v.id
                inner join produit p on p.id = lv.produit_id
                LEFT JOIN paiementdette pd ON pd.dette_id = d.id";

        $stmt = $this->db->query($sql);
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $dettes = [];
        foreach ($results as $r) {
            $detteId = $r["id"];

            if (!isset($dettes[$detteId])) {
                $dettes[$detteId] = [
                    'id' => $detteId,
                    'montantInitial' => $r['montantinitial'],
                    'resteAPayer' => $r['resteapayer'],
                    'dateEcheance' => $r['dateecheance'],
                    'estSoldee' => $r['estsoldee'],
                    'client' => [
                        'id' => $r['client_id'],
                        'nom' => $r['nom'],
                        'telephone' => $r['telephone']
                    ],
                    'vente_id' => $r['venteid'],
                    'produits' => [],
                    'paiements' => []
                ];
            }

            $produitKey = $r['produit_id'];
            if (!isset($dettes[$detteId]['produits'][$produitKey])) {
                $dettes[$detteId]['produits'][$produitKey] = [
                    'libelle' => $r['libelle'],
                    'quantite' => $r['quantite'],
                    'prixUnitaire' => $r['prixunitaire']
                ];
            }

            if (!empty($r['paiement_id'])) {
                $paiementKey = $r['paiement_id'];
                if (!isset($dettes[$detteId]['paiements'][$paiementKey])) {
                    $dettes[$detteId]['paiements'][$paiementKey] = [
                        'id' => $r['paiement_id'],
                        'montantPaye' => $r['montantpaye'],
                        'datePaiement' => $r['datepaiement'],
                        'methodePaiement' => $r['methodepaiement']
                    ];
                }
            }
        }

        // echo "<pre>";
        // var_dump($dettes);
        // echo "</pre>";
        // die;


        return $dettes;
    }

    public function savePaiementDette(int $detteId, float $montantPaye, string $methodePaiement, int $venteId): void
    {
        try {
            $this->db->beginTransaction();

            $stmtPaiement = $this->db->prepare(
                "INSERT INTO paiementdette (montantpaye, datepaiement, methodepaiement, dette_id) VALUES (?, NOW(), ?, ?)"
            );
            $stmtPaiement->execute([$montantPaye, $methodePaiement, $detteId]);

            $stmtDette = $this->db->prepare("SELECT resteAPayer FROM dette WHERE id = ? FOR UPDATE");
            $stmtDette->execute([$detteId]);
            $detteData = $stmtDette->fetch(\PDO::FETCH_ASSOC);

            $nouveauResteAPayer = (float)$detteData['resteapayer'] - $montantPaye;

            $estSoldee = ($nouveauResteAPayer <= 0) ? 1 : 0;
            if ($nouveauResteAPayer < 0) {
                $nouveauResteAPayer = 0.00;
            }

            $stmtUpdateDette = $this->db->prepare(
                "UPDATE dette SET resteAPayer = ?, estSoldee = ? WHERE id = ?"
            );
            $stmtUpdateDette->execute([$nouveauResteAPayer, $estSoldee, $detteId]);

            $stmtClient = $this->db->prepare("SELECT client_id FROM vente WHERE id = ?");
            $stmtClient->execute([$venteId]);
            $venteData = $stmtClient->fetch(\PDO::FETCH_ASSOC);
            $clientId = $venteData['client_id'] ?? null;

            if ($clientId) {
                $stmtUpdateClient = $this->db->prepare(
                    "UPDATE client SET encourstotal = encourstotal - ? WHERE id = ?"
                );

                $stmtUpdateClient->execute([$montantPaye, $clientId]);
            }

            $this->db->commit();
        } catch (\Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function getStats(): array
    {
        $sql = "
            WITH creances AS (
                SELECT COALESCE(SUM(resteapayer), 0) AS creances_actives 
                FROM dette 
                WHERE estsoldee = FALSE
            ),
            clients_deb AS (
                SELECT COUNT(DISTINCT c.id) AS clients_debiteurs 
                FROM client c 
                WHERE c.encourstotal > 0
            ),
            recouvrements AS (
                SELECT COALESCE(SUM(montantpaye), 0) AS total_recouvrements 
                FROM paiementdette
            )
            SELECT * FROM creances, clients_deb, recouvrements;
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result ? $result : [
            'creances_actives' => 0,
            'clients_debiteurs' => 0,
            'total_recouvrements' => 0
        ];
    }
}
