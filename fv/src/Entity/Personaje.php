<?php

namespace Fv\Entity;

use Doctrine\DBAL\Types\Types;
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
    private string $nombre = '';

    #[ORM\Column(length: 255)]
    private string $jugador = '';

    #[ORM\Column(length: 255)]
    private string $trasfondo = '';

    #[ORM\Column(type: 'integer')]
    private int $experiencia = 0;

    #[ORM\Column(length: 255)]
    private string $raza = '';

    #[ORM\Column(type: 'json')]
    private array $clases_niveles = []; // Almacena las clases y niveles del personaje

    #[ORM\Column(type: 'json')]
    private array $clases_lanzadoras_conjuros = []; // Almacena las clases lanzadoras de conjuros del personaje

    #[ORM\Column(length: 255)]
    private string $alineamiento = '';

    #[ORM\Column(type: 'json')]
    private array $idiomas = [];

    #[ORM\Column(type: 'integer')]
    private int $inspiracion = 0;

    #[ORM\Column(type: 'integer')]
    private int $velocidad = 0;

    #[ORM\Column(type: 'json')]
    private array $resistencias = [];

    #[ORM\Column(type: 'json')]
    private array $vulnerabilidades = [];

    #[ORM\Column(type: 'json')]
    private array $inmunidades = [];

    #[ORM\Column(length: 255)]
    private string $dado_golpe_tipo = '';

    #[ORM\Column(type: 'integer')]
    private int $xp_proximo_nivel = 0;

    #[ORM\Column(length: 255)]
    private string $estado_actual = '';

    #[ORM\Column(type: 'json')]
    private array $competencias_herramientas = [];

    #[ORM\Column(type: 'text', nullable: true)]
    private string $notas = '';

    #[ORM\Column(type: 'json')]
    private array $atributos = [];

    #[ORM\Column(type: 'json')]
    private array $tiradas_salvacion = [];

    #[ORM\Column(type: 'json')]
    private array $habilidades = [];

    #[ORM\Column(type: 'integer')]
    private int $ca = 0;

    #[ORM\Column(type: 'integer')]
    private int $puntos_golpe = 0;

    #[ORM\Column(type: 'integer')]
    private int $puntos_golpe_temporales = 0;

    #[ORM\Column(type: 'integer')]
    private int $iniciativa = 0;
    private int $tirada_iniciativa = 0;

    #[ORM\Column(length: 255)]
    private string $dados_golpe = '';

    #[ORM\Column(type: 'boolean')]
    private bool $magia = true;

    #[ORM\Column(type: 'integer', nullable: true)]
    private int $cd_conjuro = 0;

    #[ORM\Column(type: 'integer', nullable: true)]
    private int $ataque_conjuro = 0;

    #[ORM\ManyToMany(targetEntity: Conjuro::class)]
    #[ORM\JoinTable(name: "personaje_conjuros")]
    private Collection $conjuros;

    #[ORM\Column(type: 'json')]
    private array $conjuros_extra = []; // Conjuros obtenidos por dotes, armas o herramientas mágicas

    #[ORM\Column(type: 'integer')]
    private int $carga_maxima = 0;

    #[ORM\Column(length: 255)]
    private string $monedas = '';

    #[ORM\Column(type: 'json')]
    private array $armas = [];

    #[ORM\Column(type: 'json')]
    private array $equipo = [];

    #[ORM\Column(type: 'text')]
    private string $rasgos_personalidad = '';

    #[ORM\Column(type: 'text')]
    private string $ideales = '';

    #[ORM\Column(type: 'text')]
    private string $vinculos = '';

    #[ORM\Column(type: 'text')]
    private string $defectos = '';

    public function __construct()
    {
        $this->conjuros = new ArrayCollection();
    }

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

    public function getJugador(): ?string
    {
        return $this->jugador;
    }

    public function setJugador(string $jugador): static
    {
        $this->jugador = $jugador;

        return $this;
    }

    public function getTrasfondo(): ?string
    {
        return $this->trasfondo;
    }

    public function setTrasfondo(string $trasfondo): static
    {
        $this->trasfondo = $trasfondo;

        return $this;
    }

    public function getExperiencia(): ?int
    {
        return $this->experiencia;
    }

    public function setExperiencia(int $experiencia): static
    {
        $this->experiencia = $experiencia;

        return $this;
    }

    public function getRaza(): ?string
    {
        return $this->raza;
    }

    public function setRaza(string $raza): static
    {
        $this->raza = $raza;

        return $this;
    }

    public function getClasesNiveles(): array
    {
        return $this->clases_niveles;
    }

    public function setClasesNiveles(array $clases_niveles): static
    {
        $this->clases_niveles = $clases_niveles;

        return $this;
    }

    public function getclases_lanzadoras_conjuros(): array
    {
        return $this->clases_lanzadoras_conjuros;
    }

    public function setclases_lanzadoras_conjuros(array $clases_lanzadoras_conjuros): static
    {
        $this->clases_lanzadoras_conjuros = $clases_lanzadoras_conjuros;

        return $this;
    }

    public function getAlineamiento(): ?string
    {
        return $this->alineamiento;
    }

    public function setAlineamiento(string $alineamiento): static
    {
        $this->alineamiento = $alineamiento;

        return $this;
    }

    public function getIdiomas(): array
    {
        return $this->idiomas;
    }

    public function setIdiomas(array $idiomas): static
    {
        $this->idiomas = $idiomas;

        return $this;
    }

    public function getInspiracion(): ?int
    {
        return $this->inspiracion;
    }

    public function setInspiracion(int $inspiracion): static
    {
        $this->inspiracion = $inspiracion;

        return $this;
    }

    public function getVelocidad(): ?int
    {
        return $this->velocidad;
    }

    public function setVelocidad(int $velocidad): static
    {
        $this->velocidad = $velocidad;

        return $this;
    }

    public function getResistencias(): array
    {
        return $this->resistencias;
    }

    public function setResistencias(array $resistencias): static
    {
        $this->resistencias = $resistencias;

        return $this;
    }

    public function getVulnerabilidades(): array
    {
        return $this->vulnerabilidades;
    }

    public function setVulnerabilidades(array $vulnerabilidades): static
    {
        $this->vulnerabilidades = $vulnerabilidades;

        return $this;
    }

    public function getInmunidades(): array
    {
        return $this->inmunidades;
    }

    public function setInmunidades(array $inmunidades): static
    {
        $this->inmunidades = $inmunidades;

        return $this;
    }

    public function getDadoGolpeTipo(): ?string
    {
        return $this->dado_golpe_tipo;
    }

    public function setDadoGolpeTipo(string $dado_golpe_tipo): static
    {
        $this->dado_golpe_tipo = $dado_golpe_tipo;

        return $this;
    }

    public function getxp_proximo_nivel(): ?int
    {
        return $this->xp_proximo_nivel;
    }

    public function setxp_proximo_nivel(int $xp_proximo_nivel): static
    {
        $this->xp_proximo_nivel = $xp_proximo_nivel;

        return $this;
    }

    public function getestado_actual(): string
    {
        return $this->estado_actual;
    }

    public function setestado_actual(string $estado_actual): static
    {
        $this->estado_actual = $estado_actual;

        return $this;
    }

    public function getcompetencias_herramientas(): array
    {
        return $this->competencias_herramientas;
    }

    public function setcompetencias_herramientas(array $competencias_herramientas): static
    {
        $this->competencias_herramientas = $competencias_herramientas;

        return $this;
    }

    public function getNotas(): ?string
    {
        return $this->notas;
    }

    public function setNotas(?string $notas): static
    {
        $this->notas = $notas;

        return $this;
    }

    public function getAtributos(): array
    {
        return $this->atributos;
    }

    public function setAtributos(array $atributos): static
    {
        $this->atributos = $atributos;

        return $this;
    }

    public function gettiradas_salvacion(): array
    {
        return $this->tiradas_salvacion;
    }

    public function settiradas_salvacion(array $tiradas_salvacion): static
    {
        $this->tiradas_salvacion = $tiradas_salvacion;

        return $this;
    }

    public function getHabilidades(): array
    {
        return $this->habilidades;
    }

    public function setHabilidades(array $habilidades): static
    {
        $this->habilidades = $habilidades;

        return $this;
    }

    public function getCa(): ?int
    {
        return $this->ca;
    }

    public function setCa(int $ca): static
    {
        $this->ca = $ca;

        return $this;
    }

    public function getpuntos_golpe(): ?int
    {
        return $this->puntos_golpe;
    }

    public function setpuntos_golpe(int $puntos_golpe): static
    {
        $this->puntos_golpe = $puntos_golpe;

        return $this;
    }

    public function getpuntos_golpe_temporales(): ?int
    {
        return $this->puntos_golpe_temporales;
    }

    public function setpuntos_golpe_temporales(int $puntos_golpe_temporales): static
    {
        $this->puntos_golpe_temporales = $puntos_golpe_temporales;

        return $this;
    }

    public function getIniciativa(): ?int
    {
        return $this->iniciativa;
    }

    public function setIniciativa(int $iniciativa): static
    {
        $this->iniciativa = $iniciativa;

        return $this;
    }

    public function gettirada_iniciativa (): ?int
    {
        return $this->tirada_iniciativa ;
    }

    public function settirada_iniciativa (int $tirada_iniciativa): static
    {
        $this->tirada_iniciativa  = $tirada_iniciativa;

        return $this;
    }


    public function getdados_golpe(): ?string
    {
        return $this->dados_golpe;
    }

    public function setdados_golpe(string $dados_golpe): static
    {
        $this->dados_golpe = $dados_golpe;

        return $this;
    }

    public function isMagia(): ?bool
    {
        return $this->magia;
    }

    public function setMagia(bool $magia): static
    {
        $this->magia = $magia;

        return $this;
    }

    public function getcd_conjuro (): ?int
    {
        return $this->cd_conjuro;
    }

    public function setcd_conjuro (?int $cd_conjuro): static
    {
        $this->cd_conjuro = $cd_conjuro;

        return $this;
    }

    public function getataque_conjuro (): ?int
    {
        return $this->ataque_conjuro;
    }

    public function setataque_conjuro (?int $ataque_conjuro): static
    {
        $this->ataque_conjuro = $ataque_conjuro;

        return $this;
    }

    public function getconjuros_extra(): array
    {
        return $this->conjuros_extra;
    }

    public function setconjuros_extra(array $conjuros_extra): static
    {
        $this->conjuros_extra = $conjuros_extra;

        return $this;
    }

    public function getcarga_maxima(): ?int
    {
        return $this->carga_maxima;
    }

    public function setcarga_maxima(int $carga_maxima): static
    {
        $this->carga_maxima = $carga_maxima;

        return $this;
    }

    public function getMonedas(): ?string
    {
        return $this->monedas;
    }

    public function setMonedas(string $monedas): static
    {
        $this->monedas = $monedas;

        return $this;
    }

    public function getArmas(): array
    {
        return $this->armas;
    }

    public function setArmas(array $armas): static
    {
        $this->armas = $armas;

        return $this;
    }

    public function getEquipo(): array
    {
        return $this->equipo;
    }

    public function setEquipo(array $equipo): static
    {
        $this->equipo = $equipo;

        return $this;
    }

    public function getrasgos_personalidad(): ?string
    {
        return $this->rasgos_personalidad;
    }

    public function setrasgos_personalidad(string $rasgos_personalidad): static
    {
        $this->rasgos_personalidad = $rasgos_personalidad;

        return $this;
    }

    public function getIdeales(): ?string
    {
        return $this->ideales;
    }

    public function setIdeales(string $ideales): static
    {
        $this->ideales = $ideales;

        return $this;
    }

    public function getVinculos(): ?string
    {
        return $this->vinculos;
    }

    public function setVinculos(string $vinculos): static
    {
        $this->vinculos = $vinculos;

        return $this;
    }

    public function getDefectos(): ?string
    {
        return $this->defectos;
    }

    public function setDefectos(string $defectos): static
    {
        $this->defectos = $defectos;

        return $this;
    }

    /**
     * @return Collection<int, Conjuro>
     */
    public function getConjuros(): Collection
    {
        return $this->conjuros;
    }

    public function addConjuro(Conjuro $conjuro): static
    {
        if (!$this->conjuros->contains($conjuro)) {
            $this->conjuros->add($conjuro);
        }

        return $this;
    }

    public function removeConjuro(Conjuro $conjuro): static
    {
        $this->conjuros->removeElement($conjuro);

        return $this;
    }
    
}
