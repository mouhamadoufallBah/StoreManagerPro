<?php

namespace StoreManagerPro\Src\Repository;

use StoreManagerPro\Src\Entity\Produit;

class ProduitRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("produit");
    }

    public function findAllProduits(): array
    {
        $results = $this->findAll();

        $produits = [];
        foreach ($results as $p) {
            $produits[] = new Produit(
                $p["libelle"],
                (float)$p["prixUnitaire"],
                (int)$p["stockActuel"],
                (int)$p["seuilAlerteRupture"],
                (int)$p["id"]
            );
        }
        return $produits;
    }

    public function findProduitByLibelle(string $libelle): array
    {
        $results = $this->findByKey('libelle', $libelle);

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

    public function insert(Produit $produit): bool
    {
        $data = [
            'libelle' => $produit->getLibelle(),
            'prixUnitaire' => $produit->getPrixUnitaire(),
            'stockActuel' => $produit->getStockActuel(),
            'seuilAlerteRupture' => $produit->getSeuilAlerteRupture()
        ];

        return $this->save($data);
    }
}
