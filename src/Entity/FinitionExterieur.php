<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FinitionExterieurRepository")
 */
class FinitionExterieur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $finex_id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $finex_nom;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $finex_description;

    public function getFinexId(): ?int
    {
        return $this->finex_id;
    }

    public function getFinexNom(): ?string
    {
        return $this->finex_nom;
    }

    public function setFinexNom(string $finex_nom): self
    {
        $this->finex_nom = $finex_nom;

        return $this;
    }

    public function getFinexDescription(): ?string
    {
        return $this->finex_description;
    }

    public function setFinexDescription(string $finex_description): self
    {
        $this->finex_description = $finex_description;

        return $this;
    }
}
