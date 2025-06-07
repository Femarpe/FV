<?php
// src/Controller/LandingController.php
namespace Fv\FantasyVerse\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Fv\FantasyVerse\Repository\PersonajeRepository;
use Fv\FantasyVerse\Repository\CampanyaRepository;

class LandingController extends AbstractController
{
    #[Route(path: '', name: 'landing')]
    public function __invoke(
        PersonajeRepository $personajeRepo,
        CampanyaRepository $campanyaRepo
    ): Response {
        $usuario = $this->getUser()?->getUserIdentifier();

        $personajes = $personajeRepo->findBy(['jugador' => $usuario]);
        $campanyas = $campanyaRepo->findBy(['creador' => $usuario]);

        return $this->render('landing.html.twig', [
            'personajes' => $personajes,
            'campanyas' => $campanyas,
        ]);
    }
}