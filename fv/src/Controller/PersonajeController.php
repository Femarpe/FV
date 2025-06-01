<?php

namespace Fv\Controller;

use Fv\Entity\Personaje;
use Fv\Repository\PersonajeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    #[Route('/personajes/crear', name: 'personaje_crear')]
    public function crear(): Response
    {
        $personaje = new Personaje();
            
            
        return $this->render('personaje/personaje.html.twig', [
            'personaje' =>  $personaje
        ]);
    }

    #[Route('/personajes/editar/{id}', name: 'personaje_editar')]
    public function editar(int $id, PersonajeRepository $repo): Response
    {
        $personaje = $repo->find($id);

        if (!$personaje || $personaje->getJugador() !== $this->getUser()->getUserIdentifier()) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('personaje/personaje.html.twig', [
            'personaje' => $personaje
        ]);
    }

    #[Route('/personajes/guardar/{id}', name: 'guardar_personaje')]
    public function guardar(?int $id, Request $request, EntityManagerInterface $em): Response
    {
        $personaje = $id
            ? $em->getRepository(Personaje::class)->find($id)
            : new Personaje();

        if (!$personaje) {
            throw $this->createNotFoundException('Personaje no encontrado');
        }

        $usuario = $this->getUser()->getUserIdentifier();

        if ($personaje->getJugador() !== null && $personaje->getJugador() !== $usuario) {
            throw $this->createAccessDeniedException();
        }

        // Datos básicos
        $personaje->setNombre($request->request->get('nombre'));
        $personaje->setJugador($usuario);
        $personaje->setTrasfondo($request->request->get('trasfondo'));
        $personaje->setExperiencia((int)$request->request->get('experiencia'));
        $personaje->setEstadoActual($request->request->get('estado_actual'));
        $personaje->setVelocidad((int)$request->request->get('velocidad'));
        $personaje->setAlineamiento($request->request->get('alineamiento'));
        $personaje->setIdiomas(array_map('trim', explode(',', $request->request->get('idiomas'))));
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
        $personaje->setTiradasSalvacion($request->request->all('tiradas_salvacion') ?? []);
        $personaje->setHabilidades($request->request->all('habilidades') ?? []);

        // Combate
        $personaje->setCa((int)$request->request->get('ca'));
        $personaje->setPuntosGolpe((int)$request->request->get('puntos_golpe'));
        $personaje->setPuntosGolpeTemporales((int)$request->request->get('puntos_golpe_temporales'));
        $personaje->setIniciativa((int)$request->request->get('iniciativa'));
        $personaje->setDadosGolpe($request->request->get('dados_golpe'));
        $personaje->setResistencias(array_map('trim', explode(',', $request->request->get('resistencias') ?? '')));
        $personaje->setVulnerabilidades(array_map('trim', explode(',', $request->request->get('vulnerabilidades') ?? '')));
        $personaje->setInmunidades(array_map('trim', explode(',', $request->request->get('inmunidades') ?? '')));

        // Inventario
        $personaje->setEquipo($request->request->all('equipo') ?? []);

        // Magia
        $personaje->setCdConjuro((int)$request->request->get('cd_conjuro'));
        $personaje->setAtaqueConjuro((int)$request->request->get('ataque_conjuro'));

        // Conjuros (si quieres añadirlo después)
        // $personaje->setConjurosExtra($request->request->all('conjuros') ?? []);

        // Personalidad
        $personaje->setRasgosPersonalidad($request->request->get('rasgos_personalidad'));
        $personaje->setIdeales($request->request->get('ideales'));
        $personaje->setVinculos($request->request->get('vinculos'));
        $personaje->setDefectos($request->request->get('defectos'));
        $personaje->setNotas($request->request->get('notas'));

        // Guardar
        $em->persist($personaje);
        $em->flush();

        return $this->redirectToRoute('personaje_index');
    }
}
