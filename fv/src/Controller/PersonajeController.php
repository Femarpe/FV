<?php

namespace Fv\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PersonajeController extends AbstractController
{
    public function __invoke(): Response
    {
        $personaje = [
            'id' => 0,
            'nombre' => 'Euris Eisenberg',
            'jugador' => 'Nombre del Jugador',
            'trasfondo' => 'Ex-Oficial de la Guardia de Neverwinter',
            'experiencia' => 4500,
            'raza' => 'Semielfo',
            'clase' => 'Guerrera',
            'nivel' => 5,
            'alineamiento' => 'Legal Neutral',
            'idiomas' => ['Común', 'Élfico'],
            'inspiracion' => 0,
            'velocidad' => 30, // En pies
            'resistencias' => ['Veneno', 'Fuego'],
            'vulnerabilidades' => ['Frío'],
            'inmunidades' => ['Encantamiento'],
            'dado_golpe_tipo' => 'd10', // Depende de la clase
            'xp_proximo_nivel' => 6500,
            'estado_actual' => 'Normal', // Puede ser 'Herido', 'Inconsciente', etc.
            'competencias_herramientas' => ['Kit de Herramientas de Herrero', 'Instrumento Musical (Laúd)'],
            'notas' => 'Se siente responsable por la muerte de su escuadrón.',

            // Atributos    
            'fuerza' => 18,
            'destreza' => 12,
            'constitucion' => 16,
            'inteligencia' => 10,
            'sabiduria' => 14,
            'carisma' => 10,
            'bonificacion_competencia' => 3,

            // Tiradas de salvacion
            'tiradas_salvacion' => [
                'fuerza' => 6,
                'destreza' => 2,
                'constitucion' => 5,
                'inteligencia' => -1,
                'sabiduria' => 2,
                'carisma' => -1
            ],

            // Habilidades
            'habilidades' => [
                'acrobatics' => ['atributo' => 'Destreza', 'valor' => 2, 'competencia' => false],
                'arcana' => ['atributo' => 'Inteligencia', 'valor' => 0, 'competencia' => false],
                'athletics' => ['atributo' => 'Fuerza', 'valor' => 6, 'competencia' => true],
                'deception' => ['atributo' => 'Carisma', 'valor' => 0, 'competencia' => false],
                'history' => ['atributo' => 'Inteligencia', 'valor' => 0, 'competencia' => false],
                'insight' => ['atributo' => 'Sabiduría', 'valor' => 2, 'competencia' => false],
                'intimidation' => ['atributo' => 'Carisma', 'valor' => 0, 'competencia' => false],
                'investigation' => ['atributo' => 'Inteligencia', 'valor' => 0, 'competencia' => false],
                'medicine' => ['atributo' => 'Sabiduría', 'valor' => 2, 'competencia' => false],
                'nature' => ['atributo' => 'Inteligencia', 'valor' => 0, 'competencia' => false],
                'perception' => ['atributo' => 'Sabiduría', 'valor' => 2, 'competencia' => true],
                'performance' => ['atributo' => 'Carisma', 'valor' => 0, 'competencia' => false],
                'persuasion' => ['atributo' => 'Carisma', 'valor' => 0, 'competencia' => false],
                'religion' => ['atributo' => 'Inteligencia', 'valor' => 0, 'competencia' => false],
                'sleight_of_hand' => ['atributo' => 'Destreza', 'valor' => 2, 'competencia' => false],
                'stealth' => ['atributo' => 'Destreza', 'valor' => 2, 'competencia' => false],
                'survival' => ['atributo' => 'Sabiduría', 'valor' => 2, 'competencia' => false]
            ],

            // Combate
            'ca' => 18,
            'puntos_golpe' => 47,
            'puntos_golpe_temporales' => 25,
            'iniciativa' => 2,
            'tirada_iniciativa' => 20,
            'dados_golpe' => '5d10',

            // Magia
            'magia' => true,
            'cd_conjuro' => 13,
            'ataque_conjuro' => 5,
            'conjuros' => [
                ['nombre' => 'Luz', 'nivel' => 0, 'componentes' => 'V, M'],
                ['nombre' => 'Misil Mágico', 'nivel' => 1, 'componentes' => 'V, S'],
            ],

            // Inventario y equipo
            'carga_maxima' => 180,
            'monedas' => '50 PO, 20 PP, 10 PC',
            'armas' => [
                ['nombre' => 'Alabarda', 'danio' => '1d10', 'tipo_danio' => 'Cortante'],
                ['nombre' => 'Espada "Garra"', 'danio' => '1d6+1', 'tipo_danio' => 'Cortante'],
                ['nombre' => 'Ballesta Ligera', 'danio' => '1d8', 'tipo_danio' => 'Perforante']
            ],
            'equipo' => [
                'Cota de malla',
                'Boina azul prusia',
                'Insignia de oficial',
                'Daga como trofeo',
                'Yesquero',
                'Cuerda de 50m',
                'Raciones para 10 días',
            ],

            // Personalidad y trasfondo
            'rasgos_personalidad' => 'Siempre sigue su deber, pero ha aprendido a ser más flexible.',
            'ideales' => 'La disciplina y el honor lo son todo.',
            'vinculos' => 'Su antiguo escuadrón y el recuerdo de Kaede, su amiga caída.',
            'defectos' => 'No se perdona a sí misma por su pasado.',
        ];

        return $this->render('views/personaje.html.twig', [
            'personaje' => $personaje
        ]);

    }
}
