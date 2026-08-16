<?php

namespace StoreManagerPro\Src\controller;

use StoreManagerPro\Src\Core\View;
use StoreManagerPro\Src\Repository\VenteRepository;
use StoreManagerPro\Src\Service\VenteService;

class PosController
{
    private VenteService $venteService;

    public function __construct()
    {
        $venteRepository = new VenteRepository();
        $this->venteService = new VenteService($venteRepository);
    }

    public function index()
    {
        $data = $this->venteService->getDataForPosPage();
        View::render("pos/index", $data);
    }

    public function addToCart()
    {
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

        $this->venteService->addToCart($data);
        header("Location: /pos");
        exit;
    }

    public function removeToCart()
    {
        $this->venteService->removeToCart((int)$_GET["id"]);
        header("Location: /pos");
        exit;
    }

    public function addVente()
    {
        $clientId = (int)($_POST['client_id'] ?? 0);
        $modeReglement = $_POST['mode_reglement'] ?? '';
        $montantVerse = (float)($_POST['montant_verse'] ?? 0);

        $this->venteService->enregistrerVente(1, $clientId, $montantVerse, $modeReglement);

        header('Location: /pos');
        exit;
    }
}