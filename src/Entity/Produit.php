<?php

namespace StoreManagerPro\Src\Entity;

class Produit
{
    private ?int $id;
    private string $libelle;
    private float $prixUnitaire;
    private int $stockActuel;
    private int $seuilAlerteRupture;

    public function __construct(string $libelle, float $prixUnitaire, int $stockActuel, int $seuilAlerteRupture, ?int $id = null)
    {
        $this->libelle = $libelle;
        $this->prixUnitaire = $prixUnitaire;
        $this->stockActuel = $stockActuel;
        $this->seuilAlerteRupture = $seuilAlerteRupture;
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function getPrixUnitaire(): float
    {
        return $this->prixUnitaire;
    }

    public function getStockActuel(): int
    {
        return $this->stockActuel;
    }

    public function getSeuilAlerteRupture(): int
    {
        return $this->seuilAlerteRupture;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setLibelle(string $libelle): void
    {
        $this->libelle = $libelle;
    }

    public function setPrixUnitaire(float $prixUnitaire): void
    {
        $this->prixUnitaire = $prixUnitaire;
    }

    public function setStockActuel(int $stockActuel): void
    {
        $this->stockActuel = $stockActuel;
    }

    public function setSeuilAlerteRupture(int $seuilAlerteRupture): void
    {
        $this->seuilAlerteRupture = $seuilAlerteRupture;
    }
}
