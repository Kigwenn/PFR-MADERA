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
     * @ORM\ManyToOne(targetEntity="App\Entity\Gamme", inversedBy="modules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gamm;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $devi;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CCTP")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cctp;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ComposantModule")
     */
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
    private $finex;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FinitionInterieur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $finin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Couverture")
     * @ORM\JoinColumn(nullable=false)
     */
    private $couv;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ComposantModule", mappedBy="modu")
     */
    // private $composantModules;

    public function __construct()
    {
        // $this->composantModules = new ArrayCollection();
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

    public function getDevi(): ?int
    {
        return $this->devi;
    }

    public function setDevi(?int $devi): self
    {
        $this->devi = $devi;

        return $this;
    }

    public function getGamm(): ?Gamme
    {
        return $this->gamm;
    }

    public function setGamm(?Gamme $gamm): self
    {
        $this->gamm = $gamm;

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

    // public function getComposants(): ?ComposantModule
    // {
    //     return $this->composants;
    // }

    // public function setComposants(?ComposantModule $composants): self
    // {
    //     $this->composants = $composants;

    //     return $this;
    // }

    public function getRemp(): ?Remplissage
    {
        return $this->remp;
    }

    public function setRemp(?Remplissage $remp): self
    {
        $this->remp = $remp;

        return $this;
    }

    public function getFinex(): ?FinitionExterieur
    {
        return $this->finex;
    }

    public function setFinex(?FinitionExterieur $finex): self
    {
        $this->finex = $finex;

        return $this;
    }

    public function getFinin(): ?FinitionInterieur
    {
        return $this->finin;
    }

    public function setFinin(?FinitionInterieur $finin): self
    {
        $this->finin = $finin;

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
    //         $composantModule->addModu($this);
    //     }

    //     return $this;
    // }

    // public function removeComposantModule(ComposantModule $composantModule): self
    // {
    //     if ($this->composantModules->contains($composantModule)) {
    //         $this->composantModules->removeElement($composantModule);
    //         $composantModule->removeModu($this);
    //     }

    //     return $this;
    // }



}
