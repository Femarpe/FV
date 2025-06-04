<?php

namespace Fv\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fv\Repository\EventoRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EventoRepository::class)]
class Evento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank]
    private string $titulo;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(type: 'datetime')]
    #[Assert\NotNull]
    private \DateTimeInterface $fecha;

    #[ORM\Column(type: 'string')]
    #[Assert\Choice(choices: ['evento', 'disponible', 'no_disponible'])]
    private string $tipo;

    #[ORM\ManyToOne(targetEntity: Usuario::class)]
    private ?Usuario $usuario = null;

    #[ORM\ManyToOne(targetEntity: Campanya::class)]
    private ?Campanya $campanya = null;

    // Getters y Setters
    public function get_id(): ?int { return $this->id; }
    public function get_titulo(): string { return $this->titulo; }
    public function set_titulo(string $titulo): self { $this->titulo = $titulo; return $this; }

    public function get_descripcion(): ?string { return $this->descripcion; }
    public function set_descripcion(?string $descripcion): self { $this->descripcion = $descripcion; return $this; }

    public function get_fecha(): \DateTimeInterface { return $this->fecha; }
    public function set_fecha(\DateTimeInterface $fecha): self { $this->fecha = $fecha; return $this; }

    public function get_tipo(): string { return $this->tipo; }
    public function set_tipo(string $tipo): self { $this->tipo = $tipo; return $this; }

    public function get_usuario(): ?Usuario { return $this->usuario; }
    public function set_usuario(?Usuario $usuario): self { $this->usuario = $usuario; return $this; }

    public function get_campanya(): ?Campanya { return $this->campanya; }
    public function set_campanya(?Campanya $campanya): self { $this->campanya = $campanya; return $this; }
}
