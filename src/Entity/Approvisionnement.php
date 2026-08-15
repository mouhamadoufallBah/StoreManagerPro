<?php

namespace StoreManagerPro\Src\Entity;

class Approvisionnement
{
    private ?int $id;
    private string $dateApprovisionnement;
    private float $coutTotal;
    private string $referenceBon;
    private ?int $utilisateurId;
    private ?int $fournisseurId;

    public function __construct(string $dateApprovisionnement, float $coutTotal, string $referenceBon, ?int $utilisateurId = null, ?int $fournisseurId = null, ?int $id = null)
    {
        $this->dateApprovisionnement = $dateApprovisionnement;
        $this->coutTotal = $coutTotal;
        $this->referenceBon = $referenceBon;
        $this->utilisateurId = $utilisateurId;
        $this->fournisseurId = $fournisseurId;
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateApprovisionnement(): string
    {
        return $this->dateApprovisionnement;
    }

    public function getCoutTotal(): float
    {
        return $this->coutTotal;
    }

    public function getReferenceBon(): string
    {
        return $this->referenceBon;
    }

    public function getUtilisateurId(): ?int
    {
        return $this->utilisateurId;
    }

    public function getFournisseurId(): ?int
    {
        return $this->fournisseurId;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setDateApprovisionnement(string $dateApprovisionnement): void
    {
        $this->dateApprovisionnement = $dateApprovisionnement;
    }

    public function setCoutTotal(float $coutTotal): void
    {
        $this->coutTotal = $coutTotal;
    }

    public function setReferenceBon(string $referenceBon): void
    {
        $this->referenceBon = $referenceBon;
    }

    public function setUtilisateurId(?int $utilisateurId): void
    {
        $this->utilisateurId = $utilisateurId;
    }

    public function setFournisseurId(?int $fournisseurId): void
    {
        $this->fournisseurId = $fournisseurId;
    }
}