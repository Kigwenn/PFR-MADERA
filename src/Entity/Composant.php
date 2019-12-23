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
     * @ORM\Column(type="float")
     */
    private $comp_prix;

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
     * @ORM\ManyToMany(targetEntity="App\Entity\Caracteristique", inversedBy="composants")
     */
    private $caracteristiquesComposant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FamilleComposant", inversedBy="composant")
     */
    private $fami;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $comp_unite_usage;

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

    public function getCompPrix(): ?float
    {
        return $this->comp_prix;
    }

    public function setCompPrix(float $comp_prix): self
    {
        $this->comp_prix = $comp_prix;

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

    public function getCompUniteUsage(): ?string
    {
        return $this->comp_unite_usage;
    }

    public function setCompUniteUsage(string $comp_unite_usage): self
    {
        $this->comp_unite_usage = $comp_unite_usage;

        return $this;
    }

    /**
     * @return Collection|Fournisseur[]
     */
    // public function getFournisseurs(): Collection
    // {
    //     return $this->fournisseurs;
    // }

    // public function addFournisseur(Fournisseur $fournisseur): self
    // {
    //     if (!$this->fournisseurs->contains($fournisseur)) {
    //         $this->fournisseurs[] = $fournisseur;
    //     }

    //     return $this;
    // }

    // public function removeFournisseur(Fournisseur $fournisseur): self
    // {
    //     if ($this->fournisseurs->contains($fournisseur)) {
    //         $this->fournisseurs->removeElement($fournisseur);
    //     }

    //     return $this;
    // }

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

    public function getFami(): ?FamilleComposant
    {
        return $this->fami;
    }

    public function setFami(?FamilleComposant $fami): self
    {
        $this->fami = $fami;

        return $this;
    }

    // public function getModules(): ?ComposantModule
    // {
    //     return $this->modules;
    // }

    // public function setModules(?ComposantModule $modules): self
    // {
    //     $this->modules = $modules;

    //     return $this;
    // }

    /**
     * @return Collection|ComposantModule[]
     */
    // public function getComposantModules(): Collection
    // {
    //     return $this->composantModules;
    // }

    // public function addComposantModule(ComposantModule $composantModule): self
    // {
    //     if (!$this->composantModules->contains($composantModule)) {
    //         $this->composantModules[] = $composantModule;
    //         $composantModule->addComp($this);
    //     }

    //     return $this;
    // }

    // public function removeComposantModule(ComposantModule $composantModule): self
    // {
    //     if ($this->composantModules->contains($composantModule)) {
    //         $this->composantModules->removeElement($composantModule);
    //         $composantModule->removeComp($this);
    //     }

    //     return $this;
    // }

    
}
