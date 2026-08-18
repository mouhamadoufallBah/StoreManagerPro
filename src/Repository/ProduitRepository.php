<?php

namespace StoreManagerPro\Src\Repository;

use StoreManagerPro\Src\Core\Database;
use StoreManagerPro\Src\Entity\Produit;

class ProduitRepository
{

    public static function findAllProduits(): array
    {
        $results = Database::getAllData("produit");

        // echo "<pre>";
        // var_dump($results);
        // echo "</pre>";
        // die;


        $produits = [];
        foreach ($results as $produit) {
            $produits[] = new Produit(
                $produit["libelle"],
                (float)$produit["prixunitaire"],
                (int)$produit["stockactuel"],
                (int)$produit["seuilalerterupture"],
                (int)$produit["id"]
            );
        }
        return $produits;
    }

    public static function findProduitByLibelle(string $libelle): array
    {
        $sql = "select * from produit where libelle = :libelle";

        $results = Database::executeQuery($sql, [
            "libelle" => $libelle
        ]);

        $produits = [];
        foreach ($results as $produit) {
            $produits[] = new Produit(
                $produit["libelle"],
                (float)$produit["prixUnitaire"],
                (int)$produit["stockActuel"],
                (int)$produit["seuilAlerteRupture"],
                (int)$produit["id"]
            );
        }
        return $produits;
    }

    public static function insert(Produit $produit): bool
    {
        $data = [
            'libelle' => $produit->getLibelle(),
            'prixUnitaire' => $produit->getPrixUnitaire(),
            'stockActuel' => $produit->getStockActuel(),
            'seuilAlerteRupture' => $produit->getSeuilAlerteRupture()
        ];

        $sql = "INSERT INTO produit (libelle, prixUnitaire, stockActuel, seuilAlerteRupture) VALUES (:libelle, :prixUnitaire, :stockActuel, :seuilAlerteRupture)";
        $latId = Database::executeUpdate($sql, $data);

        return $latId;
    }
}
