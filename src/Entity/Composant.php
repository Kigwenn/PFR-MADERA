<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private $comp_nom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $comp_type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Fournisseur", inversedBy="composants")
     */
    // private $fournisseurs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Stock", inversedBy="composants")
     */
    private $composantsStock;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FamilleComposant", inversedBy="composant")
     */
    private $fami;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $comp_prix_unitaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ComposantModule")
     */
    // private $modules;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ComposantModule", mappedBy="comp")
     */
    // private $composantModules;

    public function __construct()
    {
        // $this->fournisseurs = new ArrayCollection();
        $this->composantsStock = new ArrayCollection();
        $this->caracteristiquesComposant = new ArrayCollection();
        // $this->composantModules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompNom(): ?string
    {
        return $this->comp_nom;
    }

    public function setCompNom(string $comp_nom): self
    {
        $this->comp_nom = $comp_nom;

        return $this;
    }

    public function getCompType(): ?string
    {
        return $this->comp_type;
    }

    public function setCompType(string $comp_type): self
    {
        $this->comp_type = $comp_type;

        return $this;
    }

    public function getCompPrixUnitaire(): ?string
    {
        return $this->comp_prix_unitaire;
    }

    public function setCompPrixUnitaire(string $comp_prix_unitaire): self
    {
        $this->comp_prix_unitaire = $comp_prix_unitaire;

        return $this;
    }

    /**
     * @return Collection|Stock[]
     */
    public function getComposantsStock(): Collection
    {
        return $this->composantsStock;
    }

    public function addComposantsStock(Stock $composantsStock): self
    {
        if (!$this->composantsStock->contains($composantsStock)) {
            $this->composantsStock[] = $composantsStock;
        }

        return $this;
    }

    public function removeComposantsStock(Stock $composantsStock): self
    {
        if ($this->composantsStock->contains($composantsStock)) {
            $this->composantsStock->removeElement($composantsStock);
        }

        return $this;
    }

    public function getFami(): ?FamilleComposant
    {
        return $this->fami;
    }

    public function setFami(?FamilleComposant $fami): self
    {
        $this->fami = $fami;

        return $this;
    }   
}
