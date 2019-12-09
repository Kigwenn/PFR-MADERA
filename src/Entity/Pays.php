<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaysRepository")
 */
class Pays
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $pays_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays_nom;

    public function getPaysId(): ?int
    {
        return $this->pays_id;
    }

    public function getPaysNom(): ?string
    {
        return $this->pays_nom;
    }

    public function setPaysNom(string $pays_nom): self
    {
        $this->pays_nom = $pays_nom;

        return $this;
    }
}
