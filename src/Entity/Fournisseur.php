<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FournisseurRepository")
 */
class Fournisseur
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
    private $nomFournisseur;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $mailFournisseur;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $telFournisseur;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nomContactFournisseur;

    /**
     * @ORM\Column(type="string", length=14)
     */
    private $siret;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Composant", mappedBy="fournisseurComposant")
     */
    private $composants;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Adresse", mappedBy="fournisseur")
     */
    private $adressesFournisseur;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ContactFournisseur", mappedBy="idFournisseur", cascade={"persist", "remove"})
     */
    private $contactFournisseur;

    public function __construct()
    {
        $this->composants = new ArrayCollection();
        $this->adressesFournisseur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFournisseur(): ?string
    {
        return $this->nomFournisseur;
    }

    public function setNomFournisseur(string $nomFournisseur): self
    {
        $this->nomFournisseur = $nomFournisseur;

        return $this;
    }

    public function getMailFournisseur(): ?string
    {
        return $this->mailFournisseur;
    }

    public function setMailFournisseur(string $mailFournisseur): self
    {
        $this->mailFournisseur = $mailFournisseur;

        return $this;
    }

    public function getTelFournisseur(): ?string
    {
        return $this->telFournisseur;
    }

    public function setTelFournisseur(string $telFournisseur): self
    {
        $this->telFournisseur = $telFournisseur;

        return $this;
    }

    public function getNomContactFournisseur(): ?string
    {
        return $this->nomContactFournisseur;
    }

    public function setNomContactFournisseur(?string $nomContactFournisseur): self
    {
        $this->nomContactFournisseur = $nomContactFournisseur;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * @return Collection|Composant[]
     */
    public function getComposants(): Collection
    {
        return $this->composants;
    }

    public function addComposant(Composant $composant): self
    {
        if (!$this->composants->contains($composant)) {
            $this->composants[] = $composant;
            $composant->setFournisseurComposant($this);
        }

        return $this;
    }

    public function removeComposant(Composant $composant): self
    {
        if ($this->composants->contains($composant)) {
            $this->composants->removeElement($composant);
            // set the owning side to null (unless already changed)
            if ($composant->getFournisseurComposant() === $this) {
                $composant->setFournisseurComposant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getAdressesFournisseur(): Collection
    {
        return $this->adressesFournisseur;
    }

    public function addAdressesFournisseur(Adresse $adressesFournisseur): self
    {
        if (!$this->adressesFournisseur->contains($adressesFournisseur)) {
            $this->adressesFournisseur[] = $adressesFournisseur;
            $adressesFournisseur->setFournisseur($this);
        }

        return $this;
    }

    public function removeAdressesFournisseur(Adresse $adressesFournisseur): self
    {
        if ($this->adressesFournisseur->contains($adressesFournisseur)) {
            $this->adressesFournisseur->removeElement($adressesFournisseur);
            // set the owning side to null (unless already changed)
            if ($adressesFournisseur->getFournisseur() === $this) {
                $adressesFournisseur->setFournisseur(null);
            }
        }

        return $this;
    }

    public function getContactFournisseur(): ?ContactFournisseur
    {
        return $this->contactFournisseur;
    }

    public function setContactFournisseur(ContactFournisseur $contactFournisseur): self
    {
        $this->contactFournisseur = $contactFournisseur;

        // set the owning side of the relation if necessary
        if ($this !== $contactFournisseur->getIdFournisseur()) {
            $contactFournisseur->setIdFournisseur($this);
        }

        return $this;
    }
}
