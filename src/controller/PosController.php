<?php

namespace StoreManagerPro\Src\controller;

use StoreManagerPro\Src\Core\View;
use StoreManagerPro\Src\Entity\Client;
use StoreManagerPro\Src\Entity\Utilisateur;
use StoreManagerPro\Src\Entity\Vente;
use StoreManagerPro\Src\Repository\VenteRepository;
use StoreManagerPro\Src\Service\VenteService;

class PosController
{
    // private VenteService $venteService;

    public function __construct()
    {
        // $venteRepository = new VenteRepository();
        // $this->venteService = new VenteService($venteRepository);
    }

    public function index()
    {
        $data = VenteService::getDataForPosPage();
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

        VenteService::addToCart($data);
        header("Location: /pos");
        exit;
    }

    public function removeToCart()
    {
        VenteService::removeToCart((int)$_GET["id"]);
        header("Location: /pos");
        exit;
    }

    public function addVente()
    {
        $data = VenteService::getCart();
        $panier = $data['panier'];
        $montantTotal = $data['montantTotal'];

        $clientId = (int)($_POST['client_id'] ?? 0);
        $modeReglement = $_POST['mode_reglement'] ?? '';
        $montantVerse = (float)($_POST['montant_verse'] ?? 0);

        $utilisateur = new Utilisateur();
        $utilisateur->setId(1);
        $client = new Client();
        $client->setId(1);

        $vente = new Vente($montantTotal, $montantVerse, $modeReglement, $utilisateur, $client);

        VenteService::enregistrerVente($vente);
        // VenteService::enregistrerVente(1, $clientId, $montantVerse, $modeReglement);

        header('Location: /pos');
        exit;
    }
}