<?php

namespace StoreManagerPro\Src\controller;

use StoreManagerPro\Src\Core\View;
use StoreManagerPro\Src\Service\TiersService;

class TierController
{
    private TiersService $tierService;
    public function __construct()
    {
        $this->tierService = new TiersService();
    }

    public function index()
    {
        $data = $this->tierService->getAllDataForTierPage();
        // var_dump($data);die;
        View::render('tiers/index', $data);
    }

    public function onAddProduit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'libelle' => $_POST['libelle'] ?? '',
                'prixunitaire' => floatval($_POST['prix_unitaire'] ?? 0),
                'stockactuel' => intval($_POST['stock_actuel'] ?? 0),
                'seuilalerterupture' => intval($_POST['seuil_alerte_rupture'] ?? 0)
            ];

            $this->tierService->enregistreProduit($data);

            header("Location: http://localhost:8000/tiers");
            exit;
        }
    }

    public function onAddClient()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'] ?? '',
                'telephone' => $_POST['telephone'] ?? '',
                'adresse' => $_POST['adresse'] ?? '',
                'encourstotal' => 0,
                'limitecredit' => floatval($_POST['limite_credit'] ?? 0)
            ];

            $this->tierService->enregistreClient($data);

            header("Location: http://localhost:8000/tiers");
            exit;
        }
    }

    public function onAddFournisseur()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'] ?? '',
                'telephone' => $_POST['telephone'] ?? '',
                'adresse' => $_POST['adresse'] ?? '',
                'soldecompte' => 0
            ];

            $this->tierService->enregistreFournisseur($data);

            header("Location: http://localhost:8000/tiers");
            exit;
        }
    }
}
