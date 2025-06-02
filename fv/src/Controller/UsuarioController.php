<?php

namespace Fv\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render("views/home.html.twig");
    }

    
    /*
    #[Route('/usuario', name: 'ruta_usuario')]
    public function index(): Response
    {
    ver_personajes
        return new Response('<h1>Panel del usuario</h1>');
    }*/
}