<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HuisseriesRepository")
 */
class Huisseries
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $huis_id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $huis_nom;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $huis_description;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $huis_prix_unitaire;

    /**
     * @ORM\Column(type="float")
     */
    private $huis_prix;

    public function getHuisId(): ?int
    {
        return $this->huis_id;
    }

    public function getHuisNom(): ?string
    {
        return $this->huis_nom;
    }

    public function setHuisNom(string $huis_nom): self
    {
        $this->huis_nom = $huis_nom;

        return $this;
    }

    public function getHuisDescription(): ?string
    {
        return $this->huis_description;
    }

    public function setHuisDescription(string $huis_description): self
    {
        $this->huis_description = $huis_description;

        return $this;
    }

    public function getHuisPrixUnitaire(): ?string
    {
        return $this->huis_prix_unitaire;
    }

    public function setHuisPrixUnitaire(string $huis_prix_unitaire): self
    {
        $this->huis_prix_unitaire = $huis_prix_unitaire;

        return $this;
    }

    public function getHuisPrix(): ?float
    {
        return $this->huis_prix;
    }

    public function setHuisPrix(float $huis_prix): self
    {
        $this->huis_prix = $huis_prix;

        return $this;
    }

    
}
