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
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adresse")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
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

    public function getId(): ?int
    {
        return $this->id;
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
