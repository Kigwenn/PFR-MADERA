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
    private $mais;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etape")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etap;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etat;

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
     * @ORM\JoinColumn(nullable=false)
     */
    private $adre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Gamme")
     */
    private $gamm;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commercial", inversedBy="listeDevis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $comm;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="devis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clie;

    // /**
    //  * @ORM\ManyToMany(targetEntity="App\Entity\Module", inversedBy="devis")
    //  */
    // private $modulesDevis;

    public function __construct()
    {
        $this->modulesDevis = new ArrayCollection();
    }

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

    public function getMais(): ?Maison
    {
        return $this->mais;
    }

    public function setMais(?Maison $mais): self
    {
        $this->mais = $mais;

        return $this;
    }

    public function getEtap(): ?Etape
    {
        return $this->etap;
    }

    public function setEtap(?Etape $etap): self
    {
        $this->etap = $etap;

        return $this;
    }

    public function getEtat(): ?Etat
    {
        return $this->etat;
    }

    public function setEtat(?Etat $etat): self
    {
        $this->etat = $etat;

        return $this;
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

    public function getGamm(): ?Gamme
    {
        return $this->gamm;
    }

    public function setGamm(?Gamme $gamm): self
    {
        $this->gamm = $gamm;

        return $this;
    }

    public function getComm(): ?Commercial
    {
        return $this->comm;
    }

    public function setComm(?Commercial $comm): self
    {
        $this->comm = $comm;

        return $this;
    }

    public function getClie(): ?Client
    {
        return $this->clie;
    }

    public function setClie(?Client $clie): self
    {
        $this->clie = $clie;

        return $this;
    }

    /**
     * @return Collection|Module[]
     */
    public function getModulesDevis(): Collection
    {
        return $this->modulesDevis;
    }

    public function addModulesDevi(Module $modulesDevi): self
    {
        if (!$this->modulesDevis->contains($modulesDevi)) {
            $this->modulesDevis[] = $modulesDevi;
        }

        return $this;
    }

    public function removeModulesDevi(Module $modulesDevi): self
    {
        if ($this->modulesDevis->contains($modulesDevi)) {
            $this->modulesDevis->removeElement($modulesDevi);
        }

        return $this;
    }
    

}
