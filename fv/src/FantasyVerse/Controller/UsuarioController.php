<?php

namespace Fv\FantasyVerse\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Fv\FantasyVerse\Repository\PersonajeRepository;
use Fv\FantasyVerse\Repository\CampanyaRepository;

#[Route(path: '/')]
class UsuarioController extends AbstractController
{
    
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
