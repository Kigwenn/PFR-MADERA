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
    private $modu_id;

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

    public function getModuId(): ?int
    {
        return $this->modu_id;
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

}
