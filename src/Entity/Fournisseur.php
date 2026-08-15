<?php

namespace StoreManagerPro\Src\Entity;

class Fournisseur
{
    private ?int $id;
    private string $nom;
    private string $telephone;
    private float $soldeCompte;

    public function __construct(string $nom, string $telephone, float $soldeCompte = 0.0, ?int $id = null)
    {
        $this->nom = $nom;
        $this->telephone = $telephone;
        $this->soldeCompte = $soldeCompte;
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function getSoldeCompte(): float
    {
        return $this->soldeCompte;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }

    public function setSoldeCompte(float $soldeCompte): void
    {
        $this->soldeCompte = $soldeCompte;
    }
}