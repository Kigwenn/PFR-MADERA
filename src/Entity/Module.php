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
    private $nomModule;

    /**
     * @ORM\Column(type="float")
     */
    private $prixModule;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Gamme", inversedBy="modules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gammeModule;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idDevis;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CCTP")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCCTP;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ComposantModule")
     */
    private $composants;

    public function __construct()
    {
        $this->maisons = new ArrayCollection();
        $this->composantModule = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomModule(): ?string
    {
        return $this->nomModule;
    }

    public function setNomModule(string $nomModule): self
    {
        $this->nomModule = $nomModule;

        return $this;
    }

    public function getPrixModule(): ?float
    {
        return $this->prixModule;
    }

    public function setPrixModule(float $prixModule): self
    {
        $this->prixModule = $prixModule;

        return $this;
    }

    public function getGammeModule(): ?Gamme
    {
        return $this->gammeModule;
    }

    public function setGammeModule(?Gamme $gammeModule): self
    {
        $this->gammeModule = $gammeModule;

        return $this;
    }

    public function getIdDevis(): ?int
    {
        return $this->idDevis;
    }

    public function setIdDevis(?int $idDevis): self
    {
        $this->idDevis = $idDevis;

        return $this;
    }

    public function getIdCCTP(): ?CCTP
    {
        return $this->idCCTP;
    }

    public function setIdCCTP(?CCTP $idCCTP): self
    {
        $this->idCCTP = $idCCTP;

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
}
