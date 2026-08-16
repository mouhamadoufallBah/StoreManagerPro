<?php

namespace StoreManagerPro\Src\Service;

use StoreManagerPro\Src\Repository\ApprovisionnementRepository;

class ApprovisionnemntService {
    private ApprovisionnementRepository $approvisionnementRepository;

    public function __construct(ApprovisionnementRepository $approvisionnementRepository) {
        $this->approvisionnementRepository = $approvisionnementRepository;
    }

    public function getApprovisionnementsWithDetails(): array {
        return $this->approvisionnementRepository->findAllApproWithDetail();
    }

    public function receptionnerApprovisionnement(int $approvisionnementId, array $quantitesRecues): bool {
        return $this->approvisionnementRepository->saveReception($approvisionnementId, $quantitesRecues);
    }
}