<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComposantRepository")
 */
class Composant
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
    private $nomComposant;

    /**
     * @ORM\Column(type="float")
     */
    private $prixComposant;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $typeComposant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomComposant(): ?string
    {
        return $this->nomComposant;
    }

    public function setNomComposant(string $nomComposant): self
    {
        $this->nomComposant = $nomComposant;

        return $this;
    }

    public function getPrixComposant(): ?float
    {
        return $this->prixComposant;
    }

    public function setPrixComposant(float $prixComposant): self
    {
        $this->prixComposant = $prixComposant;

        return $this;
    }

    public function getTypeComposant(): ?string
    {
        return $this->typeComposant;
    }

    public function setTypeComposant(string $typeComposant): self
    {
        $this->typeComposant = $typeComposant;

        return $this;
    }
}
