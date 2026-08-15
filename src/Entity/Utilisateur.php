<?php

namespace StoreManagerPro\Src\Entity;

class Utilisateur
{
    private ?int $id;
    private string $nom;
    private string $email;
    private string $motDePasse;
    private ?int $roleId;

    public function __construct(string $nom, string $email, string $motDePasse, ?int $roleId = null, ?int $id = null)
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->roleId = $roleId;
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMotDePasse(): string
    {
        return $this->motDePasse;
    }

    public function getRoleId(): ?int
    {
        return $this->roleId;
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

    public function setRoleId(?int $roleId): void
    {
        $this->roleId = $roleId;
    }
}
