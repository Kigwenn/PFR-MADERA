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
    private $pers_id;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $pers_sexe;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $pers_nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $pers_prenom;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $pers_mail;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $pers_tel;

    public function getPersId(): ?int
    {
        return $this->pers_id;
    }

    public function getPersSexe(): ?string
    {
        return $this->pers_sexe;
    }

    public function setPersSexe(string $pers_sexe): self
    {
        $this->pers_sexe = $pers_sexe;

        return $this;
    }

    public function getPersNom(): ?string
    {
        return $this->pers_nom;
    }

    public function setPersNom(string $pers_nom): self
    {
        $this->pers_nom = $pers_nom;

        return $this;
    }

    public function getPersPrenom(): ?string
    {
        return $this->pers_prenom;
    }

    public function setPersPrenom(string $pers_prenom): self
    {
        $this->pers_prenom = $pers_prenom;

        return $this;
    }

    public function getPersMail(): ?string
    {
        return $this->pers_mail;
    }

    public function setPersMail(string $pers_mail): self
    {
        $this->pers_mail = $pers_mail;

        return $this;
    }

    public function getPersTel(): ?string
    {
        return $this->pers_tel;
    }

    public function setPersTel(string $pers_tel): self
    {
        $this->pers_tel = $pers_tel;

        return $this;
    }

}
