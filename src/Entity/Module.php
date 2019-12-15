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
    private $gamm_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $devi_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CCTP")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cctp_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ComposantModule")
     */
    private $composants;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Remplissage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $remp_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FinitionExterieur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $finex_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FinitionInterieur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $finin_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Couverture")
     * @ORM\JoinColumn(nullable=false)
     */
    private $couv_id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ComposantModule", mappedBy="modu_id")
     */
    private $composantModules;

    public function __construct()
    {
        $this->composantModules = new ArrayCollection();
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

    public function getDeviId(): ?int
    {
        return $this->devi_id;
    }

    public function setDeviId(?int $devi_id): self
    {
        $this->devi_id = $devi_id;

        return $this;
    }

    public function getGammId(): ?Gamme
    {
        return $this->gamm_id;
    }

    public function setGammId(?Gamme $gamm_id): self
    {
        $this->gamm_id = $gamm_id;

        return $this;
    }

    public function getCctpId(): ?CCTP
    {
        return $this->cctp_id;
    }

    public function setCctpId(?CCTP $cctp_id): self
    {
        $this->cctp_id = $cctp_id;

        return $this;
    }

    public function getComposants(): ?ComposantModule
    {
        return $this->composants;
    }

    public function setComposants(?ComposantModule $composants): self
    {
        $this->composants = $composants;

        return $this;
    }

    public function getRempId(): ?Remplissage
    {
        return $this->remp_id;
    }

    public function setRempId(?Remplissage $remp_id): self
    {
        $this->remp_id = $remp_id;

        return $this;
    }

    public function getFinexId(): ?FinitionExterieur
    {
        return $this->finex_id;
    }

    public function setFinexId(?FinitionExterieur $finex_id): self
    {
        $this->finex_id = $finex_id;

        return $this;
    }

    public function getFininId(): ?FinitionInterieur
    {
        return $this->finin_id;
    }

    public function setFininId(?FinitionInterieur $finin_id): self
    {
        $this->finin_id = $finin_id;

        return $this;
    }

    public function getCouvId(): ?Couverture
    {
        return $this->couv_id;
    }

    public function setCouvId(?Couverture $couv_id): self
    {
        $this->couv_id = $couv_id;

        return $this;
    }

    /**
     * @return Collection|ComposantModule[]
     */
    public function getComposantModules(): Collection
    {
        return $this->composantModules;
    }

    public function addComposantModule(ComposantModule $composantModule): self
    {
        if (!$this->composantModules->contains($composantModule)) {
            $this->composantModules[] = $composantModule;
            $composantModule->addModuId($this);
        }

        return $this;
    }

    public function removeComposantModule(ComposantModule $composantModule): self
    {
        if ($this->composantModules->contains($composantModule)) {
            $this->composantModules->removeElement($composantModule);
            $composantModule->removeModuId($this);
        }

        return $this;
    }

}
