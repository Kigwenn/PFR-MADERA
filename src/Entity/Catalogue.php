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
    private $cata_nom;

    /**
     * @ORM\Column(type="text")
     */
    private $cata_description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Maison", mappedBy="mais_id")
     */
    private $mais_id;

    public function __construct()
    {
        $this->mais_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCataNom(): ?string
    {
        return $this->cata_nom;
    }

    public function setCataNom(string $cata_nom): self
    {
        $this->cata_nom = $cata_nom;

        return $this;
    }

    public function getCataDescription(): ?string
    {
        return $this->cata_description;
    }

    public function setCataDescription(string $cata_description): self
    {
        $this->cata_description = $cata_description;

        return $this;
    }

    /**
     * @return Collection|Maison[]
     */
    public function getMaisId(): Collection
    {
        return $this->mais_id;
    }

    public function addMaisId(Maison $maisId): self
    {
        if (!$this->mais_id->contains($maisId)) {
            $this->mais_id[] = $maisId;
            $maisId->addMaisId($this);
        }

        return $this;
    }

    public function removeMaisId(Maison $maisId): self
    {
        if ($this->mais_id->contains($maisId)) {
            $this->mais_id->removeElement($maisId);
            $maisId->removeMaisId($this);
        }

        return $this;
    }

   
}
