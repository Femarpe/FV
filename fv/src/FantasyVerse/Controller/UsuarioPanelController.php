<?php

namespace Fv\FantasyVerse\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioPanelController extends AbstractController

{
    #[Route('/usuario', name: 'ruta_usuario')]
    public function index(): Response
    {
        return new Response('<h1>Bienvenido al panel de usuario</h1>');
    }
}
