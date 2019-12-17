<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CouvertureRepository")
 */
class Couverture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $couv_nom;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $couv_description;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $couv_prix_unitaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCouvNom(): ?string
    {
        return $this->couv_nom;
    }

    public function setCouvNom(string $couv_nom): self
    {
        $this->couv_nom = $couv_nom;

        return $this;
    }

    public function getCouvDescription(): ?string
    {
        return $this->couv_description;
    }

    public function setCouvDescription(string $couv_description): self
    {
        $this->couv_description = $couv_description;

        return $this;
    }

    public function getCouvPrixUnitaire(): ?string
    {
        return $this->couv_prix_unitaire;
    }

    public function setCouvPrixUnitaire(string $couv_prix_unitaire): self
    {
        $this->couv_prix_unitaire = $couv_prix_unitaire;

        return $this;
    }
}
