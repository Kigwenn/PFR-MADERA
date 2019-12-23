<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RemplissageRepository")
 */
class Remplissage
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
    private $remp_nom;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $remp_description;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $remp_prix_unitaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRempNom(): ?string
    {
        return $this->remp_nom;
    }

    public function setRempNom(string $remp_nom): self
    {
        $this->remp_nom = $remp_nom;

        return $this;
    }

    public function getRempDescription(): ?string
    {
        return $this->remp_description;
    }

    public function setRempDescription(string $remp_description): self
    {
        $this->remp_description = $remp_description;

        return $this;
    }

    public function getRempPrixUnitaire(): ?string
    {
        return $this->remp_prix_unitaire;
    }

    public function setRempPrixUnitaire(string $remp_prix_unitaire): self
    {
        $this->remp_prix_unitaire = $remp_prix_unitaire;

        return $this;
    }
}
