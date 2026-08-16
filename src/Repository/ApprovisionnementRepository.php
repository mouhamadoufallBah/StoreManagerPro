<?php

namespace StoreManagerPro\Src\Repository;
use PDO;

class ApprovisionnementRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct("approvisionnement");
    }

    public function findAllApproWithDetail(): array
    {
        $sql = "select 
                    a.id as appro_id, 
                    a.dateApprovisionnement, 
                    a.couttotal, 
                    case when la.quantitecommandee >= la.quantiterecu then 'RECU' else 'EN COURS' end as statut,
                    f.id as fournisseur_id, 
                    f.nom as fournisseur_nom, 
                    f.telephone as fournisseur_telephone, 
                    la.quantitecommandee, 
                    la.quantiterecu, 
                    la.prixachatunitaire, 
                    p.id as produit_id, 
                    p.libelle as produit_libelle
                from approvisionnement a 
                inner join fournisseur f on f.id = a.fournisseur_id
                left join ligneapprovisionnement la on la.approvisionnement_id = a.id   
                left join produit p on p.id = la.produit_id";

        $stmt = $this->db->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $approvisionnements = [];

        foreach ($results as $r) {
            $approId = $r['appro_id'];

            if (!isset($approvisionnements[$approId])) {
                $approvisionnements[$approId] = [
                    'id' => $approId,
                    'dateApprovisionnement' => $r['dateApprovisionnement'] ?? null,
                    'coutTotal' => $r['couttotal'] ?? 0,
                    'statut' => $r['statut'],
                    'fournisseur' => [
                        'id' => $r['fournisseur_id'],
                        'nom' => $r['fournisseur_nom'],
                        'telephone' => $r['fournisseur_telephone']
                    ],
                    'produits' => []
                ];
            }

            if (!empty($r['produit_id'])) {
                $produitKey = $r['produit_id'];
                if (!isset($approvisionnements[$approId]['produits'][$produitKey])) {
                    $approvisionnements[$approId]['produits'][$produitKey] = [
                        'produit_id' => $r['produit_id'],
                        'libelle' => $r['produit_libelle'],
                        'quantiteCommandee' => $r['quantitecommandee'] ?? 0,
                        'quantiteRecu' => $r['quantiterecu'] ?? 0,
                        'prixAchatUnitaire' => $r['prixachatunitaire'] ?? 0
                    ];
                }
            }
        }

        // echo "<pre>";
        // var_dump($approvisionnements);
        // echo "</pre>";
        // die;


        return $approvisionnements;
    }

    public function saveReception(int $approvisionnementId, array $quantitesRecues): bool
    {
        try {
            $this->db->beginTransaction();

            $sqlLine = "UPDATE ligneapprovisionnement 
                        SET quantiterecu = :quantiteRecu 
                        WHERE approvisionnement_id = :approId AND produit_id = :produitId";
            
            $stmtLine = $this->db->prepare($sqlLine);

            $sqlStock = "UPDATE produit 
                         SET stockactuel = stockactuel + :quantiteRecu 
                         WHERE id = :produitId";

            $stmtStock = $this->db->prepare($sqlStock);

            foreach ($quantitesRecues as $produitId => $quantiteRecu) {
                $stmtLine->execute([
                    'quantiteRecu' => $quantiteRecu,
                    'approId' => $approvisionnementId,
                    'produitId' => $produitId
                ]);

                $stmtStock->execute([
                    'quantiteRecu' => $quantiteRecu,
                    'produitId' => $produitId
                ]);
            }

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
