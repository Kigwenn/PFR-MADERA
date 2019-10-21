<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Maison", mappedBy="catalogueMaison")
     */
    private $maisons;

    public function __construct()
    {
        $this->maisons = new ArrayCollection();
    }

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

    /**
     * @return Collection|Maison[]
     */
    public function getMaisons(): Collection
    {
        return $this->maisons;
    }

    public function addMaison(Maison $maison): self
    {
        if (!$this->maisons->contains($maison)) {
            $this->maisons[] = $maison;
            $maison->addCatalogueMaison($this);
        }

        return $this;
    }

    public function removeMaison(Maison $maison): self
    {
        if ($this->maisons->contains($maison)) {
            $this->maisons->removeElement($maison);
            $maison->removeCatalogueMaison($this);
        }

        return $this;
    }
}
