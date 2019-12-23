<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModuleRepository")
 */
class Module
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
    private $modu_nom;

    /**
     * @ORM\Column(type="float")
     */
    private $modu_prix_unitaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Devis")
     * @ORM\JoinColumn(nullable=true)
     */
    private $devi;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CCTP")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cctp;

    // /**
    //  * @ORM\ManyToOne(targetEntity="App\Entity\ComposantModule")
    //  */
    // private $composants;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Remplissage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $remp;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FinitionExterieur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fiex;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FinitionInterieur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fiin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Couverture")
     * @ORM\JoinColumn(nullable=false)
     */
    private $couv;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Caracteristique", inversedBy="modules")
     */
     private $caracteristiquesModule;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Composant", inversedBy="modules")
     */
    private $composantsModule;

    public function __construct()
    {
        $this->composantModules = new ArrayCollection();
        $this->caracteristiquesModule = new ArrayCollection();
        $this->composantsModule = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModuNom(): ?string
    {
        return $this->modu_nom;
    }

    public function setModuNom(string $modu_nom): self
    {
        $this->modu_nom = $modu_nom;

        return $this;
    }

    public function getModuPrixUnitaire(): ?float
    {
        return $this->modu_prix_unitaire;
    }

    public function setModuPrixUnitaire(float $modu_prix_unitaire): self
    {
        $this->modu_prix_unitaire = $modu_prix_unitaire;

        return $this;
    }

    public function getDevi(): ?Devis
    {
        return $this->devi;
    }

    public function setDevi(?Devis $devi): self
    {
        $this->devi = $devi;

        return $this;
    }

    public function getCctp(): ?CCTP
    {
        return $this->cctp;
    }

    public function setCctp(?CCTP $cctp): self
    {
        $this->cctp = $cctp;

        return $this;
    }

    public function getRemp(): ?Remplissage
    {
        return $this->remp;
    }

    public function setRemp(?Remplissage $remp): self
    {
        $this->remp = $remp;

        return $this;
    }

    public function getFiex(): ?FinitionExterieur
    {
        return $this->fiex;
    }

    public function setFiex(?FinitionExterieur $fiex): self
    {
        $this->fiex = $fiex;

        return $this;
    }

    public function getFiin(): ?FinitionInterieur
    {
        return $this->fiin;
    }

    public function setFiin(?FinitionInterieur $fiin): self
    {
        $this->fiin = $fiin;

        return $this;
    }

    public function getCouv(): ?Couverture
    {
        return $this->couv;
    }

    public function setCouv(?Couverture $couv): self
    {
        $this->couv = $couv;

        return $this;
    }

    /**
     * @return Collection|Caracteristique[]
     */
    public function getCaracteristiquesModule(): Collection
    {
        return $this->caracteristiquesModule;
    }

    public function addCaracteristiquesModule(Caracteristique $caracteristiquesModule): self
    {
        if (!$this->caracteristiquesModule->contains($caracteristiquesModule)) {
            $this->caracteristiquesModule[] = $caracteristiquesModule;
        }

        return $this;
    }

    public function removeCaracteristiquesModule(Caracteristique $caracteristiquesModule): self
    {
        if ($this->caracteristiquesModule->contains($caracteristiquesModule)) {
            $this->caracteristiquesModule->removeElement($caracteristiquesModule);
        }

        return $this;
    }

    /**
     * @return Collection|Composant[]
     */
    public function getComposantsModule(): Collection
    {
        return $this->composantsModule;
    }

    public function addComposantsModule(Composant $composantsModule): self
    {
        if (!$this->composantsModule->contains($composantsModule)) {
            $this->composantsModule[] = $composantsModule;
        }

        return $this;
    }

    public function removeComposantsModule(Composant $composantsModule): self
    {
        if ($this->composantsModule->contains($composantsModule)) {
            $this->composantsModule->removeElement($composantsModule);
        }

        return $this;
    }



   
}
