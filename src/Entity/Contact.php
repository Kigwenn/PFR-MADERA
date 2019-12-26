<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact extends Personne
{

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Fournisseur", inversedBy="contactFournisseur", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $four;

    public function getFour(): ?Fournisseur
    {
        return $this->four;
    }

    public function setFour(Fournisseur $four): self
    {
        $this->four = $four;

        return $this;
    }

}
