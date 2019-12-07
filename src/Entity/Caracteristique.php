<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CaracteristiqueRepository")
 */
class Caracteristique
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $carac_id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $carac_nom;

    /**
     * @ORM\Column(type="float")
     */
    private $carac_largeur;

    /**
     * @ORM\Column(type="float")
     */
    private $carac_hauteur;

    /**
     * @ORM\Column(type="float")
     */
    private $carac_epaisseur;

    /**
     * @ORM\Column(type="float")
     */
    private $carac_poids;

    public function getCaracId(): ?int
    {
        return $this->carac_id;
    }

    public function getCaracNom(): ?string
    {
        return $this->carac_nom;
    }

    public function setCaracNom(string $carac_nom): self
    {
        $this->carac_nom = $carac_nom;

        return $this;
    }

    public function getCaracLargeur(): ?float
    {
        return $this->carac_largeur;
    }

    public function setCaracLargeur(float $carac_largeur): self
    {
        $this->carac_largeur = $carac_largeur;

        return $this;
    }

    public function getCaracHauteur(): ?float
    {
        return $this->carac_hauteur;
    }

    public function setCaracHauteur(float $carac_hauteur): self
    {
        $this->carac_hauteur = $carac_hauteur;

        return $this;
    }

    public function getCaracEpaisseur(): ?float
    {
        return $this->carac_epaisseur;
    }

    public function setCaracEpaisseur(float $carac_epaisseur): self
    {
        $this->carac_epaisseur = $carac_epaisseur;

        return $this;
    }

    public function getCaracPoids(): ?float
    {
        return $this->carac_poids;
    }

    public function setCaracPoids(float $carac_poids): self
    {
        $this->carac_poids = $carac_poids;

        return $this;
    }

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Composant", mappedBy="caracteristiquesComposant")
     */
    //private $composants;
}
