<?php

namespace StoreManagerPro\Src\Repository;

class TierRepository extends BaseRepository
{
    public function getStats(): array
    {
        $sql = "
            WITH clients AS (
                SELECT COUNT(*) AS nombre_clients FROM client 
            ),
            produits AS (
                SELECT COUNT(*) AS nombre_produits FROM produit 
            ),
            valeur_stock AS (
                SELECT SUM(stockactuel * prixunitaire) AS valeur_stock FROM produit
            )
            SELECT * FROM clients, produits, valeur_stock
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result ? $result : [
            'nombre_clients' => 0,
            'nombre_produits' => 0,
            'valeur_stock' => 0
        ];
    }
}
