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
    private $four_nom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $four_mail;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $four_tel;

    /**
     * @ORM\Column(type="string", length=14)
     */
    private $four_siret;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Composant", inversedBy="fournisseurs")
     * @ORM\JoinColumn(name="comp_id", referencedColumnName="comp_id")
     */
    private $composants;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Adresse", mappedBy="fournisseur")
     */
    private $adre_id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Contact", mappedBy="four_id", cascade={"persist", "remove"})
     */
    private $contact;

    public function __construct()
    {
        $this->composants = new ArrayCollection();
        $this->adre_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFourNom(): ?string
    {
        return $this->four_nom;
    }

    public function setFourNom(string $four_nom): self
    {
        $this->four_nom = $four_nom;

        return $this;
    }

    public function getFourMail(): ?string
    {
        return $this->four_mail;
    }

    public function setFourMail(string $four_mail): self
    {
        $this->four_mail = $four_mail;

        return $this;
    }

    public function getFourTel(): ?string
    {
        return $this->four_tel;
    }

    public function setFourTel(string $four_tel): self
    {
        $this->four_tel = $four_tel;

        return $this;
    }

    public function getFourSiret(): ?string
    {
        return $this->four_siret;
    }

    public function setFourSiret(string $four_siret): self
    {
        $this->four_siret = $four_siret;

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
    public function getAdreId(): Collection
    {
        return $this->adre_id;
    }

    public function addAdreId(Adresse $adreId): self
    {
        if (!$this->adre_id->contains($adreId)) {
            $this->adre_id[] = $adreId;
            $adreId->setFournisseur($this);
        }

        return $this;
    }

    public function removeAdreId(Adresse $adreId): self
    {
        if ($this->adre_id->contains($adreId)) {
            $this->adre_id->removeElement($adreId);
            // set the owning side to null (unless already changed)
            if ($adreId->getFournisseur() === $this) {
                $adreId->setFournisseur(null);
            }
        }

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

        // set (or unset) the owning side of the relation if necessary
        $newFour_id = $contact === null ? null : $this;
        if ($newFour_id !== $contact->getFourId()) {
            $contact->setFourId($newFour_id);
        }

        return $this;
    }

    
}
