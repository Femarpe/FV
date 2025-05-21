<?php

namespace Fv\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fv\Repository\PersonajeRepository;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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
    private ?string $jugador = null;

    #[ORM\Column(length: 255)]
    private ?string $trasfondo = null;

    #[ORM\Column(type: 'integer')]
    private int $experiencia;

    #[ORM\Column(length: 255)]
    private ?string $raza = null;

    #[ORM\Column(type: 'json')]
    private array $clases_niveles = []; // Almacena las clases y niveles del personaje

    #[ORM\Column(type: 'json')]
    private array $clases_lanzadoras_conjuros = []; // Almacena las clases lanzadoras de conjuros del personaje

    #[ORM\Column(length: 255)]
    private ?string $alineamiento = null;

    #[ORM\Column(type: 'json')]
    private array $idiomas = [];

    #[ORM\Column(type: 'integer')]
    private int $inspiracion;

    #[ORM\Column(type: 'integer')]
    private int $velocidad;

    #[ORM\Column(type: 'json')]
    private array $resistencias = [];

    #[ORM\Column(type: 'json')]
    private array $vulnerabilidades = [];

    #[ORM\Column(type: 'json')]
    private array $inmunidades = [];

    #[ORM\Column(length: 255)]
    private ?string $dado_golpe_tipo = null;

    #[ORM\Column(type: 'integer')]
    private int $xp_proximo_nivel;

    #[ORM\Column(length: 255)]
    private ?string $estado_actual = null;

    #[ORM\Column(type: 'json')]
    private array $competencias_herramientas = [];

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $notas = null;

    #[ORM\Column(type: 'json')]
    private array $atributos = [];

    #[ORM\Column(type: 'json')]
    private array $tiradas_salvacion = [];

    #[ORM\Column(type: 'json')]
    private array $habilidades = [];

    #[ORM\Column(type: 'integer')]
    private int $ca;

    #[ORM\Column(type: 'integer')]
    private int $puntos_golpe;

    #[ORM\Column(type: 'integer')]
    private int $puntos_golpe_temporales;

    #[ORM\Column(type: 'integer')]
    private int $iniciativa;

    #[ORM\Column(length: 255)]
    private ?string $dados_golpe = null;

    #[ORM\Column(type: 'boolean')]
    private bool $magia;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $cd_conjuro = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $ataque_conjuro = null;

    #[ORM\ManyToMany(targetEntity: Conjuro::class)]
    #[ORM\JoinTable(name: "personaje_conjuros")]
    private Collection $conjuros;

    #[ORM\Column(type: 'json')]
    private array $conjuros_extra = []; // Conjuros obtenidos por dotes, armas o herramientas mágicas

    #[ORM\Column(type: 'integer')]
    private int $carga_maxima;

    #[ORM\Column(length: 255)]
    private ?string $monedas = null;

    #[ORM\Column(type: 'json')]
    private array $armas = [];

    #[ORM\Column(type: 'json')]
    private array $equipo = [];

    #[ORM\Column(type: 'text')]
    private ?string $rasgos_personalidad = null;

    #[ORM\Column(type: 'text')]
    private ?string $ideales = null;

    #[ORM\Column(type: 'text')]
    private ?string $vinculos = null;

    #[ORM\Column(type: 'text')]
    private ?string $defectos = null;

    public function __construct()
    {
        $this->conjuros = new ArrayCollection();
    }
}
