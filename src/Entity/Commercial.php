<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommercialRepository")
 */
class Commercial
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $motDePasse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Devis", mappedBy="idCommercial")
     */
    private $listeDevis;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $token;

    /**
     * @ORM\Column(type="datetime")
     */
    private $tokenDate;

    public function __construct()
    {
        $this->listeDevis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    /**
     * @return Collection|Devis[]
     */
    public function getListeDevis(): Collection
    {
        return $this->listeDevis;
    }

    public function addListeDevi(Devis $listeDevi): self
    {
        if (!$this->listeDevis->contains($listeDevi)) {
            $this->listeDevis[] = $listeDevi;
            $listeDevi->setIdCommercial($this);
        }

        return $this;
    }

    public function removeListeDevi(Devis $listeDevi): self
    {
        if ($this->listeDevis->contains($listeDevi)) {
            $this->listeDevis->removeElement($listeDevi);
            // set the owning side to null (unless already changed)
            if ($listeDevi->getIdCommercial() === $this) {
                $listeDevi->setIdCommercial(null);
            }
        }

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getTokenDate(): ?\DateTimeInterface
    {
        return $this->tokenDate;
    }

    public function setTokenDate(\DateTimeInterface $tokenDate): self
    {
        $this->tokenDate = $tokenDate;

        return $this;
    }
}
