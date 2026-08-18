<?php

namespace StoreManagerPro\Src\Entity;

class Dette
{
    private int $id;
    private float $montantInitial;
    private float $resteAPayer;
    private string $dateEcheance;
    private bool $estSoldee;
    private ?Vente $vente;

    public function __construct(float $montantInitial, float $resteAPayer, string $dateEcheance, bool $estSoldee = false, ?Vente $vente = null)
    {
        $this->montantInitial = $montantInitial;
        $this->resteAPayer = $resteAPayer;
        $this->dateEcheance = $dateEcheance;
        $this->estSoldee = $estSoldee;
        $this->vente = $vente;
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

    public function getVente(): ?Vente
    {
        return $this->vente;
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

    public function setVente(Vente $vente): void
    {
        $this->vente = $vente;
    }
}
