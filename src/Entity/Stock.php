<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StockRepository")
 */
class Stock
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
    private $stoc_quantite;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Composant", mappedBy="composantsStock")
     */
    private $comp;

    public function __construct()
    {
        $this->comp = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStocQuantite(): ?int
    {
        return $this->stoc_quantite;
    }

    public function setStocQuantite(int $stoc_quantite): self
    {
        $this->stoc_quantite = $stoc_quantite;

        return $this;
    }

    /**
     * @return Collection|Composant[]
     */
    public function getComp(): Collection
    {
        return $this->comp;
    }

    public function addComp(Composant $comp): self
    {
        if (!$this->comp->contains($comp)) {
            $this->comp[] = $comp;
            $comp->addComposantsStock($this);
        }

        return $this;
    }

    public function removeComp(Composant $comp): self
    {
        if ($this->comp->contains($comp)) {
            $this->comp->removeElement($comp);
            $comp->removeComposantsStock($this);
        }

        return $this;
    }

   
}
