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
     * @ORM\ManyToMany(targetEntity="App\Entity\Maison", mappedBy="moduleMaison")
     */
    private $maisons;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Composant", inversedBy="modules")
     */
    private $composantModule;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Gamme", inversedBy="modules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gammeModule;

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

    /**
     * @return Collection|Maison[]
     */
    public function getMaisons(): Collection
    {
        return $this->maisons;
    }

    public function addMaison(Maison $maison): self
    {
        if (!$this->maisons->contains($maison)) {
            $this->maisons[] = $maison;
            $maison->addModuleMaison($this);
        }

        return $this;
    }

    public function removeMaison(Maison $maison): self
    {
        if ($this->maisons->contains($maison)) {
            $this->maisons->removeElement($maison);
            $maison->removeModuleMaison($this);
        }

        return $this;
    }

    /**
     * @return Collection|Composant[]
     */
    public function getComposantModule(): Collection
    {
        return $this->composantModule;
    }

    public function addComposantModule(Composant $composantModule): self
    {
        if (!$this->composantModule->contains($composantModule)) {
            $this->composantModule[] = $composantModule;
        }

        return $this;
    }

    public function removeComposantModule(Composant $composantModule): self
    {
        if ($this->composantModule->contains($composantModule)) {
            $this->composantModule->removeElement($composantModule);
        }

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
}
