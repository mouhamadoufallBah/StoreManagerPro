<?php

namespace StoreManagerPro\Src\Service;

use StoreManagerPro\Src\Core\SessionManager;
use StoreManagerPro\Src\Repository\VenteRepository;
use StoreManagerPro\Src\Repository\ClientRepository;
use StoreManagerPro\Src\Repository\ProduitRepository;
use Exception;
use StoreManagerPro\Src\Entity\Vente;

class VenteService
{
    private const PANIER = "panier";

    public function __construct()
    {
        if (!SessionManager::hasKey(self::PANIER)) {
            SessionManager::saveData(self::PANIER, []);
        }
    }

    public static function getDataForPosPage(): array
    {
        return [
            "produits" => ProduitRepository::findAllProduits(),
            "clients" => ClientRepository::findAllClient(),
            "cart" => self::getCart(),
            "ventes" => VenteRepository::findAllVenteAndLigne(),
            "stats" => VenteRepository::getStats(),
        ];
    }

    public static function addToCart(array $data): void
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

    public static function getCart(): array
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

    public static function removeToCart(int $produit_id): void
    {
        $panier = SessionManager::getData(self::PANIER) ?? [];

        if (isset($panier[$produit_id])) {
            unset($panier[$produit_id]);
            SessionManager::saveData(self::PANIER, $panier);
        }
    }

    public static function viderCart(): void
    {
        SessionManager::saveData(self::PANIER, []);
    }

    // public static function enregistrerVente(int $userId, int $clientId, float $montantEncaisse, string $typePaiement): ?int
    public static function enregistrerVente(Vente $vente): ?int
    {
        
        if (empty($panier)) {
            SessionManager::saveData('error_message', "Impossible de valider une vente avec un panier vide.");
            return null;
        }

        if ($vente->getMontantEncaisse() < 0) {
            SessionManager::saveData('error_message', "Le montant encaissé ne peut pas être négatif.");
            return null;
        }

        try {
            $venteId = VenteRepository::saveVente(
                $vente->getUtilisateur()->getId(),
                $vente->getClient()->getId(),
                $vente->getMontantTotal(),
                $vente->getMontantEncaisse(),
                $vente->getTypePaiement(),
                $panier
            );

            self::viderCart();
            SessionManager::saveData('success_message', "Vente validée avec succès !");

            return $venteId;
        } catch (Exception $e) {
            SessionManager::saveData('error_message', "Erreur lors de la validation de la vente : " . $e->getMessage());
            return null;
        }
    }
}
