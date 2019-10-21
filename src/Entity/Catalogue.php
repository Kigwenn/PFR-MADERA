<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CatalogueRepository")
 */
class Catalogue
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
    private $nomCatalogue;

    /**
     * @ORM\Column(type="text")
     */
    private $descCatalogue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCatalogue(): ?string
    {
        return $this->nomCatalogue;
    }

    public function setNomCatalogue(string $nomCatalogue): self
    {
        $this->nomCatalogue = $nomCatalogue;

        return $this;
    }

    public function getDescCatalogue(): ?string
    {
        return $this->descCatalogue;
    }

    public function setDescCatalogue(string $descCatalogue): self
    {
        $this->descCatalogue = $descCatalogue;

        return $this;
    }
}
