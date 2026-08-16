<?php

namespace StoreManagerPro\Src\controller;

use StoreManagerPro\Src\Core\View;
use StoreManagerPro\Src\Repository\DetteRepository;
use StoreManagerPro\Src\Service\DetteService;
use Exception;

class DetteController
{
    private DetteService $detteService;

    public function __construct()
    {
        $detteRepository = new DetteRepository();
        $this->detteService = new DetteService($detteRepository);
    }

    public function index()
    {
        $dettes = $this->detteService->listerDettesAvecDetails();

        View::render('dette/index', [
            'dettes' => $dettes
        ]);
    }

    public function remboursement()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // var_dump($_POST);
            // die();
            $detteId = (int)($_POST['dette_id'] ?? 0);
            $montantPaye = (float)($_POST['montant_paye'] ?? 0);
            $methodePaiement = $_POST['methode_paiement'] ?? 'Espèces';

            $this->detteService->effectuerPaiement($detteId, $montantPaye, $methodePaiement);

            header('Location: /dette');
            exit;
        }

        header('Location: /dettes');
        exit;
    }
}
