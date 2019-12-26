<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client extends Personne
{


    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adresse", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $adre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Devis", mappedBy="devi")
     */
    private $devi;

    public function __construct()
    {
        $this->devi = new ArrayCollection();
    }

    public function getAdre(): ?Adresse
    {
        return $this->adre;
    }

    public function setAdre(Adresse $adre): self
    {
        $this->adre = $adre;

        return $this;
    }

    /**
     * @return Collection|Devis[]
     */
    public function getDevi(): Collection
    {
        return $this->devi;
    }

    public function addDevi(Devis $devi): self
    {
        if (!$this->devi->contains($devi)) {
            $this->devi[] = $devi;
            $devi->setDevi($this);
        }

        return $this;
    }

    public function removeDevi(Devis $devi): self
    {
        if ($this->devi->contains($devi)) {
            $this->devi->removeElement($devi);
            // set the owning side to null (unless already changed)
            if ($devi->getDevi() === $this) {
                $devi->setDevi(null);
            }
        }

        return $this;
    }

   
    

}
