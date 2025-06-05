<?php

namespace Fv\FantasyVerse\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvitadoController extends AbstractController
{
    #[Route('/invitado', name: 'ruta_invitado')]
    public function index(): Response
    {
        return new Response('<h1>Acceso como invitado a una campaña</h1>');
    }
}
