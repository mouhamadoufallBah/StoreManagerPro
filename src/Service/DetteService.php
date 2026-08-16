<?php

namespace StoreManagerPro\Src\Service;

use StoreManagerPro\Src\Repository\DetteRepository;
use Exception;

class DetteService
{
    private DetteRepository $detteRepository;

    public function __construct(DetteRepository $detteRepository)
    {
        $this->detteRepository = $detteRepository;
    }

    public function listerDettesAvecDetails(): array
    {
        return [
            'dettes' => $this->detteRepository->findAllDetteWithDetail(),
            'stats' => $this->detteRepository->getStats()
        ];
    }

    public function effectuerPaiement(int $detteId, float $montantPaye, string $methodePaiement): void
    {
        if ($montantPaye <= 0) {
            throw new Exception("Le montant du paiement doit être supérieur à zéro.");
        }

        $dette = $this->detteRepository->findByKey("id", $detteId, "dette", true);

        if (!$dette) {
            throw new Exception("Dette introuvable.");
        }

        if ((bool)$dette['estSoldee']) {
            throw new Exception("Cette dette est déjà entièrement soldée.");
        }

        $resteAPayerActuel = (float)$dette['resteapayer'];

        if ($montantPaye > $resteAPayerActuel) {
            throw new Exception("Le montant payé ({$montantPaye}) est supérieur au reste à payer ({$resteAPayerActuel}).");
        }

        $this->detteRepository->savePaiementDette($detteId, $montantPaye, $methodePaiement, (int)$dette['venteid']);
    }
}
