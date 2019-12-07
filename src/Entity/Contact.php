<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Fournisseur", inversedBy="contactFournisseur", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $four_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFourId(): ?Fournisseur
    {
        return $this->four_id;
    }

    public function setFourId(Fournisseur $four_id): self
    {
        $this->four_id = $four_id;

        return $this;
    }

}
