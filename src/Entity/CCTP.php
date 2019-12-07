<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CCTPRepository")
 */
class CCTP
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $cctp_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cctp_nom;

    /**
     * @ORM\Column(type="blob")
     */
    private $cctp_image;

    public function getCctpId(): ?int
    {
        return $this->cctp_id;
    }

    public function getCctpNom(): ?string
    {
        return $this->cctp_nom;
    }

    public function setCctpNom(string $cctp_nom): self
    {
        $this->cctp_nom = $cctp_nom;

        return $this;
    }

    public function getCctpImage()
    {
        return $this->cctp_image;
    }

    public function setCctpImage($cctp_image): self
    {
        $this->cctp_image = $cctp_image;

        return $this;
    }

    
}
