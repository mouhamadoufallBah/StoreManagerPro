<?php

namespace StoreManagerPro\Src\Entity;

class Client
{
    private ?int $id;
    private string $nom;
    private string $telephone;
    private string $adresse;
    private float $encoursTotal;
    private float $limiteCredit;

    public function __construct(string $nom, string $telephone, string $adresse, float $encoursTotal = 0.0, float $limiteCredit = 0.0, ?int $id = null)
    {
        $this->nom = $nom;
        $this->telephone = $telephone;
        $this->adresse = $adresse;
        $this->encoursTotal = $encoursTotal;
        $this->limiteCredit = $limiteCredit;
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

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function getEncoursTotal(): float
    {
        return $this->encoursTotal;
    }

    public function getLimiteCredit(): float
    {
        return $this->limiteCredit;
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

    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }

    public function setEncoursTotal(float $encoursTotal): void
    {
        $this->encoursTotal = $encoursTotal;
    }

    public function setLimiteCredit(float $limiteCredit): void
    {
        $this->limiteCredit = $limiteCredit;
    }

    public function getClientInfo(): string
    {
        return "{$this->nom}   ({$this->telephone})";
    }
}
