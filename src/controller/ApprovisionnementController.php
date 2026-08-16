<?php

namespace StoreManagerPro\Src\controller;

use StoreManagerPro\Src\Core\View;
use StoreManagerPro\Src\Repository\ApprovisionnementRepository;
use StoreManagerPro\Src\Service\ApprovisionnemntService;

class ApprovisionnementController
{
    private ApprovisionnemntService $approvisionnementService;

    public function __construct()
    {
        $approvisionnementRepository = new ApprovisionnementRepository();
        $this->approvisionnementService = new ApprovisionnemntService($approvisionnementRepository);
    }

    public function index()
    {
        $approvisionnements = $this->approvisionnementService->getApprovisionnementsWithDetails();

        View::render('approvisionnement/index', [
            'approvisionnements' => $approvisionnements
        ]);
    }

    public function reception()
    {
        // var_dump($_POST);die;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $approvisionnementId = isset($_POST['approvisionnement_id']) ? (int)$_POST['approvisionnement_id'] : 0;
            $quantitesLivrees = isset($_POST['quantites_livrees']) ? $_POST['quantites_livrees'] : [];

            if ($approvisionnementId > 0 && !empty($quantitesLivrees)) {
                $this->approvisionnementService->receptionnerApprovisionnement($approvisionnementId, $quantitesLivrees);
            }

            header('Location: /approvisionnement');
            exit();
        }
    }
}
