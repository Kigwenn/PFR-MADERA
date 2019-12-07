<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParametreRepository")
 */
class Parametre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $param_id;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2)
     */
    private $param_pourcentage;

    public function getParamId(): ?int
    {
        return $this->param_id;
    }

    public function getParamPourcentage(): ?string
    {
        return $this->param_pourcentage;
    }

    public function setParamPourcentage(string $param_pourcentage): self
    {
        $this->param_pourcentage = $param_pourcentage;

        return $this;
    }

    
}
