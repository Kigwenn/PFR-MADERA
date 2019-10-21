<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdresseRepository")
 */
class Adresse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $rueAdresse;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $villeAdresse;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $cpAdresse;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $regionAdresse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fournisseur", inversedBy="adressesFournisseur")
     */
    private $fournisseur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRueAdresse(): ?string
    {
        return $this->rueAdresse;
    }

    public function setRueAdresse(string $rueAdresse): self
    {
        $this->rueAdresse = $rueAdresse;

        return $this;
    }

    public function getVilleAdresse(): ?string
    {
        return $this->villeAdresse;
    }

    public function setVilleAdresse(string $villeAdresse): self
    {
        $this->villeAdresse = $villeAdresse;

        return $this;
    }

    public function getCpAdresse(): ?string
    {
        return $this->cpAdresse;
    }

    public function setCpAdresse(string $cpAdresse): self
    {
        $this->cpAdresse = $cpAdresse;

        return $this;
    }

    public function getRegionAdresse(): ?string
    {
        return $this->regionAdresse;
    }

    public function setRegionAdresse(string $regionAdresse): self
    {
        $this->regionAdresse = $regionAdresse;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }
}
