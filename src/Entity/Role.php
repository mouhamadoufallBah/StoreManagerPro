<?php

namespace StoreManagerPro\Src\Entity;

class Role
{
    private ?int $id;
    private string $libelle;

    public function __construct(string $libelle, ?int $id = null)
    {
        $this->libelle = $libelle;
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

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setLibelle(string $libelle): void
    {
        $this->libelle = $libelle;
    }
}
