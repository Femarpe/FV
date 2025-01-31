<?php

namespace Fv\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fv\Repository\PersonajeRepository;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: PersonajeRepository::class)]
class Personaje
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;
    
    #[ORM\Column(length: 255)]
    private ?string $ca = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCa(): ?string
    {
        return $this->ca;
    }

    public function setCa(string $ca): static
    {
        $this->ca = $ca;

        return $this;
    }
}
