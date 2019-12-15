<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtapeRepository")
 */
class Etape
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
    private $etap_nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $etap_valeur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtapNom(): ?string
    {
        return $this->etap_nom;
    }

    public function setEtapNom(string $etap_nom): self
    {
        $this->etap_nom = $etap_nom;

        return $this;
    }

    public function getEtapValeur(): ?int
    {
        return $this->etap_valeur;
    }

    public function setEtapValeur(int $etap_valeur): self
    {
        $this->etap_valeur = $etap_valeur;

        return $this;
    }

}
