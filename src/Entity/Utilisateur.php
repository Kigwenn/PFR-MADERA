<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur
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
    private $nomUtilisateur;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenomUtilisateur;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $mailUtilisateur;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $telUtilisateur;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $mdpUtilisateur;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adresse", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $adresseUtilisateur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Devis", mappedBy="utilisateurDevis")
     */
    private $devis;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeUtilisateur", inversedBy="utilisateurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeUtilisateur;

    public function __construct()
    {
        $this->typeUtilisateur = new ArrayCollection();
        $this->devis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nomUtilisateur;
    }

    public function setNomUtilisateur(string $nomUtilisateur): self
    {
        $this->nomUtilisateur = $nomUtilisateur;

        return $this;
    }

    public function getPrenomUtilisateur(): ?string
    {
        return $this->prenomUtilisateur;
    }

    public function setPrenomUtilisateur(string $prenomUtilisateur): self
    {
        $this->prenomUtilisateur = $prenomUtilisateur;

        return $this;
    }

    public function getMailUtilisateur(): ?string
    {
        return $this->mailUtilisateur;
    }

    public function setMailUtilisateur(string $mailUtilisateur): self
    {
        $this->mailUtilisateur = $mailUtilisateur;

        return $this;
    }

    public function getTelUtilisateur(): ?string
    {
        return $this->telUtilisateur;
    }

    public function setTelUtilisateur(string $telUtilisateur): self
    {
        $this->telUtilisateur = $telUtilisateur;

        return $this;
    }

    public function getMdpUtilisateur(): ?string
    {
        return $this->mdpUtilisateur;
    }

    public function setMdpUtilisateur(string $mdpUtilisateur): self
    {
        $this->mdpUtilisateur = $mdpUtilisateur;

        return $this;
    }

    public function getAdresseUtilisateur(): ?Adresse
    {
        return $this->adresseUtilisateur;
    }

    public function setAdresseUtilisateur(Adresse $adresseUtilisateur): self
    {
        $this->adresseUtilisateur = $adresseUtilisateur;

        return $this;
    }

    /**
     * @return Collection|Devis[]
     */
    public function getDevis(): Collection
    {
        return $this->devis;
    }

    public function addDevis(Devis $devis): self
    {
        if (!$this->devis->contains($devis)) {
            $this->devis[] = $devis;
            $devis->setUtilisateurDevis($this);
        }

        return $this;
    }

    public function removeDevis(Devis $devis): self
    {
        if ($this->devis->contains($devis)) {
            $this->devis->removeElement($devis);
            // set the owning side to null (unless already changed)
            if ($devis->getUtilisateurDevis() === $this) {
                $devis->setUtilisateurDevis(null);
            }
        }

        return $this;
    }

    public function getTypeUtilisateur(): ?TypeUtilisateur
    {
        return $this->typeUtilisateur;
    }

    public function setTypeUtilisateur(?TypeUtilisateur $typeUtilisateur): self
    {
        $this->typeUtilisateur = $typeUtilisateur;

        return $this;
    }
}
