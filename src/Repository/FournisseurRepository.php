<?php

namespace StoreManagerPro\Src\Repository;

use StoreManagerPro\Src\Entity\Fournisseur;

class FournisseurRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('fournisseur');
    }

    public function findAllFournisseurs(): array
    {
        $results = $this->findAll();

        $fournisseurs = [];
        foreach ($results as $fournisseur) {
            $fournisseurs[] = new Fournisseur(
                $fournisseur["nom"],
                $fournisseur["telephone"],
                $fournisseur["adresse"],
                (float)$fournisseur["soldeCompte"],
                (int)$fournisseur["id"]
            );
        }
        return $fournisseurs;
    }

    public function insert(Fournisseur $fournisseur): bool
    {
        $data = [
            'nom' => $fournisseur->getNom(),
            'telephone' => $fournisseur->getTelephone(),
            'soldeCompte' => $fournisseur->getSoldeCompte()
        ];

        return $this->save($data);
    }
}
