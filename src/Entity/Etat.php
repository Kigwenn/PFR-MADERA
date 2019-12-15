<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtatRepository")
 */
class Etat
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
    private $etat_nom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtatNom(): ?string
    {
        return $this->etat_nom;
    }

    public function setEtatNom(string $etat_nom): self
    {
        $this->etat_nom = $etat_nom;

        return $this;
    }

}
