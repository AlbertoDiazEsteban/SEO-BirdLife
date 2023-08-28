<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PresupuestoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PresupuestoRepository::class)]
#[ApiResource]
class Presupuesto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $ingresos = null;

    #[ORM\Column]
    private ?float $gastos = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Years $fk_year = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIngresos(): ?float
    {
        return $this->ingresos;
    }

    public function setIngresos(float $ingresos): static
    {
        $this->ingresos = $ingresos;

        return $this;
    }

    public function getGastos(): ?float
    {
        return $this->gastos;
    }

    public function setGastos(float $gastos): static
    {
        $this->gastos = $gastos;

        return $this;
    }

    public function getFkYear(): ?Years
    {
        return $this->fk_year;
    }

    public function setFkYear(Years $fk_year): static
    {
        $this->fk_year = $fk_year;

        return $this;
    }
}
