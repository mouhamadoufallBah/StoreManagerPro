<?php

namespace StoreManagerPro\Src\Service;

use StoreManagerPro\Src\Entity\Produit;
use StoreManagerPro\Src\Repository\ClientRepository;
use StoreManagerPro\Src\Repository\FournisseurRepository;
use StoreManagerPro\Src\Repository\ProduitRepository;
use StoreManagerPro\Src\Repository\TierRepository;

class TiersService
{
    private FournisseurRepository $fournisseurRepository;
    private ProduitRepository $produitRepository;
    private ClientRepository $clientRepository;
    private TierRepository $tierRepository;

    public function __construct()
    {
        $this->fournisseurRepository = new FournisseurRepository();
        $this->clientRepository = new ClientRepository();
        $this->produitRepository = new ProduitRepository();
        $this->produitRepository = new ProduitRepository();
        $this->tierRepository = new TierRepository();
    }

    public function getAllDataForTierPage(): array
    {
        $data["produits"] = $this->produitRepository->findAllProduits();
        $data["fournisseurs"] = $this->fournisseurRepository->findAllFournisseurs();
        $data["clients"] = $this->clientRepository->findAllClient();
        $data["stats"] = $this->tierRepository->getStats();

        return $data;
    }

    public function enregistreProduit(array $data): bool
    {
        return $this->produitRepository->save($data);
    }

    public function enregistreClient(array $data): bool
    {
        $data['encourstotal'] = $data['encourstotal'] ?? 0;
        $data['limitecredit'] = $data['limitecredit'] ?? 0;

        return $this->clientRepository->save($data);
    }

    public function enregistreFournisseur(array $data): bool
    {
        $data['soldecompte'] = $data['soldecompte'] ?? 0;

        return $this->fournisseurRepository->save($data);
    }
    
}
