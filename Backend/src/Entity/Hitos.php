<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\HitosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HitosRepository::class)]
#[ApiResource]
class Hitos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?int $fecha = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'hitos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Resumen $resumen = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?int
    {
        return $this->fecha;
    }

    public function setFecha(?int $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getResumen(): ?Resumen
    {
        return $this->resumen;
    }

    public function setResumen(?Resumen $resumen): static
    {
        $this->resumen = $resumen;

        return $this;
    }
}
