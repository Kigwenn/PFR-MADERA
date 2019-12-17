<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FinitionExterieurRepository")
 */
class FinitionExterieur
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
    private $fiex_nom;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $fiex_description;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $fiex_prix_unitaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFiexNom(): ?string
    {
        return $this->fiex_nom;
    }

    public function setFiexNom(string $fiex_nom): self
    {
        $this->fiex_nom = $fiex_nom;

        return $this;
    }

    public function getFiexDescription(): ?string
    {
        return $this->fiex_description;
    }

    public function setFiexDescription(string $fiex_description): self
    {
        $this->fiex_description = $fiex_description;

        return $this;
    }

    public function getFiexPrixUnitaire(): ?string
    {
        return $this->fiex_prix_unitaire;
    }

    public function setFiexPrixUnitaire(string $fiex_prix_unitaire): self
    {
        $this->fiex_prix_unitaire = $fiex_prix_unitaire;

        return $this;
    }

    

}
