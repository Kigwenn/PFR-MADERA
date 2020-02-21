<?php

namespace App\Entity;

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
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $cara_section;

    /**
     * @ORM\Column(type="float")
     */
    private $cara_hauteur;

    /**
     * @ORM\Column(type="float")
     */
    private $cara_longueur;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $cara_type_angle;

    /**
     * @ORM\Column(type="float")
     */
    private $cara_degre_angle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Module")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $modu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCaraSection(): ?float
    {
        return $this->cara_section;
    }

    public function setCaraSection(float $cara_section): self
    {
        $this->cara_section = $cara_section;

        return $this;
    }

    public function getCaraHauteur(): ?float
    {
        return $this->cara_hauteur;
    }

    public function setCaraHauteur(float $cara_hauteur): self
    {
        $this->cara_hauteur = $cara_hauteur;

        return $this;
    }

    public function getCaraLongueur(): ?float
    {
        return $this->cara_longueur;
    }

    public function setCaraLongueur(float $cara_longueur): self
    {
        $this->cara_longueur = $cara_longueur;

        return $this;
    }

    public function getCaraTypeAngle(): ?string
    {
        return $this->cara_type_angle;
    }

    public function setCaraTypeAngle(string $cara_type_angle): self
    {
        $this->cara_type_angle = $cara_type_angle;

        return $this;
    }

    public function getCaraDegreAngle(): ?float
    {
        return $this->cara_degre_angle;
    }

    public function setCaraDegreAngle(float $cara_degre_angle): self
    {
        $this->cara_degre_angle = $cara_degre_angle;

        return $this;
    }

    public function getModu(): ?Module
    {
        return $this->modu;
    }

    public function setModu(?Module $modu): self
    {
        $this->modu = $modu;

        return $this;
    }
}
