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
    private $remp_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FinitionExterieur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $finex_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Couverture")
     * @ORM\JoinColumn(nullable=false)
     */
    private $couv_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Huisseries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $huis_id;

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

    public function getRempId(): ?Remplissage
    {
        return $this->remp_id;
    }

    public function setRempId(?Remplissage $remp_id): self
    {
        $this->remp_id = $remp_id;

        return $this;
    }

    public function getFinexId(): ?FinitionExterieur
    {
        return $this->finex_id;
    }

    public function setFinexId(?FinitionExterieur $finex_id): self
    {
        $this->finex_id = $finex_id;

        return $this;
    }

    public function getCouvId(): ?Couverture
    {
        return $this->couv_id;
    }

    public function setCouvId(?Couverture $couv_id): self
    {
        $this->couv_id = $couv_id;

        return $this;
    }

    public function getHuisId(): ?Huisseries
    {
        return $this->huis_id;
    }

    public function setHuisId(?Huisseries $huis_id): self
    {
        $this->huis_id = $huis_id;

        return $this;
    }

}
