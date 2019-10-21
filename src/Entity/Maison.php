<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaisonRepository")
 */
class Maison
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomMaison;

    /**
     * @ORM\Column(type="float")
     */
    private $prixMaison;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPieces;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbChambres;

    /**
     * @ORM\Column(type="text")
     */
    private $descMaison;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMaison(): ?string
    {
        return $this->nomMaison;
    }

    public function setNomMaison(string $nomMaison): self
    {
        $this->nomMaison = $nomMaison;

        return $this;
    }

    public function getPrixMaison(): ?float
    {
        return $this->prixMaison;
    }

    public function setPrixMaison(float $prixMaison): self
    {
        $this->prixMaison = $prixMaison;

        return $this;
    }

    public function getNbPieces(): ?int
    {
        return $this->nbPieces;
    }

    public function setNbPieces(int $nbPieces): self
    {
        $this->nbPieces = $nbPieces;

        return $this;
    }

    public function getNbChambres(): ?int
    {
        return $this->nbChambres;
    }

    public function setNbChambres(int $nbChambres): self
    {
        $this->nbChambres = $nbChambres;

        return $this;
    }

    public function getDescMaison(): ?string
    {
        return $this->descMaison;
    }

    public function setDescMaison(string $descMaison): self
    {
        $this->descMaison = $descMaison;

        return $this;
    }
}
