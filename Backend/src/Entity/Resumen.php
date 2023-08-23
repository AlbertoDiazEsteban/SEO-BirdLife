<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ResumenRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResumenRepository::class)]
#[ApiResource]
class Resumen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $años = null;

    #[ORM\Column]
    private ?int $n_socios = null;

    #[ORM\Column]
    private ?int $n_voluntarios = null;

    #[ORM\Column]
    private ?float $gastos = null;

    #[ORM\Column]
    private ?float $ingresos = null;

    #[ORM\Column]
    private ?int $n_rrss = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAños(): ?int
    {
        return $this->años;
    }

    public function setAños(int $años): static
    {
        $this->años = $años;

        return $this;
    }

    public function getNSocios(): ?int
    {
        return $this->n_socios;
    }

    public function setNSocios(int $n_socios): static
    {
        $this->n_socios = $n_socios;

        return $this;
    }

    public function getNVoluntarios(): ?int
    {
        return $this->n_voluntarios;
    }

    public function setNVoluntarios(int $n_voluntarios): static
    {
        $this->n_voluntarios = $n_voluntarios;

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

    public function getIngresos(): ?float
    {
        return $this->ingresos;
    }

    public function setIngresos(float $ingresos): static
    {
        $this->ingresos = $ingresos;

        return $this;
    }

    public function getNRrss(): ?int
    {
        return $this->n_rrss;
    }

    public function setNRrss(int $n_rrss): static
    {
        $this->n_rrss = $n_rrss;

        return $this;
    }
}
