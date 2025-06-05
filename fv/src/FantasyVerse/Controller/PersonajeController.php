<?php

namespace Fv\FantasyVerse\Controller;

use Fv\FantasyVerse\Entity\Personaje;
use Fv\FantasyVerse\Repository\PersonajeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;





class PersonajeController extends AbstractController
{
    #[Route('/personajes', name: 'personaje_index')]
    public function index(PersonajeRepository $repo): Response
    {
        $usuario = $this->getUser();

        $personajes = $repo->findBy([
            'jugador' => $usuario->getUserIdentifier()
        ]);

        return $this->render('personaje/index.html.twig', [
            'personajes' => $personajes
        ]);
    }






    /** Crear un nuevo personaje */
    #[Route('/personajes/crear', name: 'crear_personaje')]
    public function crear(): Response
    {
        $personaje = new Personaje();

        // Inicializar campos escalares
        $personaje->setNombre('');
        $personaje->setJugador($this->getUser()->getUserIdentifier());
        $personaje->setTrasfondo('');
        $personaje->setExperiencia(0);
        $personaje->setEstado_actual('');
        $personaje->setVelocidad(0);
        $personaje->setAlineamiento('');
        $personaje->setIdiomas([]);
        $personaje->setCa(10);
        $personaje->setPuntos_golpe(0);
        $personaje->setPuntos_golpe_temporales(0);
        $personaje->setIniciativa(0);
        $personaje->setTirada_iniciativa(0);
        $personaje->setDados_golpe('');
        $personaje->setResistencias([]);
        $personaje->setVulnerabilidades([]);
        $personaje->setInmunidades([]);
        $personaje->setMonedas('');
        $personaje->setMagia(true);
        $personaje->setCd_conjuro(0);
        $personaje->setAtaque_conjuro(0);
        $personaje->setRasgos_personalidad('');
        $personaje->setIdeales('');
        $personaje->setVinculos('');
        $personaje->setDefectos('');
        $personaje->setNotas('');

        // Atributos
        $personaje->setAtributos([
            'fuerza' => 0,
            'destreza' => 0,
            'constitucion' => 0,
            'inteligencia' => 0,
            'sabiduria' => 0,
            'carisma' => 0,
        ]);

        // Tiradas de salvación
        $personaje->setTiradas_salvacion([
            'fuerza' => 0,
            'destreza' => 0,
            'constitucion' => 0,
            'inteligencia' => 0,
            'sabiduria' => 0,
            'carisma' => 0,
        ]);

        // Habilidades 
        $personaje->setHabilidades([
            'acrobacias' => ['valor' => 0, 'competencia' => false, 'atributo' => 'destreza'],
            'manejo_animales' => ['valor' => 0, 'competencia' => false, 'atributo' => 'sabiduria'],
            'arcano' => ['valor' => 0, 'competencia' => false, 'atributo' => 'inteligencia'],
            'atletismo' => ['valor' => 0, 'competencia' => false, 'atributo' => 'fuerza'],
            'engaño' => ['valor' => 0, 'competencia' => false, 'atributo' => 'carisma'],
            'historia' => ['valor' => 0, 'competencia' => false, 'atributo' => 'inteligencia'],
            'perspicacia' => ['valor' => 0, 'competencia' => false, 'atributo' => 'sabiduria'],
            'intimidación' => ['valor' => 0, 'competencia' => false, 'atributo' => 'carisma'],
            'investigación' => ['valor' => 0, 'competencia' => false, 'atributo' => 'inteligencia'],
            'medicina' => ['valor' => 0, 'competencia' => false, 'atributo' => 'sabiduria'],
            'naturaleza' => ['valor' => 0, 'competencia' => false, 'atributo' => 'inteligencia'],
            'percepción' => ['valor' => 0, 'competencia' => false, 'atributo' => 'sabiduria'],
            'interpretación' => ['valor' => 0, 'competencia' => false, 'atributo' => 'carisma'],
            'persuasión' => ['valor' => 0, 'competencia' => false, 'atributo' => 'carisma'],
            'religión' => ['valor' => 0, 'competencia' => false, 'atributo' => 'inteligencia'],
            'juego_de_manos' => ['valor' => 0, 'competencia' => false, 'atributo' => 'destreza'],
            'sigilo' => ['valor' => 0, 'competencia' => false, 'atributo' => 'destreza'],
            'supervivencia' => ['valor' => 0, 'competencia' => false, 'atributo' => 'sabiduria'],
        ]);
        

        // Armas
        $personaje->setArmas([
            [
                'nombre' => '',
                'danio' => '',
                'tipo_danio' => '',
            ]
        ]);

        // Equipo
        $personaje->setEquipo(['']);

        // Conjuros
        $personaje->setConjuros_extra([
            [
                'nombre' => '',
                'nivel' => 0,
                'componentes' => ''
            ]
        ]);

        return $this->render('personaje/personaje.html.twig', [
            'personaje' => $personaje
        ]);
    }

    /** Editar un personaje */
    #[Route('/personajes/editar/{id}', name: 'editar_personaje')]
    public function editarPersonaje(Uuid $id, EntityManagerInterface $em): Response
    {
        $personaje = $em->getRepository(Personaje::class)->find($id);
    
        if (!$personaje) {
            throw $this->createNotFoundException('Personaje no encontrado');
        }
    
        $usuario = $this->getUser()->getUserIdentifier();
    
        if ($personaje->getJugador() !== $usuario) {
            throw $this->createAccessDeniedException();
        }
    
        return $this->render('personaje/personaje.html.twig', [
            'personaje' => $personaje
        ]);
    }







    /** Guardar un personaje */
    #[Route('/personajes/guardar/{id}', name: 'guardar_personaje')]
    public function guardarPersonaje(Uuid $id, Request $request, EntityManagerInterface $em): Response
    {
    $personaje = $id
        ? $em->getRepository(Personaje::class)->find($id)
        : new Personaje();

    if (!$personaje) {
        throw $this->createNotFoundException('Personaje no encontrado');
    }

    $usuario = $this->getUser()->getUserIdentifier();

    // Solo deniega acceso si se intenta editar un personaje ajeno
    if ($id && $personaje->getJugador() !== $usuario) {
        throw $this->createAccessDeniedException();
    }

    // Datos básicos
    $personaje->setNombre($request->request->get('nombre'));
    $personaje->setJugador($usuario);
    $personaje->setTrasfondo($request->request->get('trasfondo'));
    $personaje->setExperiencia((int)$request->request->get('experiencia'));
    $personaje->setestado_actual($request->request->get('estado_actual'));
    $personaje->setVelocidad((int)$request->request->get('velocidad'));
    $personaje->setAlineamiento($request->request->get('alineamiento'));
    $personaje->setIdiomas(array_map('trim', explode(',', $request->request->get('idiomas') ?? '')));
    $personaje->setMonedas($request->request->get('monedas'));

    // Atributos
    $atributos = [
        'fuerza' => (int)$request->request->get('fuerza'),
        'destreza' => (int)$request->request->get('destreza'),
        'constitucion' => (int)$request->request->get('constitucion'),
        'inteligencia' => (int)$request->request->get('inteligencia'),
        'sabiduria' => (int)$request->request->get('sabiduria'),
        'carisma' => (int)$request->request->get('carisma'),
    ];
    $personaje->setAtributos($atributos);

    // Tiradas de salvación y habilidades
    $personaje->settiradas_salvacion($request->request->all('tiradas_salvacion') ?? []);
    $habilidades_raw = $request->request->all('habilidades') ?? [];

    $habilidades = [];
    foreach ($habilidades_raw as $nombre => $datos) {
        $habilidades[$nombre] = [
            'valor' => isset($datos['valor']) ? (int)$datos['valor'] : 0,
            'competencia' => isset($datos['competencia']),
            'atributo' => $personaje->getHabilidades()[$nombre]['atributo'] ?? '',
        ];
    }
    
    $personaje->setHabilidades($habilidades);
    // Combate
    $personaje->setCa((int)$request->request->get('ca'));
    $personaje->setpuntos_golpe((int)$request->request->get('puntos_golpe'));
    $personaje->setpuntos_golpe_temporales((int)$request->request->get('puntos_golpe_temporales'));
    $personaje->setIniciativa((int)$request->request->get('iniciativa'));
    $personaje->setdados_golpe($request->request->get('dados_golpe'));
    $personaje->setResistencias(array_map('trim', explode(',', $request->request->get('resistencias') ?? '')));
    $personaje->setVulnerabilidades(array_map('trim', explode(',', $request->request->get('vulnerabilidades') ?? '')));
    $personaje->setInmunidades(array_map('trim', explode(',', $request->request->get('inmunidades') ?? '')));

    // Inventario
    $personaje->setEquipo($request->request->all('equipo') ?? []);

    // Magia
    $personaje->setcd_conjuro((int)$request->request->get('cd_conjuro'));
    $personaje->setataque_conjuro((int)$request->request->get('ataque_conjuro'));

    // Conjuros 
    // $personaje->setConjurosExtra($request->request->all('conjuros') ?? []);

    // Personalidad
    $personaje->setrasgos_personalidad($request->request->get('rasgos_personalidad'));
    $personaje->setIdeales($request->request->get('ideales'));
    $personaje->setVinculos($request->request->get('vinculos'));
    $personaje->setDefectos($request->request->get('defectos'));
    $personaje->setNotas($request->request->get('notas'));

    // Guardar en BDD
    $em->persist($personaje);
    $em->flush();

    return $this->redirectToRoute('ver_personajes');
}



#[Route('/personajes/eliminar/{id}', name: 'eliminar_personaje', methods: ['POST'])]
public function eliminarPersonaje(Uuid $id, Request $request, EntityManagerInterface $em): Response
{
    $personaje = $em->getRepository(Personaje::class)->find($id);

    if (!$personaje) {
        throw $this->createNotFoundException('Personaje no encontrado');
    }

    if ($personaje->getJugador() !== $this->getUser()->getUserIdentifier()) {
        throw $this->createAccessDeniedException();
    }

    // Verificar token CSRF
    $token = $request->request->get('_token');
    if (!$this->isCsrfTokenValid('eliminar_personaje_' . $personaje->getId(), $token)) {
        throw $this->createAccessDeniedException('Token CSRF inválido');
    }

    $em->remove($personaje);
    $em->flush();

    $this->addFlash('success', 'Personaje eliminado correctamente');

    return $this->redirectToRoute('personaje_index');
}

}
