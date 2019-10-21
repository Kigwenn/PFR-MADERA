<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DevisRepository")
 */
class Devis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomDevis;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDevis;

    /**
     * @ORM\Column(type="float")
     */
    private $prixTotal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="devis")
     */
    private $utilisateurDevis;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EtatDevis", inversedBy="devis")
     */
    private $etatDevis;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Etape", inversedBy="devis")
     */
    private $etapeDevis;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Maison", inversedBy="devis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $devisMaison;

    public function __construct()
    {
        $this->utilisateurDevis = new ArrayCollection();
        $this->etatDevis = new ArrayCollection();
        $this->etapeDevis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDevis(): ?string
    {
        return $this->nomDevis;
    }

    public function setNomDevis(string $nomDevis): self
    {
        $this->nomDevis = $nomDevis;

        return $this;
    }

    public function getDateDevis(): ?\DateTimeInterface
    {
        return $this->dateDevis;
    }

    public function setDateDevis(\DateTimeInterface $dateDevis): self
    {
        $this->dateDevis = $dateDevis;

        return $this;
    }

    public function getPrixTotal(): ?float
    {
        return $this->prixTotal;
    }

    public function setPrixTotal(float $prixTotal): self
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    public function getUtilisateurDevis(): ?Utilisateur
    {
        return $this->utilisateurDevis;
    }

    public function setUtilisateurDevis(?Utilisateur $utilisateurDevis): self
    {
        $this->utilisateurDevis = $utilisateurDevis;

        return $this;
    }

    /**
     * @return Collection|EtatDevis[]
     */
    public function getEtatDevis(): Collection
    {
        return $this->etatDevis;
    }

    public function addEtatDevis(EtatDevis $etatDevis): self
    {
        if (!$this->etatDevis->contains($etatDevis)) {
            $this->etatDevis[] = $etatDevis;
        }

        return $this;
    }

    public function removeEtatDevis(EtatDevis $etatDevis): self
    {
        if ($this->etatDevis->contains($etatDevis)) {
            $this->etatDevis->removeElement($etatDevis);
        }

        return $this;
    }

    /**
     * @return Collection|Etape[]
     */
    public function getEtapeDevis(): Collection
    {
        return $this->etapeDevis;
    }

    public function addEtapeDevi(Etape $etapeDevi): self
    {
        if (!$this->etapeDevis->contains($etapeDevi)) {
            $this->etapeDevis[] = $etapeDevi;
        }

        return $this;
    }

    public function removeEtapeDevi(Etape $etapeDevi): self
    {
        if ($this->etapeDevis->contains($etapeDevi)) {
            $this->etapeDevis->removeElement($etapeDevi);
        }

        return $this;
    }

    public function getDevisMaison(): ?Maison
    {
        return $this->devisMaison;
    }

    public function setDevisMaison(?Maison $devisMaison): self
    {
        $this->devisMaison = $devisMaison;

        return $this;
    }
}
