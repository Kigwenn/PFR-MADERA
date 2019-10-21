<?php

namespace App\Entity;

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
}
