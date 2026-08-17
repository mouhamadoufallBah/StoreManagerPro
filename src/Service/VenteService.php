<?php

namespace StoreManagerPro\Src\Service;

use StoreManagerPro\Src\Core\SessionManager;
use StoreManagerPro\Src\Repository\VenteRepository;
use StoreManagerPro\Src\Repository\ClientRepository;
use StoreManagerPro\Src\Repository\ProduitRepository;
use Exception;

class VenteService
{
    private const PANIER = "panier";
    // private SessionManager $session;
    private VenteRepository $venteRepository;

    public function __construct(VenteRepository $venteRepository)
    {
        $this->venteRepository = $venteRepository;
        // $this->session = SessionManager::getInstance();

        if (!SessionManager::hasKey(self::PANIER)) {
            SessionManager::saveData(self::PANIER, []);
        }
    }

    public function getDataForPosPage(): array
    {
        $clientRepo = new ClientRepository();
        $produitRepo = new ProduitRepository();

        return [
            "produits" => $produitRepo->findAllProduits(),
            "clients" => $clientRepo->findAllClient(),
            "cart" => $this->getCart(),
            "ventes" => $this->venteRepository->findAllVenteAndLigne(),
            "stats" => $this->venteRepository->getStats(),
        ];
    }

    public function addToCart(array $data): void
    {
        $key = $data['produit']['id'];
        $panier = SessionManager::getData(self::PANIER);

        $stockActuel = $data['produit']['stockActuel'];
        $quantiteActuelPanier = isset($panier[$key]) ? $panier[$key]['qte'] : 0;
        $quantiteTotalPanier = $quantiteActuelPanier + $data['qte'];

        if ($stockActuel >= $quantiteTotalPanier) {
            if (isset($panier[$key])) {
                $panier[$key]['qte'] += $data['qte'];
            } else {
                $panier[$key] = $data;
            }

            SessionManager::saveData(self::PANIER, $panier);
        } else {
            SessionManager::saveData('error_message', "Quantité insuffisante en stock ! (Stock dispo : $stockActuel)");
        }
    }

    public function getCart(): array
    {
        $panier = SessionManager::getData(self::PANIER) ?? [];
        $montantTotal = 0;

        foreach ($panier as $item) {
            $montantTotal += $item['qte'] * $item['produit']['prixUnitaire'];
        }

        return [
            "panier" => $panier,
            "montantTotal" => $montantTotal
        ];
    }

    public function removeToCart(int $produit_id): void
    {
        $panier = SessionManager::getData(self::PANIER) ?? [];

        if (isset($panier[$produit_id])) {
            unset($panier[$produit_id]);
            SessionManager::saveData(self::PANIER, $panier);
        }
    }

    public function viderCart(): void
    {
        SessionManager::saveData(self::PANIER, []);
    }

    public function enregistrerVente(int $userId, int $clientId, float $montantEncaisse, string $typePaiement): ?int
    {
        $data = $this->getCart();
        $panier = $data['panier'];
        $montantTotal = $data['montantTotal'];


        if (empty($panier)) {
            SessionManager::saveData('error_message', "Impossible de valider une vente avec un panier vide.");
            return null;
        }

        if ($montantEncaisse < 0) {
            SessionManager::saveData('error_message', "Le montant encaissé ne peut pas être négatif.");
            return null;
        }

        try {
            $venteId = $this->venteRepository->saveVente(
                $userId,
                $clientId,
                $montantTotal,
                $montantEncaisse,
                $typePaiement,
                $panier
            );

            $this->viderCart();
            SessionManager::saveData('success_message', "Vente validée avec succès !");

            return $venteId;
        } catch (Exception $e) {
            SessionManager::saveData('error_message', "Erreur lors de la validation de la vente : " . $e->getMessage());
            return null;
        }
    }
}
