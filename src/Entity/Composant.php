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
    private $nomComposant;

    /**
     * @ORM\Column(type="float")
     */
    private $prixComposant;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $typeComposant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseur", inversedBy="composants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fournisseurComposant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Stock", inversedBy="composants")
     */
    private $composantsStock;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Caracteristique", inversedBy="composants")
     */
    private $caracteristiquesComposant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FamilleComposant", inversedBy="composant")
     */
    private $familleComposant;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $uniteUsage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ComposantModule")
     */
    private $modules;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
        $this->composantsCommande = new ArrayCollection();
        $this->composantsStock = new ArrayCollection();
        $this->caracteristiquesComposant = new ArrayCollection();
    }

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

    public function getFournisseurComposant(): ?Fournisseur
    {
        return $this->fournisseurComposant;
    }

    public function setFournisseurComposant(?Fournisseur $fournisseurComposant): self
    {
        $this->fournisseurComposant = $fournisseurComposant;

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

    /**
     * @return Collection|Caracteristique[]
     */
    public function getCaracteristiquesComposant(): Collection
    {
        return $this->caracteristiquesComposant;
    }

    public function addCaracteristiquesComposant(Caracteristique $caracteristiquesComposant): self
    {
        if (!$this->caracteristiquesComposant->contains($caracteristiquesComposant)) {
            $this->caracteristiquesComposant[] = $caracteristiquesComposant;
        }

        return $this;
    }

    public function removeCaracteristiquesComposant(Caracteristique $caracteristiquesComposant): self
    {
        if ($this->caracteristiquesComposant->contains($caracteristiquesComposant)) {
            $this->caracteristiquesComposant->removeElement($caracteristiquesComposant);
        }

        return $this;
    }

    public function getFamilleComposant(): ?FamilleComposant
    {
        return $this->familleComposant;
    }

    public function setFamilleComposant(?FamilleComposant $familleComposant): self
    {
        $this->familleComposant = $familleComposant;

        return $this;
    }

    public function getUniteUsage(): ?string
    {
        return $this->uniteUsage;
    }

    public function setUniteUsage(string $uniteUsage): self
    {
        $this->uniteUsage = $uniteUsage;

        return $this;
    }

    public function getModules(): ?ComposantModule
    {
        return $this->modules;
    }

    public function setModules(?ComposantModule $modules): self
    {
        $this->modules = $modules;

        return $this;
    }
}
