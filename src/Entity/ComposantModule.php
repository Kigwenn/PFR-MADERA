<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComposantModuleRepository")
 */
class ComposantModule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $como_quantite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Module")
     * @ORM\JoinColumn(nullable=false)
     */
    private $modu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\composant")
     * @ORM\JoinColumn(nullable=false)
     */
    private $comp;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Module", inversedBy="composantModules")
     */
    // private $modu;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Composant", inversedBy="composantModules")
     */
    // private $comp;

    public function __construct()
    {
        // $this->modu = new ArrayCollection();
        // $this->comp = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComoQuantite(): ?int
    {
        return $this->como_quantite;
    }

    public function setComoQuantite(int $como_quantite): self
    {
        $this->como_quantite = $como_quantite;

        return $this;
    }

    public function getModu(): ?Module
    {
        return $this->modu;
    }

    public function setModu(?Module $modu): self
    {
        $this->modu = $modu;

        return $this;
    }

    public function getComp(): ?composant
    {
        return $this->comp;
    }

    public function setComp(?composant $comp): self
    {
        $this->comp = $comp;

        return $this;
    }

    /**
     * @return Collection|Module[]
     */
    // public function getModu(): Collection
    // {
    //     return $this->modu;
    // }

    // public function addModu(Module $modu): self
    // {
    //     if (!$this->modu->contains($modu)) {
    //         $this->modu[] = $modu;
    //     }

    //     return $this;
    // }

    // public function removeModu(Module $modu): self
    // {
    //     if ($this->modu->contains($modu)) {
    //         $this->modu->removeElement($modu);
    //     }

    //     return $this;
    // }

    /**
     * @return Collection|Composant[]
     */
    // public function getComp(): Collection
    // {
    //     return $this->comp;
    // }

    // public function addComp(Composant $comp): self
    // {
    //     if (!$this->comp->contains($comp)) {
    //         $this->comp[] = $comp;
    //     }

    //     return $this;
    // }

    // public function removeComp(Composant $comp): self
    // {
    //     if ($this->comp->contains($comp)) {
    //         $this->comp->removeElement($comp);
    //     }

    //     return $this;
    // }

    
}
