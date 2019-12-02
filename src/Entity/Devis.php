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
     * @ORM\ManyToOne(targetEntity="App\Entity\Maison", inversedBy="devis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $devisMaison;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etape")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etapeDevis;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EtatDevis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etatDevis;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $stockageDevis;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $dossierTechnique;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adresse", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idAdresse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Gamme")
     */
    private $idGamme;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commercial", inversedBy="listeDevis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCommercial;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="devis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idClient;

    public function __construct()
    {
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

    public function getDevisMaison(): ?Maison
    {
        return $this->devisMaison;
    }

    public function setDevisMaison(?Maison $devisMaison): self
    {
        $this->devisMaison = $devisMaison;

        return $this;
    }

    public function getEtapeDevis(): ?Etape
    {
        return $this->etapeDevis;
    }

    public function setEtapeDevis(?Etape $etapeDevis): self
    {
        $this->etapeDevis = $etapeDevis;

        return $this;
    }

    public function getEtatDevis(): ?EtatDevis
    {
        return $this->etatDevis;
    }

    public function setEtatDevis(?EtatDevis $etatDevis): self
    {
        $this->etatDevis = $etatDevis;

        return $this;
    }

    public function getStockageDevis()
    {
        return $this->stockageDevis;
    }

    public function setStockageDevis($stockageDevis): self
    {
        $this->stockageDevis = $stockageDevis;

        return $this;
    }

    public function getDossierTechnique()
    {
        return $this->dossierTechnique;
    }

    public function setDossierTechnique($dossierTechnique): self
    {
        $this->dossierTechnique = $dossierTechnique;

        return $this;
    }

    public function getIdAdresse(): ?Adresse
    {
        return $this->idAdresse;
    }

    public function setIdAdresse(Adresse $idAdresse): self
    {
        $this->idAdresse = $idAdresse;

        return $this;
    }

    public function getIdGamme(): ?Gamme
    {
        return $this->idGamme;
    }

    public function setIdGamme(?Gamme $idGamme): self
    {
        $this->idGamme = $idGamme;

        return $this;
    }

    public function getIdCommercial(): ?Commercial
    {
        return $this->idCommercial;
    }

    public function setIdCommercial(?Commercial $idCommercial): self
    {
        $this->idCommercial = $idCommercial;

        return $this;
    }

    public function getIdClient(): ?Client
    {
        return $this->idClient;
    }

    public function setIdClient(?Client $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }
}
