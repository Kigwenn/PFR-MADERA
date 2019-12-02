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
    private $nomEtapeDevis;

    /**
     * @ORM\Column(type="integer")
     */
    private $valeurBaseEtape;

    public function __construct()
    {
        $this->devis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEtapeDevis(): ?string
    {
        return $this->nomEtapeDevis;
    }

    public function setNomEtapeDevis(string $nomEtapeDevis): self
    {
        $this->nomEtapeDevis = $nomEtapeDevis;

        return $this;
    }

    public function getValeurBaseEtape(): ?int
    {
        return $this->valeurBaseEtape;
    }

    public function setValeurBaseEtape(int $valeurBaseEtape): self
    {
        $this->valeurBaseEtape = $valeurBaseEtape;

        return $this;
    }
}
