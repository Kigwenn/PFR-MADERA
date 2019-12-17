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
    private $adre_rue;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $adre_ville;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $adre_cp;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $adre_region;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adre_complement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adre_info;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pays")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pays;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdreRue(): ?string
    {
        return $this->adre_rue;
    }

    public function setAdreRue(string $adre_rue): self
    {
        $this->adre_rue = $adre_rue;

        return $this;
    }

    public function getAdreVille(): ?string
    {
        return $this->adre_ville;
    }

    public function setAdreVille(string $adre_ville): self
    {
        $this->adre_ville = $adre_ville;

        return $this;
    }

    public function getAdreCp(): ?string
    {
        return $this->adre_cp;
    }

    public function setAdreCp(string $adre_cp): self
    {
        $this->adre_cp = $adre_cp;

        return $this;
    }

    public function getAdreRegion(): ?string
    {
        return $this->adre_region;
    }

    public function setAdreRegion(string $adre_region): self
    {
        $this->adre_region = $adre_region;

        return $this;
    }

    public function getAdreComplement(): ?string
    {
        return $this->adre_complement;
    }

    public function setAdreComplement(?string $adre_complement): self
    {
        $this->adre_complement = $adre_complement;

        return $this;
    }

    public function getAdreInfo(): ?string
    {
        return $this->adre_info;
    }

    public function setAdreInfo(?string $adre_info): self
    {
        $this->adre_info = $adre_info;

        return $this;
    }

    public function getPaysId(): ?Pays
    {
        return $this->pays_id;
    }

    public function setPaysId(?Pays $pays_id): self
    {
        $this->pays_id = $pays_id;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }


}
