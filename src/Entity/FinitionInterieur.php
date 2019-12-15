<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FinitionInterieurRepository")
 */
class FinitionInterieur
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
    private $finin_nom;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $finin_description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFininNom(): ?string
    {
        return $this->finin_nom;
    }

    public function setFininNom(string $finin_nom): self
    {
        $this->finin_nom = $finin_nom;

        return $this;
    }

    public function getFininDescription(): ?string
    {
        return $this->finin_description;
    }

    public function setFininDescription(string $finin_description): self
    {
        $this->finin_description = $finin_description;

        return $this;
    }
}
