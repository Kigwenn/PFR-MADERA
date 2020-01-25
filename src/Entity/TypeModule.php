<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeModuleRepository")
 */
class TypeModule
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
    private $tymo_nom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTymoNom(): ?string
    {
        return $this->tymo_nom;
    }

    public function setTymoNom(string $tymo_nom): self
    {
        $this->tymo_nom = $tymo_nom;

        return $this;
    }
}
