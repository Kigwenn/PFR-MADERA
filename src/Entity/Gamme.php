<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GammeRepository")
 */
class Gamme
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $gamm_id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $gamm_nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Module", mappedBy="gammeModule")
     */
    private $modules;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
    }

    public function getGammId(): ?int
    {
        return $this->gamm_id;
    }

    public function getGammNom(): ?string
    {
        return $this->gamm_nom;
    }

    public function setGammNom(string $gamm_nom): self
    {
        $this->gamm_nom = $gamm_nom;

        return $this;
    }

    /**
     * @return Collection|Module[]
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
            $module->setGammeModule($this);
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        if ($this->modules->contains($module)) {
            $this->modules->removeElement($module);
            // set the owning side to null (unless already changed)
            if ($module->getGammeModule() === $this) {
                $module->setGammeModule(null);
            }
        }

        return $this;
    }

}
