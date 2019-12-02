<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonneRepository")
 */
abstract class Personne
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $sexePersonne;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomPersonne;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenomPersonne;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $mailPersonne;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $telPersonne;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSexePersonne(): ?string
    {
        return $this->sexePersonne;
    }

    public function setSexePersonne(string $sexePersonne): self
    {
        $this->sexePersonne = $sexePersonne;

        return $this;
    }

    public function getNomPersonne(): ?string
    {
        return $this->nomPersonne;
    }

    public function setNomPersonne(string $nomPersonne): self
    {
        $this->nomPersonne = $nomPersonne;

        return $this;
    }

    public function getPrenomPersonne(): ?string
    {
        return $this->prenomPersonne;
    }

    public function setPrenomPersonne(string $prenomPersonne): self
    {
        $this->prenomPersonne = $prenomPersonne;

        return $this;
    }

    public function getMailPersonne(): ?string
    {
        return $this->mailPersonne;
    }

    public function setMailPersonne(string $mailPersonne): self
    {
        $this->mailPersonne = $mailPersonne;

        return $this;
    }

    public function getTelPersonne(): ?string
    {
        return $this->telPersonne;
    }

    public function setTelPersonne(string $telPersonne): self
    {
        $this->telPersonne = $telPersonne;

        return $this;
    }
}
