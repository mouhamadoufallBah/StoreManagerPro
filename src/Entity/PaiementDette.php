<?php

namespace StoreManagerPro\Src\Entity;

class PaiementDette
{
    private int $id;
    private float $montantPaye;
    private string $datePaiement;
    private string $methodePaiement;
    private ?Dette $dette;

    public function __construct(float $montantPaye, string $datePaiement, string $methodePaiement, ?Dette $dette = null)
    {
        $this->montantPaye = $montantPaye;
        $this->datePaiement = $datePaiement;
        $this->methodePaiement = $methodePaiement;
        $this->dette = $dette;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantPaye(): float
    {
        return $this->montantPaye;
    }

    public function getDatePaiement(): string
    {
        return $this->datePaiement;
    }

    public function getMethodePaiement(): string
    {
        return $this->methodePaiement;
    }

    public function getDette(): ?Dette
    {
        return $this->dette;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setMontantPaye(float $montantPaye): void
    {
        $this->montantPaye = $montantPaye;
    }

    public function setDatePaiement(string $datePaiement): void
    {
        $this->datePaiement = $datePaiement;
    }

    public function setMethodePaiement(string $methodePaiement): void
    {
        $this->methodePaiement = $methodePaiement;
    }

    public function setDette(Dette $dette): void
    {
        $this->dette = $dette;
    }
}
