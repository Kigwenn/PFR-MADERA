<?php

namespace App\Entity;

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
}
