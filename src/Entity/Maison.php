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
    private $nomMaison;

    /**
     * @ORM\Column(type="float")
     */
    private $prixMaison;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPieces;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbChambres;

    /**
     * @ORM\Column(type="text")
     */
    private $descMaison;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Devis", mappedBy="devisMaison")
     */
    private $devis;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Catalogue", inversedBy="maisons")
     */
    private $catalogueMaison;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DocMaison", mappedBy="maison")
     */
    private $docMaison;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $coupePrincipe;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $catalogue;

    public function __construct()
    {
        $this->devis = new ArrayCollection();
        $this->catalogueMaison = new ArrayCollection();
        $this->moduleMaison = new ArrayCollection();
        $this->docMaison = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMaison(): ?string
    {
        return $this->nomMaison;
    }

    public function setNomMaison(string $nomMaison): self
    {
        $this->nomMaison = $nomMaison;

        return $this;
    }

    public function getPrixMaison(): ?float
    {
        return $this->prixMaison;
    }

    public function setPrixMaison(float $prixMaison): self
    {
        $this->prixMaison = $prixMaison;

        return $this;
    }

    public function getNbPieces(): ?int
    {
        return $this->nbPieces;
    }

    public function setNbPieces(int $nbPieces): self
    {
        $this->nbPieces = $nbPieces;

        return $this;
    }

    public function getNbChambres(): ?int
    {
        return $this->nbChambres;
    }

    public function setNbChambres(int $nbChambres): self
    {
        $this->nbChambres = $nbChambres;

        return $this;
    }

    public function getDescMaison(): ?string
    {
        return $this->descMaison;
    }

    public function setDescMaison(string $descMaison): self
    {
        $this->descMaison = $descMaison;

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

    /**
     * @return Collection|Catalogue[]
     */
    public function getCatalogueMaison(): Collection
    {
        return $this->catalogueMaison;
    }

    public function addCatalogueMaison(Catalogue $catalogueMaison): self
    {
        if (!$this->catalogueMaison->contains($catalogueMaison)) {
            $this->catalogueMaison[] = $catalogueMaison;
        }

        return $this;
    }

    public function removeCatalogueMaison(Catalogue $catalogueMaison): self
    {
        if ($this->catalogueMaison->contains($catalogueMaison)) {
            $this->catalogueMaison->removeElement($catalogueMaison);
        }

        return $this;
    }

    /**
     * @return Collection|DocMaison[]
     */
    public function getDocMaison(): Collection
    {
        return $this->docMaison;
    }

    public function addDocMaison(DocMaison $docMaison): self
    {
        if (!$this->docMaison->contains($docMaison)) {
            $this->docMaison[] = $docMaison;
            $docMaison->setMaison($this);
        }

        return $this;
    }

    public function removeDocMaison(DocMaison $docMaison): self
    {
        if ($this->docMaison->contains($docMaison)) {
            $this->docMaison->removeElement($docMaison);
            // set the owning side to null (unless already changed)
            if ($docMaison->getMaison() === $this) {
                $docMaison->setMaison(null);
            }
        }

        return $this;
    }

    public function getCoupePrincipe()
    {
        return $this->coupePrincipe;
    }

    public function setCoupePrincipe($coupePrincipe): self
    {
        $this->coupePrincipe = $coupePrincipe;

        return $this;
    }

    public function getCatalogue()
    {
        return $this->catalogue;
    }

    public function setCatalogue($catalogue): self
    {
        $this->catalogue = $catalogue;

        return $this;
    }
}
