<?php

namespace StoreManagerPro\Src\Entity;

class Vente
{
    private ?int $id;
    private string $dateVente;
    private float $montantTotal;
    private float $montantEncaisse;
    private string $typePaiement;
    private string $statutPaiement;
    private ?int $utilisateurId;
    private ?int $clientId;

    public function __construct(string $dateVente, float $montantTotal, float $montantEncaisse, string $typePaiement, string $statutPaiement, ?int $utilisateurId = null, ?int $clientId = null, ?int $id = null)
    {
        $this->dateVente = $dateVente;
        $this->montantTotal = $montantTotal;
        $this->montantEncaisse = $montantEncaisse;
        $this->typePaiement = $typePaiement;
        $this->statutPaiement = $statutPaiement;
        $this->utilisateurId = $utilisateurId;
        $this->clientId = $clientId;
        $this->id = $id;
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

    public function getUtilisateurId(): ?int
    {
        return $this->utilisateurId;
    }

    public function getClientId(): ?int
    {
        return $this->clientId;
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

    public function setUtilisateurId(?int $utilisateurId): void
    {
        $this->utilisateurId = $utilisateurId;
    }

    public function setClientId(?int $clientId): void
    {
        $this->clientId = $clientId;
    }
}
