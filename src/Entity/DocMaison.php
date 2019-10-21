<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocMaisonRepository")
 */
class DocMaison
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="blob")
     */
    private $dataDoc;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Maison", inversedBy="docMaison")
     * @ORM\JoinColumn(nullable=false)
     */
    private $maison;

    public function __construct()
    {
        $this->maisons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDataDoc()
    {
        return $this->dataDoc;
    }

    public function setDataDoc($dataDoc): self
    {
        $this->dataDoc = $dataDoc;

        return $this;
    }

    public function getMaison(): ?Maison
    {
        return $this->maison;
    }

    public function setMaison(?Maison $maison): self
    {
        $this->maison = $maison;

        return $this;
    }
}
