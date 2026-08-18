<?php

namespace StoreManagerPro\Src\Entity;

class Utilisateur
{
    private int $id;
    private string $nom;
    private string $email;
    private string $motDePasse;
    private ?Role $role;

    public function __construct()
    {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMotDePasse(): string
    {
        return $this->motDePasse;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setMotDePasse(string $motDePasse): void
    {
        $this->motDePasse = $motDePasse;
    }

    public function setRole(Role $role): void
    {
        $this->role = $role;
    }
}
