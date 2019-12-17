<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FinitionInterieurRepository")
 */
class FinitionInterieur
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
    private $fiin_nom;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $fiin_description;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $fiin_prix_unitaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFiinNom(): ?string
    {
        return $this->fiin_nom;
    }

    public function setFiinNom(string $fiin_nom): self
    {
        $this->fiin_nom = $fiin_nom;

        return $this;
    }

    public function getFiinDescription(): ?string
    {
        return $this->fiin_description;
    }

    public function setFiinDescription(string $fiin_description): self
    {
        $this->fiin_description = $fiin_description;

        return $this;
    }

    public function getFiinPrixUnitaire(): ?string
    {
        return $this->fiin_prix_unitaire;
    }

    public function setFiinPrixUnitaire(string $fiin_prix_unitaire): self
    {
        $this->fiin_prix_unitaire = $fiin_prix_unitaire;

        return $this;
    }

    
}
