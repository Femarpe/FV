<?php
namespace Fv\FantasyVerse\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Conjuro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $nombre;

    #[ORM\Column(type: "integer")]
    private int $nivel;

    #[ORM\Column(length: 255)]
    private string $escuela; // Evocación, Ilusión, etc.

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $componentes = null; // V, S, M

    #[ORM\Column(type: "boolean")]
    private bool $requiere_concentracion;

    #[ORM\Column(type: "boolean")]
    private bool $ritual;

    #[ORM\Column(type: "json")]
    private array $clases_permitidas = []; // Lista de clases que pueden usarlo

    #[ORM\Column(length: 255)]
    private string $tiempo_lanzamiento; // Acción, 1 minuto, etc.

    #[ORM\Column(length: 255)]
    private string $duracion; // Instantánea, 1 minuto, etc.

    #[ORM\Column(length: 255)]
    private string $alcance; // Toque, 30 pies, etc.

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $a_niveles_superiores = null; // Efecto al lanzarlo con espacios de nivel superior

    // Métodos Getters y Setters
}
