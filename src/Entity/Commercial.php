<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommercialRepository")
 */
class Commercial extends Personne
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $comm_mdp;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Devis", mappedBy="comm_id")
     */
    private $listeDevis;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $comm_token;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $comm_token_date;

    public function __construct()
    {
        $this->listeDevis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommMdp(): ?string
    {
        return $this->comm_mdp;
    }

    public function setCommMdp(string $comm_mdp): self
    {
        $this->comm_mdp = $comm_mdp;

        return $this;
    }

    public function getCommToken(): ?string
    {
        return $this->comm_token;
    }

    public function setCommToken(?string $comm_token): self
    {
        $this->comm_token = $comm_token;

        return $this;
    }

    public function getCommTokenDate(): ?\DateTimeInterface
    {
        return $this->comm_token_date;
    }

    public function setCommTokenDate(?\DateTimeInterface $comm_token_date): self
    {
        $this->comm_token_date = $comm_token_date;

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
            $listeDevi->setCommId($this);
        }

        return $this;
    }

    public function removeListeDevi(Devis $listeDevi): self
    {
        if ($this->listeDevis->contains($listeDevi)) {
            $this->listeDevis->removeElement($listeDevi);
            // set the owning side to null (unless already changed)
            if ($listeDevi->getCommId() === $this) {
                $listeDevi->setCommId(null);
            }
        }

        return $this;
    }

    
}
