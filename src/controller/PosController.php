<?php

namespace StoreManagerPro\Src\controller;

use StoreManagerPro\Src\Core\View;
use StoreManagerPro\Src\Repository\ClientRepository;
use StoreManagerPro\Src\Repository\ProduitRepository;
use StoreManagerPro\Src\Repository\VenteRepository;
use StoreManagerPro\Src\Service\VenteService;

class PosController
{

    public function index()
    {
        $clientRepo = new ClientRepository();
        $produitRepo = new ProduitRepository();
        $venteRepo = new VenteRepository();
        $venteService = new VenteService($venteRepo);

        $clients = $clientRepo->findAllClient();
        $produits = $produitRepo->findAllProduits();
        $cart = $venteService->getCart();
        $ventes = $venteRepo->findAllVenteAndLigne();
        // var_dump($ventes);die;
        $data = [
            "produits" => $produits,
            "clients" => $clients,
            "cart" => $cart,
            "ventes" => $ventes
        ];
        View::render("pos/index", $data);
    }

    public function addToCart()
    {
        $venteRepo = new VenteRepository();
        $venteService = new VenteService($venteRepo);

        $produit = explode("-", $_POST["produit"]);
       
        $data = [
            "produit" => [
                "id" => (int)$produit[0],
                "libelle" => $produit[1],
                "stockActuel" => (int)$produit[2],
                "prixUnitaire" => (int)$produit[3]
            ],
            "qte" => $_POST["qte"]
        ];

        $venteService->addToCart($data);
        header("Location: /pos");
        exit;
    }


    public function removeToCart()
    {
        $venteRepo = new VenteRepository();
        $venteService = new VenteService($venteRepo);

        $venteService->removeToCart((int)$_GET["id"]);
        header("Location: /pos");
        exit;
    }


    public function addVente()
    {
        $clientId = (int)$_POST['client_id'] ?? null;
        $modeReglement = $_POST['mode_reglement'] ?? null;
        $montantVerse = (float)$_POST['montant_verse'] ?? 0;

        $venteRepo = new VenteRepository();
        $venteService = new VenteService($venteRepo);
        $venteService->enregistrerVente(1, $clientId, $montantVerse, $modeReglement);

        header('Location: /pos');
        exit;
    }
}
