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
}
