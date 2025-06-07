<?php

namespace Fv\FantasyVerse\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fv\FantasyVerse\Repository\EventoRepository;
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
    public function getid(): ?int { return $this->id; }
    public function gettitulo(): string { return $this->titulo; }
    public function settitulo(string $titulo): self { $this->titulo = $titulo; return $this; }

    public function getdescripcion(): ?string { return $this->descripcion; }
    public function setdescripcion(?string $descripcion): self { $this->descripcion = $descripcion; return $this; }

    public function getfecha(): \DateTimeInterface { return $this->fecha; }
    public function setfecha(\DateTimeInterface $fecha): self { $this->fecha = $fecha; return $this; }

    public function gettipo(): string { return $this->tipo; }
    public function settipo(string $tipo): self { $this->tipo = $tipo; return $this; }

    public function getusuario(): ?Usuario { return $this->usuario; }
    public function setusuario(?Usuario $usuario): self { $this->usuario = $usuario; return $this; }

    public function getcampanya(): ?Campanya { return $this->campanya; }
    public function setcampanya(?Campanya $campanya): self { $this->campanya = $campanya; return $this; }
}
