<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RemplissageRepository")
 */
class Remplissage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $remp_id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $remp_nom;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $remp_description;

    public function getRempId(): ?int
    {
        return $this->remp_id;
    }

    public function getRempNom(): ?string
    {
        return $this->remp_nom;
    }

    public function setRempNom(string $remp_nom): self
    {
        $this->remp_nom = $remp_nom;

        return $this;
    }

    public function getRempDescription(): ?string
    {
        return $this->remp_description;
    }

    public function setRempDescription(string $remp_description): self
    {
        $this->remp_description = $remp_description;

        return $this;
    }
}
