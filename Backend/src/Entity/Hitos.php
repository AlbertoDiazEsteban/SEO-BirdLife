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
    private ?string $fk_resumen = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFkResumen(): ?string
    {
        return $this->fk_resumen;
    }

    public function setFkResumen(?string $fk_resumen): static
    {
        $this->fk_resumen = $fk_resumen;

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
}
