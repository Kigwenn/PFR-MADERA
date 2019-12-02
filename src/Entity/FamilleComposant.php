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
    private $nom;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $description;

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
