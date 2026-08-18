<?php

namespace StoreManagerPro\Src\Entity;

class Vente
{
    private int $id;
    private string $dateVente;
    private float $montantTotal;
    private float $montantEncaisse;
    private string $typePaiement;
    private string $statutPaiement;
    private ?Utilisateur $utilisateur;
    private ?Client $client;

    public function __construct(string $dateVente, float $montantTotal, float $montantEncaisse, string $typePaiement, string $statutPaiement, ?Utilisateur $utilisateur = null, ?Client $client = null)
    {
        $this->dateVente = $dateVente;
        $this->montantTotal = $montantTotal;
        $this->montantEncaisse = $montantEncaisse;
        $this->typePaiement = $typePaiement;
        $this->statutPaiement = $statutPaiement;
        $this->utilisateur = $utilisateur;
        $this->client = $client;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateVente(): string
    {
        return $this->dateVente;
    }

    public function getMontantTotal(): float
    {
        return $this->montantTotal;
    }

    public function getMontantEncaisse(): float
    {
        return $this->montantEncaisse;
    }

    public function getTypePaiement(): string
    {
        return $this->typePaiement;
    }

    public function getStatutPaiement(): string
    {
        return $this->statutPaiement;
    }

    public function getUtilisateur(): ?int
    {
        return $this->utilisateur;
    }

    public function getClient(): ?int
    {
        return $this->client;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setDateVente(string $dateVente): void
    {
        $this->dateVente = $dateVente;
    }

    public function setMontantTotal(float $montantTotal): void
    {
        $this->montantTotal = $montantTotal;
    }

    public function setMontantEncaisse(float $montantEncaisse): void
    {
        $this->montantEncaisse = $montantEncaisse;
    }

    public function setTypePaiement(string $typePaiement): void
    {
        $this->typePaiement = $typePaiement;
    }

    public function setStatutPaiement(string $statutPaiement): void
    {
        $this->statutPaiement = $statutPaiement;
    }

    public function setUtilisateur(Utilisateur $utilisateur): void
    {
        $this->utilisateur = $utilisateur;
    }

    public function setClient(Client $client): void
    {
        $this->client = $client;
    }
}
