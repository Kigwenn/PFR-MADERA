<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IsolantRepository")
 */
class Isolant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $isol_nom;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $isol_description;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $isol_prix_unitaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRempNom(): ?string
    {
        return $this->isol_nom;
    }

    public function setRempNom(string $isol_nom): self
    {
        $this->isol_nom = $isol_nom;

        return $this;
    }

    public function getRempDescription(): ?string
    {
        return $this->isol_description;
    }

    public function setRempDescription(string $isol_description): self
    {
        $this->isol_description = $isol_description;

        return $this;
    }

    public function getRempPrixUnitaire(): ?string
    {
        return $this->isol_prix_unitaire;
    }

    public function setRempPrixUnitaire(string $isol_prix_unitaire): self
    {
        $this->isol_prix_unitaire = $isol_prix_unitaire;

        return $this;
    }

    public function getIsolNom(): ?string
    {
        return $this->isol_nom;
    }

    public function setIsolNom(string $isol_nom): self
    {
        $this->isol_nom = $isol_nom;

        return $this;
    }

    public function getIsolDescription(): ?string
    {
        return $this->isol_description;
    }

    public function setIsolDescription(string $isol_description): self
    {
        $this->isol_description = $isol_description;

        return $this;
    }

    public function getIsolPrixUnitaire(): ?string
    {
        return $this->isol_prix_unitaire;
    }

    public function setIsolPrixUnitaire(string $isol_prix_unitaire): self
    {
        $this->isol_prix_unitaire = $isol_prix_unitaire;

        return $this;
    }
}
