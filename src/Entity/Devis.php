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
    private $devi_nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $devi_date;

    /**
     * @ORM\Column(type="float")
     */
    private $devi_prix;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Maison", inversedBy="devis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mais_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etape")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etap_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etat_id;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $devi_dossier_estimatif;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $devi_dossier_technique;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adresse", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false, name="adre_id", referencedColumnName="adre_id")
     */
    private $adre_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Gamme")
     */
    private $gamm_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commercial", inversedBy="listeDevis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $comm_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="devis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clie_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeviNom(): ?string
    {
        return $this->devi_nom;
    }

    public function setDeviNom(string $devi_nom): self
    {
        $this->devi_nom = $devi_nom;

        return $this;
    }

    public function getDeviDate(): ?\DateTimeInterface
    {
        return $this->devi_date;
    }

    public function setDeviDate(\DateTimeInterface $devi_date): self
    {
        $this->devi_date = $devi_date;

        return $this;
    }

    public function getDeviPrix(): ?float
    {
        return $this->devi_prix;
    }

    public function setDeviPrix(float $devi_prix): self
    {
        $this->devi_prix = $devi_prix;

        return $this;
    }

    public function getDeviDossierEstimatif()
    {
        return $this->devi_dossier_estimatif;
    }

    public function setDeviDossierEstimatif($devi_dossier_estimatif): self
    {
        $this->devi_dossier_estimatif = $devi_dossier_estimatif;

        return $this;
    }

    public function getDeviDossierTechnique()
    {
        return $this->devi_dossier_technique;
    }

    public function setDeviDossierTechnique($devi_dossier_technique): self
    {
        $this->devi_dossier_technique = $devi_dossier_technique;

        return $this;
    }

    public function getMaisId(): ?Maison
    {
        return $this->mais_id;
    }

    public function setMaisId(?Maison $mais_id): self
    {
        $this->mais_id = $mais_id;

        return $this;
    }

    public function getEtapId(): ?Etape
    {
        return $this->etap_id;
    }

    public function setEtapId(?Etape $etap_id): self
    {
        $this->etap_id = $etap_id;

        return $this;
    }

    public function getEtatId(): ?Etat
    {
        return $this->etat_id;
    }

    public function setEtatId(?Etat $etat_id): self
    {
        $this->etat_id = $etat_id;

        return $this;
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

    public function getGammId(): ?Gamme
    {
        return $this->gamm_id;
    }

    public function setGammId(?Gamme $gamm_id): self
    {
        $this->gamm_id = $gamm_id;

        return $this;
    }

    public function getCommId(): ?Commercial
    {
        return $this->comm_id;
    }

    public function setCommId(?Commercial $comm_id): self
    {
        $this->comm_id = $comm_id;

        return $this;
    }

    public function getClieId(): ?Client
    {
        return $this->clie_id;
    }

    public function setClieId(?Client $clie_id): self
    {
        $this->clie_id = $clie_id;

        return $this;
    }

}
