<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComposantModuleRepository")
 */
class ComposantModule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $como_quantite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComoQuantite(): ?int
    {
        return $this->como_quantite;
    }

    public function setComoQuantite(int $como_quantite): self
    {
        $this->como_quantite = $como_quantite;

        return $this;
    }

}
