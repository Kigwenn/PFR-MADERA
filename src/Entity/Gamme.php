<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GammeRepository")
 */
class Gamme
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
    private $nomGamme;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomGamme(): ?string
    {
        return $this->nomGamme;
    }

    public function setNomGamme(string $nomGamme): self
    {
        $this->nomGamme = $nomGamme;

        return $this;
    }
}
