<?php

namespace Fv\FantasyVerse\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Fv\FantasyVerse\Repository\CampanyaRepository;

#[ORM\Entity(repositoryClass: CampanyaRepository::class)]
class Campanya
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private Uuid $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $nombre = '';

    #[ORM\Column(type: 'text')]
    private string $descripcion = '';

    #[ORM\Column(type: 'string', length: 255)]
    private string $creador = '';

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $resumen_sesion = '';

    #[ORM\Column(type: 'string', length: 100)]
    private string $estado_actual = '';

    #[ORM\Column(type: 'string', length: 255)]
    private string $localizacion_actual = '';

    #[ORM\Column(type: 'string', length: 100)]
    private string $dia_en_el_calendario = '';

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $notas_director = '';

    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function getCreador(): string
    {
        return $this->creador;
    }

    public function setCreador(string $creador): self
    {
        $this->creador = $creador;
        return $this;
    }

    public function getResumenSesion(): ?string
    {
        return $this->resumen_sesion;
    }

    public function setResumenSesion(?string $resumen): self
    {
        $this->resumen_sesion = $resumen;
        return $this;
    }

    public function getEstadoActual(): string
    {
        return $this->estado_actual;
    }

    public function setEstadoActual(string $estado): self
    {
        $this->estado_actual = $estado;
        return $this;
    }

    public function getLocalizacionActual(): string
    {
        return $this->localizacion_actual;
    }

    public function setLocalizacionActual(string $loc): self
    {
        $this->localizacion_actual = $loc;
        return $this;
    }

    public function getDiaEnElCalendario(): string
    {
        return $this->dia_en_el_calendario;
    }

    public function setDiaEnElCalendario(string $dia): self
    {
        $this->dia_en_el_calendario = $dia;
        return $this;
    }

    public function getNotasDirector(): ?string
    {
        return $this->notas_director;
    }

    public function setNotasDirector(?string $notas): self
    {
        $this->notas_director = $notas;
        return $this;
    }
}
