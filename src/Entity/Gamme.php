<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GammeRepository")
 */
class Gamme
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
    private $gamm_nom;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Huisseries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $huis;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGammNom(): ?string
    {
        return $this->gamm_nom;
    }

    public function setGammNom(string $gamm_nom): self
    {
        $this->gamm_nom = $gamm_nom;

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

    public function getHuis(): ?Huisseries
    {
        return $this->huis;
    }

    public function setHuis(?Huisseries $huis): self
    {
        $this->huis = $huis;

        return $this;
    }


   
}
