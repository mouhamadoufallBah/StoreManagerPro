<?php

namespace StoreManagerPro\Src\Entity;

class Dette
{
    private ?int $id;
    private float $montantInitial;
    private float $resteAPayer;
    private string $dateEcheance;
    private bool $estSoldee;
    private ?int $venteId;

    public function __construct(float $montantInitial, float $resteAPayer, string $dateEcheance, bool $estSoldee = false, ?int $venteId = null, ?int $id = null)
    {
        $this->montantInitial = $montantInitial;
        $this->resteAPayer = $resteAPayer;
        $this->dateEcheance = $dateEcheance;
        $this->estSoldee = $estSoldee;
        $this->venteId = $venteId;
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantInitial(): float
    {
        return $this->montantInitial;
    }

    public function getResteAPayer(): float
    {
        return $this->resteAPayer;
    }

    public function getDateEcheance(): string
    {
        return $this->dateEcheance;
    }

    public function isEstSoldee(): bool
    {
        return $this->estSoldee;
    }

    public function getVenteId(): ?int
    {
        return $this->venteId;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setMontantInitial(float $montantInitial): void
    {
        $this->montantInitial = $montantInitial;
    }

    public function setResteAPayer(float $resteAPayer): void
    {
        $this->resteAPayer = $resteAPayer;
    }

    public function setDateEcheance(string $dateEcheance): void
    {
        $this->dateEcheance = $dateEcheance;
    }

    public function setEstSoldee(bool $estSoldee): void
    {
        $this->estSoldee = $estSoldee;
    }

    public function setVenteId(?int $venteId): void
    {
        $this->venteId = $venteId;
    }
}
