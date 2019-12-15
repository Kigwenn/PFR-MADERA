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
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adresse", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $adre_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Devis", mappedBy="devi_id")
     */
    private $devi_id;

    public function __construct()
    {
        $this->devi_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdreId(): ?Adresse
    {
        return $this->adre_id;
    }

    public function setAdreId(Adresse $adre_id): self
    {
        $this->adre_id = $adre_id;

        return $this;
    }

    /**
     * @return Collection|Devis[]
     */
    public function getDeviId(): Collection
    {
        return $this->devi_id;
    }

    public function addDeviId(Devis $deviId): self
    {
        if (!$this->devi_id->contains($deviId)) {
            $this->devi_id[] = $deviId;
            $deviId->setDeviId($this);
        }

        return $this;
    }

    public function removeDeviId(Devis $deviId): self
    {
        if ($this->devi_id->contains($deviId)) {
            $this->devi_id->removeElement($deviId);
            // set the owning side to null (unless already changed)
            if ($deviId->getDeviId() === $this) {
                $deviId->setDeviId(null);
            }
        }

        return $this;
    }

}
