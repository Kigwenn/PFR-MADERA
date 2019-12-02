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
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomCCTP;

    /**
     * @ORM\Column(type="blob")
     */
    private $imageCCTP;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCCTP(): ?string
    {
        return $this->nomCCTP;
    }

    public function setNomCCTP(string $nomCCTP): self
    {
        $this->nomCCTP = $nomCCTP;

        return $this;
    }

    public function getImageCCTP()
    {
        return $this->imageCCTP;
    }

    public function setImageCCTP($imageCCTP): self
    {
        $this->imageCCTP = $imageCCTP;

        return $this;
    }
}
