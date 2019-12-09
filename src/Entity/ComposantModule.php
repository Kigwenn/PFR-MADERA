<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComposantModuleRepository")
 */
class ComposantModule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $como_quantite;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Module", inversedBy="composantModules")
     */
    private $modu_id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Composant", inversedBy="composantModules")
     */
    private $comp_id;

    public function __construct()
    {
        $this->modu_id = new ArrayCollection();
        $this->comp_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComoQuantite(): ?int
    {
        return $this->como_quantite;
    }

    public function setComoQuantite(int $como_quantite): self
    {
        $this->como_quantite = $como_quantite;

        return $this;
    }

    /**
     * @return Collection|Module[]
     */
    public function getModuId(): Collection
    {
        return $this->modu_id;
    }

    public function addModuId(Module $moduId): self
    {
        if (!$this->modu_id->contains($moduId)) {
            $this->modu_id[] = $moduId;
        }

        return $this;
    }

    public function removeModuId(Module $moduId): self
    {
        if ($this->modu_id->contains($moduId)) {
            $this->modu_id->removeElement($moduId);
        }

        return $this;
    }

    /**
     * @return Collection|Composant[]
     */
    public function getCompId(): Collection
    {
        return $this->comp_id;
    }

    public function addCompId(Composant $compId): self
    {
        if (!$this->comp_id->contains($compId)) {
            $this->comp_id[] = $compId;
        }

        return $this;
    }

    public function removeCompId(Composant $compId): self
    {
        if ($this->comp_id->contains($compId)) {
            $this->comp_id->removeElement($compId);
        }

        return $this;
    }

}
