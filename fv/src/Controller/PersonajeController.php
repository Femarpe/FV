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

            // Atributos
            'fuerza' => 18,
            'destreza' => 12,
            'constitucion' => 16,
            'inteligencia' => 10,
            'sabiduria' => 14,
            'carisma' => 10,
            'bonificacion_competencia' => 3,

            // Combate
            'ca' => 18, 
            'puntos_golpe' => 47,
            'dados_golpe' => '5d10',

            // Magia
            'magia' => true,
            'cd_conjuro' => 13,
            'ataque_conjuro' => '+5',

            // Inventario y equipo
            'carga_maxima' => 180, 
            'monedas' => '50 PO, 20 PP, 10 PC',
            'armas' => [
                ['nombre' => 'Alabarda', 'descripcion' => 'Un arma de asta con gran alcance'],
                ['nombre' => 'Espada mágica "Garra"', 'descripcion' => 'Espada corta con filo encantado'],
                ['nombre' => 'Ballesta Ligera', 'descripcion' => 'Arma de proyectiles con 20 virotes'],
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
