<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FamilleComposantRepository")
 */
class FamilleComposant
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
    private $faco_nom;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $faco_description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Composant", mappedBy="familleComposant")
     */
    private $composant;

    public function __construct()
    {
        $this->composant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFacoNom(): ?string
    {
        return $this->faco_nom;
    }

    public function setFacoNom(string $faco_nom): self
    {
        $this->faco_nom = $faco_nom;

        return $this;
    }

    public function getFacoDescription(): ?string
    {
        return $this->faco_description;
    }

    public function setFacoDescription(string $faco_description): self
    {
        $this->faco_description = $faco_description;

        return $this;
    }

    /**
     * @return Collection|Composant[]
     */
    public function getComposant(): Collection
    {
        return $this->composant;
    }

    public function addComposant(Composant $composant): self
    {
        if (!$this->composant->contains($composant)) {
            $this->composant[] = $composant;
            $composant->setFamilleComposant($this);
        }

        return $this;
    }

    public function removeComposant(Composant $composant): self
    {
        if ($this->composant->contains($composant)) {
            $this->composant->removeElement($composant);
            // set the owning side to null (unless already changed)
            if ($composant->getFamilleComposant() === $this) {
                $composant->setFamilleComposant(null);
            }
        }

        return $this;
    }

}
