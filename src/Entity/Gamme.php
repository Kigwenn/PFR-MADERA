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
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $gamm_nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Module", mappedBy="gammeModule")
     */
    private $modules;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Remplissage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $remp;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FinitionExterieur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $finex;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Couverture")
     * @ORM\JoinColumn(nullable=false)
     */
    private $couv;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Huisseries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $huis;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRemp(): ?Remplissage
    {
        return $this->remp;
    }

    public function setRemp(?Remplissage $remp): self
    {
        $this->remp = $remp;

        return $this;
    }

    public function getFinex(): ?FinitionExterieur
    {
        return $this->finex;
    }

    public function setFinex(?FinitionExterieur $finex): self
    {
        $this->finex = $finex;

        return $this;
    }

    public function getCouv(): ?Couverture
    {
        return $this->couv;
    }

    public function setCouv(?Couverture $couv): self
    {
        $this->couv = $couv;

        return $this;
    }

    public function getHuis(): ?Huisseries
    {
        return $this->huis;
    }

    public function setHuis(?Huisseries $huis): self
    {
        $this->huis = $huis;

        return $this;
    }

}
