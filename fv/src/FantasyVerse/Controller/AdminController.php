<?php

namespace Fv\FantasyVerse\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Fv\FantasyVerse\Repository\PersonajeRepository;
use Fv\FantasyVerse\Repository\CampanyaRepository;
use Fv\FantasyVerse\Repository\EventoRepository;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('', name: 'admin_dashboard')]
    public function index(
        PersonajeRepository $personajeRepo,
        CampanyaRepository $campanyaRepo,
        EventoRepository $eventoRepo
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/index.html.twig', [
            'personajes' => $personajeRepo->findAll(),
            'campanyas' => $campanyaRepo->findAll(),
            'eventos' => $eventoRepo->findAll(),
        ]);
    }

    #[Route('/personajes', name: 'admin_personajes')]
    public function personajes(PersonajeRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/personajes.html.twig', [
            'personajes' => $repo->findAll(),
        ]);
    }

    #[Route('/campanyas', name: 'admin_campanyas')]
    public function campanyas(CampanyaRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/campanyas.html.twig', [
            'campanyas' => $repo->findAll(),
        ]);
    }
    
    #[Route('/eventos', name: 'admin_eventos')]
    public function eventos(EventoRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/eventos.html.twig', [
            'eventos' => $repo->findAll(),
        ]);
    }



}
