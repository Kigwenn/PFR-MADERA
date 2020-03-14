<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaisonRepository")
 */
class Maison
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
    private $mais_nom;

    /**
     * @ORM\Column(type="float")
     */
    private $mais_prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $mais_piece;

    /**
     * @ORM\Column(type="integer")
     */
    private $mais_chambre;

    /**
     * @ORM\Column(type="text")
     */
    private $mais_description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Devis", mappedBy="devisMaison")
     */
    private $devis;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $mais_catalogue;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $mais_cdp;

    public function __construct()
    {
        $this->devis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaisNom(): ?string
    {
        return $this->mais_nom;
    }

    public function setMaisNom(string $mais_nom): self
    {
        $this->mais_nom = $mais_nom;

        return $this;
    }

    public function getMaisPrix(): ?float
    {
        return $this->mais_prix;
    }

    public function setMaisPrix(float $mais_prix): self
    {
        $this->mais_prix = $mais_prix;

        return $this;
    }

    public function getMaisPiece(): ?int
    {
        return $this->mais_piece;
    }

    public function setMaisPiece(int $mais_piece): self
    {
        $this->mais_piece = $mais_piece;

        return $this;
    }

    public function getMaisChambre(): ?int
    {
        return $this->mais_chambre;
    }

    public function setMaisChambre(int $mais_chambre): self
    {
        $this->mais_chambre = $mais_chambre;

        return $this;
    }

    public function getMaisDescription(): ?string
    {
        return $this->mais_description;
    }

    public function setMaisDescription(string $mais_description): self
    {
        $this->mais_description = $mais_description;

        return $this;
    }

    public function getMaisCatalogue()
    {
        return $this->mais_catalogue;
    }

    public function setMaisCatalogue($mais_catalogue): self
    {
        $this->mais_catalogue = $mais_catalogue;

        return $this;
    }


    /**
     * @return Collection|Devis[]
     */
    public function getDevis(): Collection
    {
        return $this->devis;
    }

    public function addDevi(Devis $devi): self
    {
        if (!$this->devis->contains($devi)) {
            $this->devis[] = $devi;
            $devi->setDevisMaison($this);
        }

        return $this;
    }

    public function removeDevi(Devis $devi): self
    {
        if ($this->devis->contains($devi)) {
            $this->devis->removeElement($devi);
            // set the owning side to null (unless already changed)
            if ($devi->getDevisMaison() === $this) {
                $devi->setDevisMaison(null);
            }
        }

        return $this;
    }

    public function getMaisCdp(): ?string
    {
        return $this->mais_cdp;
    }

    public function setMaisCdp(?string $mais_cdp): self
    {
        $this->mais_cdp = $mais_cdp;

        return $this;
    }

    
}
