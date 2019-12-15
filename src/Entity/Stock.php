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
    private $comp_id;

    public function __construct()
    {
        $this->comp_id = new ArrayCollection();
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
    public function getCompId(): Collection
    {
        return $this->comp_id;
    }

    public function addCompId(Composant $compId): self
    {
        if (!$this->comp_id->contains($compId)) {
            $this->comp_id[] = $compId;
            $compId->addComposantsStock($this);
        }

        return $this;
    }

    public function removeCompId(Composant $compId): self
    {
        if ($this->comp_id->contains($compId)) {
            $this->comp_id->removeElement($compId);
            $compId->removeComposantsStock($this);
        }

        return $this;
    }

    
}
