<?php

namespace StoreManagerPro\Src\Entity;

class Approvisionnement
{
    private ?int $id;
    private string $dateApprovisionnement;
    private float $coutTotal;
    private string $referenceBon;
    private ?Utilisateur $utilisateur;
    private ?Fournisseur $fournisseur;

    public function __construct(string $dateApprovisionnement, float $coutTotal, string $referenceBon, ?Utilisateur $utilisateur = null, ?Fournisseur $fournisseur = null, ?int $id = null)
    {
        $this->dateApprovisionnement = $dateApprovisionnement;
        $this->coutTotal = $coutTotal;
        $this->referenceBon = $referenceBon;
        $this->utilisateur = $utilisateur;
        $this->fournisseur = $fournisseur;
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

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
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

    public function setUtilisateur(Utilisateur $utilisateur): void
    {
        $this->utilisateur = $utilisateur;
    }

    public function setFournisseur(Fournisseur $fournisseur): void
    {
        $this->fournisseur = $fournisseur;
    }
}