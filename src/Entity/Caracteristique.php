<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CaracteristiqueRepository")
 */
class Caracteristique
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
    private $nomCaracteristique;

    /**
     * @ORM\Column(type="float")
     */
    private $largeurCaracteristique;

    /**
     * @ORM\Column(type="float")
     */
    private $hauteurCaracteristique;

    /**
     * @ORM\Column(type="float")
     */
    private $epaisseurCaracteristique;

    /**
     * @ORM\Column(type="float")
     */
    private $poidsCaracteristique;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Composant", mappedBy="caracteristiquesComposant")
     */
    private $composants;

    public function __construct()
    {
        $this->composants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCaracteristique(): ?string
    {
        return $this->nomCaracteristique;
    }

    public function setNomCaracteristique(string $nomCaracteristique): self
    {
        $this->nomCaracteristique = $nomCaracteristique;

        return $this;
    }

    public function getLargeurCaracteristique(): ?float
    {
        return $this->largeurCaracteristique;
    }

    public function setLargeurCaracteristique(float $largeurCaracteristique): self
    {
        $this->largeurCaracteristique = $largeurCaracteristique;

        return $this;
    }

    public function getHauteurCaracteristique(): ?float
    {
        return $this->hauteurCaracteristique;
    }

    public function setHauteurCaracteristique(float $hauteurCaracteristique): self
    {
        $this->hauteurCaracteristique = $hauteurCaracteristique;

        return $this;
    }

    public function getEpaisseurCaracteristique(): ?float
    {
        return $this->epaisseurCaracteristique;
    }

    public function setEpaisseurCaracteristique(float $epaisseurCaracteristique): self
    {
        $this->epaisseurCaracteristique = $epaisseurCaracteristique;

        return $this;
    }

    public function getPoidsCaracteristique(): ?float
    {
        return $this->poidsCaracteristique;
    }

    public function setPoidsCaracteristique(float $poidsCaracteristique): self
    {
        $this->poidsCaracteristique = $poidsCaracteristique;

        return $this;
    }

    /**
     * @return Collection|Composant[]
     */
    public function getComposants(): Collection
    {
        return $this->composants;
    }

    public function addComposant(Composant $composant): self
    {
        if (!$this->composants->contains($composant)) {
            $this->composants[] = $composant;
            $composant->addCaracteristiquesComposant($this);
        }

        return $this;
    }

    public function removeComposant(Composant $composant): self
    {
        if ($this->composants->contains($composant)) {
            $this->composants->removeElement($composant);
            $composant->removeCaracteristiquesComposant($this);
        }

        return $this;
    }
}
